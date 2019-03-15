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

    public function all_activities($order = 'activity.created_on', $order_method = 'DESC')
    {
        $where = 'deleted = 0 ';

         // init params
         $limit_per_page = 2;
         $page = ($this->uri->segment(5)) ? ($this->uri->segment(5) - 1) : 0;

         // get current page records
              
         $config['base_url'] = base_url() . 'activities/all-activities/'.$order . '/'.$order_method;
         $config['total_rows'] = $this->activity_model->countAll();
         $config['per_page'] = $limit_per_page;
         $config["uri_segment"] = 5;
          
         // custom paging configuration
         $config['num_links'] = 2;
         $config['use_page_numbers'] = TRUE;
         $config['reuse_query_string'] = TRUE;
         $this->pagination->initialize($config);
                 
         // build paging links
         $v_data["links"] = $this->pagination->create_links();
         $v_data["activities"] = $this->activity_model->get_activities($where, $order, $order_method, $limit_per_page, $page*$limit_per_page);
         $v_data['order_method'] = $order_method;
         $v_data['counter'] = $page * $limit_per_page;

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
