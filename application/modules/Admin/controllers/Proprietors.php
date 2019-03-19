<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require_once "./application/modules/admin/controllers/Admin.php";

class Proprietors extends admin
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('proprietors_model');
    }
    public function index($order = 'proprietor.created_on', $order_method = 'DESC')
    {
        $where = '';
        $proprietor_name = $this->session->userdata('proprietor_name');
        if ($proprietor_name)
        {
            $where.=' AND (first_name="'.$proprietor_name.'") OR (last_name ="'.$proprietor_name.'")';
        }
        

        // init params
        $limit_per_page = 4;
        $page = ($this->uri->segment(5)) ? ($this->uri->segment(5) - 1) : 0;

        // get current page records

        $config['base_url'] = base_url() . 'proprietors/all-proprietors/' . $order . '/' . $order_method;
        $config['total_rows'] = $this->proprietors_model->count_proprietors();
        $config['per_page'] = $limit_per_page;
        $config["uri_segment"] = 5;

        // custom paging configuration
        $config['num_links'] = 2;
        $config['use_page_numbers'] = true;
        $config['reuse_query_string'] = true;

        $this->pagination->initialize($config);

        // build paging links
        $v_data["links"] = $this->pagination->create_links();

        $v_data['proprietors'] = $this->proprietors_model->get_all_proprietors($where, $limit_per_page, $order, $order_method, $page * $limit_per_page);
        $v_data['order_method'] = $order_method;
        $v_data['order'] = $order;
        $v_data['counter'] = $page * $limit_per_page;
        $v_data['title'] = 'Proprietors';
        //Assign view as string with no data to var $content
        $data['content'] = $this->load->view('proprietor/all_proprietors', $v_data, true);
        
        $this->load->view('admin/layouts/layout', $data);
    }

    public function add_proprietor()
    {
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('proprietor_phone', 'Phone Number', 'required');
        $this->form_validation->set_rules('national_id', 'National Id', 'required');
        $this->form_validation->set_rules('business_reg_id', 'Business Reg Id', 'required');

        if ($this->form_validation->run()) {
            $proprietor_id = $this->proprietors_model->add_proprietor();

            if ($proprietor_id) {
                $this->session->set_flashdata('success', 'Proprietor Id' . '' . $proprietor_id . '' . 'added');

            } else {
                $this->session->set_flashdata('error', 'proprietor not added');

            }
            redirect('proprietors/all-proprietors');
        }
        if (validation_errors()) {

            $this->session->set_flashdata('error', validation_errors());
        }

        $data = array(
            "route" => 'null',
            "search_options" => NULL,
            "title" => "add proprietor",
            "content" => $this->load->view('proprietor/add_proprietor', null, true),
        );

        $this->load->view("layouts/layout", $data);
    }
    public function search_proprietor()
    {
       $proprietor_name  = $this->input->post('proprietor_name');
       if(!empty($proprietor_name) && $proprietor_name != NULL)
       {
           $this->session->set_userdata('proprietor_name', $proprietor_name);
       }
       redirect('proprietors/all-proprietors');
       
    }
    
	public function close_search() {
		$this->session->unset_userdata('proprietors_search_params');
		redirect('proprietors/all-proprietors');
	}
    
    
}
