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
    public function index()
    {
        // var_dump($this->session->flashdata('error'));die();
        $v_data['title'] = "Proprietors";
        $data['content'] = $this->load->view('admin/proprietor/all_proprietors',$v_data, TRUE);
        $this->load->view('admin/layouts/layout', $data);

    }
    public function add_proprietor()
    {
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('proprietor_phone', 'Phone Number', 'required');
        $this->form_validation->set_rules('national_id', 'National Id', 'required');
        $this->form_validation->set_rules('business_reg_id', 'Business Reg Id', 'required');

        if ($this->form_validation->run()) 
        {
            $proprietor_id = $this->proprietors_model->add_proprietor();

            if ($proprietor_id) {
                $this->session->set_flashdata('success', 'Proprietor Id' . $proprietor_id . 'added');

            } else {
                $this->session->set_flashdata('error', 'proprietor not added');

            }
        }
        if (validation_errors()) {
            
            $this->session->set_flashdata('error', validation_errors());
        }
       
        $data = array(
            "title" => "add proprietor",
            "content" => $this->load->view('proprietor/add_proprietor', NULL ,true)
        );

         $this->load->view("layouts/layout", $data);
    

       

    }
}
