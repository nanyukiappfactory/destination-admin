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
        $where = 'deleted = 0';

        $search_proprietor_params = $this->session->userdata('search_proprietor_params');
        if ($search_proprietor_params)
        {
            $where .= $search_proprietor_params;
        }

        // init params
        $limit_per_page = 4;
        $page = ($this->uri->segment(5)) ? ($this->uri->segment(5) ) : 0;

        // get current page records

        $config['base_url'] = base_url() . 'proprietors/all-proprietors/' . $order . '/' . $order_method;
        $config['total_rows'] = $this->proprietors_model->count_proprietors($where);
        $config['per_page'] = $limit_per_page;
        $config["uri_segment"] = 5;

        // custom paging configuration
        $config['num_links'] = 2;
        $config['use_page_numbers'] = true;
        $config['reuse_query_string'] = true;

        $this->pagination->initialize($config);
        $items = $page;

        // build paging links
        $v_data["links"] = $this->pagination->create_links();

        $v_data['proprietors'] = $this->proprietors_model->get_all_proprietors($where, $limit_per_page, $order, $order_method, $items);
        $v_data['order_method'] = $order_method;
        $v_data['order'] = $order;
        $v_data['page'] = $page;
        $v_data['counter'] = $items;
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
            "title" => "add proprietor",
            "content" => $this->load->view('proprietor/add_proprietor', null, true),
        );

        $this->load->view("layouts/layout", $data);
    }
    
    public function edit_proprietor($proprietor_id)
    {
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('proprietor_phone', 'Phone Number', 'required');
        $this->form_validation->set_rules('national_id', 'National Id', 'required');
        $this->form_validation->set_rules('business_reg_id', 'Business Reg Id', 'required');

        if ($this->form_validation->run()) 
        {
            $edit_proprietor = $this->proprietors_model->edit_proprietor($proprietor_id);

            if ($edit_proprietor) {
                $this->session->set_flashdata('success', 'Proprietor Id' . '' . $proprietor_id . '' . 'Edited');

            } else {
                $this->session->set_flashdata('error', 'edit not successful');
            }
            
            redirect('proprietors/all-proprietors');
        }
        else
        {
            if(validation_errors())
            {
                $this->session->set_flashdata('error', validation_errors());
            }
            
        }

        $proprietor_detail = $this->proprietors_model->single_proprietor($proprietor_id);

        if($proprietor_detail)
        {
            $first_name = $proprietor_detail->first_name;
            $last_name = $proprietor_detail->last_name;
            $proprietor_phone = $proprietor_detail->proprietor_phone;
            $national_id = $proprietor_detail->national_id;
            $business_reg_id = $proprietor_detail->business_reg_id;

            $v_data = array(
                'first_name' => $first_name,
                'last_name' => $last_name,
                'proprietor_phone' => $proprietor_phone,
                'national_id' => $national_id,
                'business_reg_id' => $business_reg_id,
                'proprietor_id' => $proprietor_id

            );

            $data = array(
                'title' => 'edit proprietor',
                'content'=> $this->load->view('proprietor/edit_proprietor', $v_data, true)
            );
            $this->load->view('layouts/layout',$data);
        }
        else
        {
            $this->session->set_flashdata('error', 'Unable to get proprietor of ID: ' . $proprietor_id . ' details');
            redirect('proprietors/all-proprietors');
        }
        
    }
    public function delete_proprietor($proprietor_id) 
    {
		if($this->proprietors_model->delete_proprietor($proprietor_id)) {
			$this->session->set_flashdata('success', 'Successfully deleted');
		}

		else {
			$this->session->set_flashdata('error', 'Unable to delete');
		}
        redirect('proprietors/all-proprietors');
    }
    public function activate_proprietor($proprietor_id, $proprietor_status)
     {
            $new_status=1;
            $message='Activated Succesfully';
            $error_message='Activation Failed';
        
        if($this->proprietors_model->activate_proprietor($proprietor_id, $new_status)) {
            $this->session->set_flashdata('success', 'proprietors ID:'.$proprietor_id . $message);
        }
        else {
            $this->session->set_flashdata('error', $error_message);
        }

        redirect('proprietors/all-proprietors');
    }

    public function deactivate_proprietor($proprietor_id, $proprietor_status) 
    {

        $new_status=0;
        $message='DeActivated Succesfully';
        $error_message='DeActivation Failed';
        
        if($this->proprietors_model->deactivate_proprietor($proprietor_id, $new_status)) {
            $this->session->set_flashdata('success', 'proprietors ID:'.$proprietor_id . $message);
        }
        else {
            $this->session->set_flashdata('error', $error_message);
        }

        redirect('proprietors/all-proprietors');
    }
    public function search_proprietor()
    {
        $status_str = $this->input->post('status');
        $business_id = $this->input->post('businessreg');
        $national_id = $this->input->post('nationalid');
        $proprietor_name  = $this->input->post('proprietor_name');
        $where = $title = '';
        
        if ($proprietor_name)
        {
            $where .= ' AND (first_name LIKE "%'.$proprietor_name.'%") OR (last_name LIKE "%'.$proprietor_name.'%")';
            $title .= ' Name = '.$proprietor_name;
        }
        if ($national_id)
        {
            $where .= ' AND national_id LIKE "%'.$national_id.'%"';
            $title .= ' ID = '.$national_id;
        }
        if($business_id)
        {
            $where .= ' AND business_reg_id LIKE "%'.$business_id.'%"';
            $title .= ' Business = '.$business_id;
        }
        if($status_str)
        {
            $status = $status_str == 'active' ? 1 : 0;
            $where .= ' AND proprietor_status LIKE "%'. $status_str.'%"';
            $title .= ' Status = '.$status_str;
        }

        $this->session->set_userdata('search_proprietor_params', $where);
        $this->session->set_userdata('search_proprietor_title', $title);
        redirect('proprietors/all-proprietors');
       
    }
    
	public function close_search() {
		$this->session->unset_userdata('search_proprietor_params');
		redirect('proprietors/all-proprietors');
	}
    
    
}
