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
        if ($this->session->userdata('proprietors_search_params')) {
            $where = $this->session->userdata('proprietors_search_params');
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

        //Assign view as string with no data to var $content
        $data['content'] = $this->load->view('proprietor/all_proprietors', $v_data, true);
        
        //check and change order method
        $data['route'] = 'proprietors';
        $first_name = array();
        $status_array = array();
        $business_reg_id = array();
        $national_id_array = array();
        $check_duplicate = array();
        $search_options = array();

        foreach ($this->proprietors_model->all_proprietors()->result() as $value) {

            $status_value = '';

            if ($value->proprietor_status == 1) {
                $status_value = 'Active';

            } else if ($value->proprietor_status == 0) {
                $status_value = 'Inactive';

            }

            if (count($check_duplicate) > 0) {
                if (!in_array($status_value, $check_duplicate)) {
                    array_push($status_array, array(
                        'id' => $value->proprietor_status,
                        'name' => $status_value)
                    );
                    array_push($check_duplicate, $status_value);
                }
            } else {
                array_push($status_array, array(
                    'id' => $value->proprietor_status,
                    'name' => $status_value)
                );

                array_push($check_duplicate, $status_value);
                // array_push($check_duplicate, $first_name);
            }

            array_push($first_name, array(
                'id' => $value->first_name,
                'name' => $value->first_name,
            ));

            array_push($national_id_array, array(
                'id' => $value->national_id,
                'name' => $value->national_id,
            ));

            array_push($business_reg_id, array(
                'id' => $value->business_reg_id,
                'name' => $value->business_reg_id,
            ));
        }

        array_push($search_options, array('status_search_param', $status_array, 'Status'));
        array_push($search_options, array('name_search_param', $first_name, 'First Name'));
        array_push($search_options, array('national_id_search_param', $national_id_array, 'National ID'));
        array_push($search_options, array('business_id_search_param', $business_reg_id, 'Business Reg ID'));

        $data['title'] = 'Proprietors';
        $data['search_options'] = $search_options;
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
            "title" => "add proprietor",
            "content" => $this->load->view('proprietor/add_proprietor', null, true),
        );

        $this->load->view("layouts/layout", $data);
    }

    public function search_proprietor() 
    {
        $sql_search_condition = '';
        $national_id = $this->input->post('national_id_search_param');
        $name = $this->input->post('name_search_param');
        $business_id = $this->input->post('business_id_search_param');
        $status = $this->input->post('status_search_param') == NULL ? 'null' : $this->input->post('status_search_param');

        if($national_id != NULL && !empty($national_id))
        {
            $sql_search_condition .= ' AND proprietor.national_id = "'. $national_id . '"';
        }
        if($name != NULL && !empty($name))
        {
            $sql_search_condition .= ' AND proprietor.first_name = "'. $name . '"';
        
        }
        if($business_id != NULL && !empty($business_id))
        {
            $sql_search_condition .= ' AND proprietor.business_reg_id = "'. $business_id . '"';
        } 
        if($status != 'null' )
        {
            $sql_search_condition .= ' AND proprietor.proprietor_status = '. $status;
        }
       
		//set serach sessions
        $this->session->set_userdata('proprietors_search_params', $sql_search_condition);
        // echo($sql_search_condition);die();
        redirect('proprietors/all-proprietors');
        
	}
}
