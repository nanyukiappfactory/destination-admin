<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once "./application/modules/admin/controllers/Admin.php";

class Activities extends admin
{
    public $upload_path;
    public $upload_location;
    public function __construct()
    {
        parent::__construct();
        $this->upload_path = realpath(APPPATH . '../assets/uploads');
        //get the location to upload images
        $this->upload_location = base_url() . 'assets/uploads';
        $this->load->model('activities_model');
        $this->load->model('file_model');
        $this->load->library('image_lib');
    }

    public function index($order = 'activity.created_on', $order_method = 'DESC')
    {
        $where = 'deleted = 0 ';
        $search_activity_params = $this->session->userdata('search_activity_params');
        if ($search_activity_params) {
            $where .= $search_activity_params;
        }
        // init params
        $limit_per_page = 2;
        $page = ($this->uri->segment(5)) ? ($this->uri->segment(5)) : 0;//echo $page; die();
        // get current page records
        $config['base_url'] = base_url() . 'activities/all-activities/' . $order . '/' . $order_method;
        $config['total_rows'] = $this->activities_model->countAll($where);
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
        $v_data["activities"] = $this->activities_model->get_activities($where, $order, $order_method, $limit_per_page, $items);
        $v_data['order_method'] = $order_method;
        $v_data['counter'] = $items;
        $v_data['page'] = $page;
        $v_data['route'] = 'activities';
        $data['title'] = 'activities';
        $data['content'] = $this->load->view('activity/all_activities', $v_data, true);
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

        if ($this->form_validation->run()) {
            $resize = array(
                "width" => 600,
                "height" => 600,
            );
            $upload_response = $this->file_model->upload_image($this->upload_path, "activity_image", $resize);
            if ($upload_response['check'] == false) {
                $this->session->set_flashdata('error', $upload_response['message']);
            } else {
				$activity_id = $this->activities_model->save_activity($upload_response['file_name'], $upload_response['thumb_name']);
                if ($activity_id) {
                    $this->session->set_flashdata('success', 'Activity Added successfully!!');
                } else {
                    $this->session->flashdata('error', 'Unable to add activity');
                }
            }
            redirect('activities/all-activities');
        }
            if (validation_errors()) {
                $this->session->set_flashdata('error', validation_errors());
               
            }
        
        $data = array(
            "title" => "add activity",
            "content" => $this->load->view('activity/add_activity', null, true),
        );
        $this->load->view("layouts/layout", $data);

    }
    public function search_activity()
    {
        //$sql_search_condition = '';
        $activity_status_str = $this->input->post('activity_status');
        $activity_email = $this->input->post('activity_email');
        $activity_name = $this->input->post('activity_name');
        $activity_date = $this->input->post('activity_date');
        $activity_phone = $this->input->post('activity_phone');
        $where = $title = '';
        if ($activity_status_str) {
            $status = $activity_status_str == 'active' ? 1 : 0;
            $where .= ' AND activity_status=' . $status;
            $title .= ' Status = '.$activity_status_str;
        }

        if ($activity_email) {
            $where .= ' AND activity_email LIKE "%' . $activity_email . '%"';
            $title .= ' Email = '.$activity_email;
        }
        if ($activity_name) {
            $where .= ' AND activity_name LIKE "%' . $activity_name . '%"';
            $title .= ' Activity = '.$activity_name;
        }
        if ($activity_date) {
            $where .= ' AND activity_date LIKE "%' . $activity_date . '%"';
            $title .= ' Date = '.$activity_date;
        }
        if ($activity_phone) {
            $where .= ' AND activity_phone LIKE "%' . $activity_phone . '%"';
            $title .= ' Phone = '.$activity_phone;
        }
        //set search sessions
        $this->session->set_userdata('search_activity_params', $where);
        $this->session->set_userdata('search_activity_title', $title);
        redirect('activities/all-activities');
    }
    public function edit_activity($activity_id)
    {
        $this->form_validation->set_rules('activity_name', 'Name', 'required');
        $this->form_validation->set_rules('activity_description', 'Description', 'required');
        $this->form_validation->set_rules('activity_date', 'Date', 'required');
        $this->form_validation->set_rules('activity_phone', 'Phone', 'required');
        $this->form_validation->set_rules('activity_email', 'Email', 'required');
        $this->form_validation->set_rules('activity_longitude', 'Longitude', 'required');
        $this->form_validation->set_rules('activity_latitude', 'Latitude', 'required');
        //Returns to the same page if succeeds
        if ($this->form_validation->run()) {
            if ($this->activities_model->edit_activity($activity_id)) 
            {
                $this->session->set_flashdata('success', 'successfully updated');          
            } 
            else
            {
                $this->session->set_flashdata('error', 'Unable to update');
            }
            redirect('activities/all-activities');
        } 
        else 
        {
            if (validation_errors()) {
                $this->session->set_flashdata('error', validation_errors());
            }
        }
        $activity_detail = $this->activities_model->single_activity($activity_id);
        if($activity_detail)
        {
            $activity_name = $activity_detail->activity_name;
            $activity_date = $activity_detail->activity_date;
            $activity_latitude = $activity_detail->activity_latitude;
            $activity_longitude= $activity_detail->activity_longitude;
            $activity_email = $activity_detail->activity_email;
            $activity_phone = $activity_detail->activity_phone;
            $activity_description = $activity_detail->activity_description;

            $v_data = array(
                'activity_name' => $activity_name,
                'activity_date' => $activity_date,
                'activity_latitude' => $activity_latitude,
                'activity_longitude' => $activity_longitude,
                'activity_email' => $activity_email,
                'activity_phone' => $activity_phone,
                'activity_description' => $activity_description
            );
            $data = array(
                "title" => "Edit Activity",
                "content" => $this->load->view('activity/edit_activity', $v_data, TRUE)          
            );
            $this->load->view("layouts/layout", $data); 
        }   
        else
        {
            $this->session->set_flashdata('error', 'Unable to get activity ID: ' . $activity_id . ' details');
            redirect('activities/all-activities');
        }
             
    }

    public function close_search()
    {
        $this->session->unset_userdata('search_activity_params');
        $this->session->unset_userdata('search_activity_title');

        redirect('activities/all-activities');
    }
    public function deactivate_activity($activity_id, $activity_status)
    {
        if ($activity_status == 0) {
            $new_activity_status = 1;
            $message = ' activated successfully';
            $error_message = 'Unable to activate. Try again';
        } else {
            $new_activity_status = 0;
            $message = ' deactivated successfully';
            $error_message = 'Unable to deactivate. Try again';
        }
        if ($this->activities_model->deactivate_status($activity_id, $new_activity_status)) {
            $this->session->set_flashdata('success', 'activity ID: ' . $activity_id . $message);
        } else {
            $this->session->set_flashdata('error', $error_message);
        }
        redirect('activities/all-activities');
    }
    public function activate_activity($activity_id, $activity_status)
    {
        if ($activity_status == 0) {
            $new_activity_status = 1;
            $message = ' activated successfully';
            $error_message = 'Unable to activate. Try again';
        } else {
            $new_activity_status = 0;
            $message = ' deactivated successfully';
            $error_message = 'Unable to deactivate. Try again';
        }
        if ($this->activities_model->activate_status($activity_id, $new_activity_status)) {
            $this->session->set_flashdata('success', 'activity ID: ' . $activity_id . $message);
        } else {
            $this->session->set_flashdata('error', $error_message);
        }
        redirect('activities/all-activities');
    }
    public function delete_activity($activity_id)
    {
        if ($this->activities_model->delete($activity_id)) {
            $this->session->set_flashdata('success', 'Successfully deleted');
        } else {
            $this->session->set_flashdata('error', 'Unable to delete');
        }
        redirect('activities/all-activities');
    }

}
