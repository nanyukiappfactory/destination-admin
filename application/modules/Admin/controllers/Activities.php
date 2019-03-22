<?php
defined('BASEPATH') or exit('No direct script access allowed');
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

    public function all_activities($order = 'activity.created_on', $order_method = 'DESC')
    {
        $where = 'deleted = 0 ';
        $search_activity_params = $this->session->userdata('search_activity_params');
        if ($search_activity_params) {
            $where .= $search_activity_params;
        }
        // init params
        $limit_per_page = 5;
        $page = ($this->uri->segment(5)) ? ($this->uri->segment(5) - 1) : 0;
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

        // build paging links
        $v_data["links"] = $this->pagination->create_links();
        $v_data["activities"] = $this->activities_model->get_activities($where, $order, $order_method, $limit_per_page, $page * $limit_per_page);
        $v_data['order_method'] = $order_method;
        $v_data['counter'] = $page * $limit_per_page;
        $v_data['route'] = 'activities';
        $data['title'] = 'activities';
        //initialize search
        $status_array = array();
        $activity_name = array();
        $activity_phone = array();
        $activity_email = array();
        $activity_date = array();
        $check_duplicate = array();
        $search_options = array();

        $data['content'] = $this->load->view('activity/all_activities', $v_data, true);
        $this->load->view('layouts/layout', $data);
        foreach ($this->activities_model->all_activities()->result() as $value) {
            // $status_value='';

            // if($value->activity_status==1) {
            //     $status_value='Active';
            // }
            // else if($value->activity_status==0) {
            //     $status_value='Inactive';
            // }

            // if(count($check_duplicate) > 0)
            // {
            //     if(!in_array($status_value, $check_duplicate))
            //     {
            //         array_push($search_array, array(
            //             'id' => $value->activity_status,
            //             'name' => $status_value
            //         ));
            //         array_push($check_duplicate, $status_value);
            //     }
            // }
            // else
            // {
            // array_push($status_array, array(
            //     'id' => $value->activity_status,
            //     'name' => $status_value
            // ));
            // array_push($check_duplicate, $status_value);
            // }
            // array_push($activity_name, array(
            //     'id'=> $value->activity_name,
            //     'name'=> $value->activity_name
            //     ));
            // array_push($activity_phone, array(
            //     'id'=> $value->activity_phone,
            //     'name'=> $value->activity_phone
            //     ));
            // array_push($activity_email, array(
            //     'id'=> $value->activity_email,
            //     'name'=> $value->activity_email
            //     ));
            // array_push($activity_date, array(
            //     'id'=> $value->activity_date,
            //     'name'=> $value->activity_date
            //     ));

        }
        // array_push($search_options, array('status_search_param', $status_array ,'Status'));
        // array_push($search_options, array('name_search_param', $activity_name,'Activity Name'));
        // array_push($search_options, array('date_search_param', $activity_date ,'Date'));
        // array_push($search_options, array('email_search_param', $activity_email,'Email'));
        // array_push($search_options, array('phone_search_param', $activity_phone ,'Phone'));
        //Load the main view with the data
        // $data['search_options'] = $search_options;

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
                redirect('activities/all-activities');
            } else {
                if ($this->activities_model->save_activity($upload_response['file_name'], $upload_response['thumb_name'])) {
                    $this->session->set_flashdata('success', 'Activity Added successfully!!');
                    redirect('activities/all-activities');
                } else {
                    $this->session->flashdata("error", "Unable to add school");
                    redirect('activities/all-activities');
                }
            }
            if ($activity_id) {
                $this->session->set_flashdata('success', 'Activity ID: ' . $activity_id . ' saved.');
                redirect('activities/all-activities');
            } else {
                $this->session->set_flashdata('error', 'Unable to save. Try again!!');
                redirect('activities/all-activities');
            }
        } else {
            if (validation_errors()) {
                $this->session->set_flashdata('error', validation_errors());
                redirect('activities/all-activities');
            }
            $data = array(
                "title" => "add activity",
                "content" => $this->load->view('activity/add_activity', null, true),
            );
            $this->load->view("layouts/layout", $data);
        }
    }
    public function search_activity()
    {
        //$sql_search_condition = '';
        $activity_status_str = $this->input->post('activity_status');
        $activity_email = $this->input->post('activity_email');
        $activity_name = $this->input->post('activity_name');
        $activity_date = $this->input->post('activity_date');
        $activity_phone = $this->input->post('activity_phone');
        $where = '';
        if ($activity_status_str) {
            $status = $activity_status_str == 'active' ? 1 : 0;
            $where .= ' AND activity_status=' . $status;
            $this->session->set_userdata('search_activity_status', $activity_status_str);
        }

        if ($activity_email) {
            $where .= ' AND activity_email="' . $activity_email . '"';
            $this->session->set_userdata('search_activity_email', $activity_email);
        }
        if ($activity_name) {
            $where .= ' AND activity_name="' . $activity_name . '"';
            $this->session->set_userdata('search_activity_name', $activity_name);
        }
        if ($activity_date) {
            $where .= ' AND activity_date="' . $activity_date . '"';
            $this->session->set_userdata('search_activity_date', $activity_date);
        }
        if ($activity_phone) {
            $where .= ' AND activity_phone="' . $activity_phone . '"';
            $this->session->set_userdata('search_activity_phone', $activity_phone);
        }
        //set search sessions
        $this->session->set_userdata('search_activity_params', $where);
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
		if ($this->form_validation->run() == TRUE) 
		{
			if($this->activity_model->update($activity_id))
			{
				$this->session->set_flashdata('success', 'successfully updated');				
			}
			else 
		    {
				$this->session->set_flashdata('error', 'Unable to update');		
		    }
		}
		else 
		{
			if(validation_errors())
			{
				$this->session->set_flashdata('error', validation_errors());
			}	
		}
		redirect('activities/all-activities');
	}
    public function close_search()
    {
        $this->session->unset_userdata('search_activity_params');
        $this->session->unset_userdata('search_activity_status');
        $this->session->unset_userdata('search_activity_email');
        $this->session->unset_userdata('search_activity_name');
        $this->session->unset_userdata('search_activity_date');
        $this->session->unset_userdata('search_activity_phone');

        redirect('activities/all-activities');
    }

}
