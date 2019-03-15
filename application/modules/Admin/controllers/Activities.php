<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once "./application/modules/admin/controllers/Admin.php";

class Activities extends admin
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('activity_model');
    }

    public function all_activities()
    {
       $v_data = array(
           "activities" => $this->activity_model->all_activities()
       );
        
        $data = array(
            "title" => "activities",
            "content" => $this->load->view('activity/all_activities', $v_data, true)
        );
        $this->load->view('layouts/layout', $data);
    }
    public function add_activity()
    {
        $this->form_validation->set_rules('activity_name', 'Name', 'required');
        $this->form_validation->set_rules('activity_date', 'Date', 'required');
        $this->form_validation->set_rules('activity_phone', 'Phone', 'required');
        $this->form_validation->set_rules('activity_email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('activity_longitude', 'Longitude', 'required');
        $this->form_validation->set_rules('activity_latitude', 'Latitude', 'required');
        $this->form_validation->set_rules('activity_description', 'Description', 'required');

        if ($this->form_validation->run() == true) {
            $activity_id = $this->activity_model->save_activity();

            if ($activity_id) {
                $this->session->set_flashdata('success', 'Activity ID: ' . $activity_id . ' saved.');
            } else {
                $this->session->set_flashdata('error', 'Unable to save. Try again!!');
            }
            redirect('activities/all-activities');
        } else {
            if (validation_errors()) {
                $this->session->set_flashdata('error', validation_errors());
            }
        }
        $data = array(
            "title" => "add activity",
            "content" => $this->load->view('activity/add_activity', null, true),
        );
        $this->load->view("layouts/layout", $data);
    }
}
