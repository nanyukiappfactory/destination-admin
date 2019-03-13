<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
    require_once "./application/modules/admin/controllers/Admin.php";

    class Business_types extends admin
    {
        function __construct()
        {
            parent:: __construct();

            $this->load->model('business_type_model');
        }

        public function index()
        {
            $arr = array('1', '12', 'sam', '1992');
            $v_data['here'] = $arr;
            $data['content'] = $this->load->view('business_type/all_business_type', $v_data, TRUE);
            $this->load->view('admin/layouts/layout', $data); 
        }

        public function add_business_type()
        {
            $this->form_validation->set_rules('business_type_name', 'Name', 'required');

            if($this->form_validation->run() == TRUE)
            {
                $business_type_id = $this->business_type_model->save_business_type();
                if($business_type_id)
                {
                    $this->session->set_flashdata('success', 'Business ID: ' . $business_type_id . ' saved');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Unable to save Business Type. Try Again!');
                }
            }
            else
            {
                if(validation_errors())
                {
                    $this->session->set_flashdata('error', validation_errors());
                }
            }
            redirect('business-types/all-business-types');
        }
    }

?>