<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once "./application/modules/admin/controllers/Admin.php";

class Proprietors extends admin {
   function __construct() {
       
       parent::__construct();
       $this->load->model('proprietors_model');
   }
   public function index()
   {

    $data['content'] = $this->load->view('admin/proprietor/all_proprietors');
    $this->load->view('admin/layouts/layout', $data);


   }
   public function add_proprietor() {
    $this->form_validation->set_rules('first_name', 'First Name', 'required');
    $this->form_validation->set_rules('last_name', 'Last Name', 'required');
    $this->form_validation->set_rules('proprietor_phone', 'Phone Number', 'required');
    $this->form_validation->set_rules('national_id', 'National Id', 'required');
    $this->form_validation->set_rules('business_reg_id', 'Business Reg Id', 'required');


    if ($this->form_validation->run()) {
        $proprietor_id=$this->proprietors_model->add_proprietor();

        if ($proprietor_id) {
            $this->session->set_flashdata('success', 'Proprietor Id'.$proprietor_id.'added');
            
        }

        else {
            $this->session->set_flashdata('error', 'proprietor not added');
            
        }
    }
    if(validation_errors())
    {
        $this->session->set_flashdata('error', validation_errors());
    }

    redirect('proprietors/all-proprietors');

    

}
}
?>