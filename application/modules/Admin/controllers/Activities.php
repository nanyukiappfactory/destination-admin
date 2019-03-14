<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require_once "./application/modules/admin/controllers/Admin.php";

    class Activities extends admin
    {

        function __construct()
        {
            parent:: __construct();
            
            $this->load->model('activity_model');
        }

        public function all_activities()
        {
            $arr = array('1', '12', 'sam', '1992');
            $v_data['here'] = $arr ;
            $data['content'] = $this->load->view('activity/all_activities', $v_data, TRUE);
            $this->load->view('layouts/layout', $data);       
        }
        public function add_activity()
        {
            $this->form_validation->set_rules('activity_name', 'Name', 'required');       
            $this->form_validation->set_rules('activity_date', 'Date', 'required');
            $this->form_validation->set_rules('activity_phone', 'Phone', 'required');
            $this->form_validation->set_rules('activity_email', 'Email', 'required');
            $this->form_validation->set_rules('activity_longitude', 'Longitude', 'required');
            $this->form_validation->set_rules('activity_latitude', 'Latitude', 'required');
            $this->form_validation->set_rules('activity_description', 'Description', 'required');

            if ($this->form_validation->run() == TRUE) 
            {
                $activity_id = $this->activity_model->save_activity();

                if($activity_id)
                {
                    $this->session->set_flashdata('success', 'Activity ID: ' . $activity_id . ' saved.');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Unable to save. Try again!!');
                }              
                redirect('activities/all-activities');
            }
            else
            {
                if(validation_errors())
                {
                    $this->session->set_flashdata('error', validation_errors());
                }
            }
        }
    }
        ?>