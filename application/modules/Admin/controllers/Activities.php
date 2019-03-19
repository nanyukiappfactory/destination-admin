<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once "./application/modules/admin/controllers/Admin.php";

class Activities extends admin
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('activities_model');
    }

    public function all_activities($order = 'activity.created_on', $order_method = 'DESC')
    {
         $where = 'deleted = 0 ';

         // init params
         $limit_per_page = 5;
         $page = ($this->uri->segment(5)) ? ($this->uri->segment(5) - 1) : 0;

         // get current page records
              
         $config['base_url'] = base_url() . 'activities/all-activities/'.$order . '/'.$order_method;
         $config['total_rows'] = $this->activities_model->countAll();
         $config['per_page'] = $limit_per_page;
         $config["uri_segment"] = 5;
          
         // custom paging configuration
         $config['num_links'] = 2;
         $config['use_page_numbers'] = TRUE;
         $config['reuse_query_string'] = TRUE;
         $this->pagination->initialize($config);
                 
         // build paging links
         $v_data["links"] = $this->pagination->create_links();
         $v_data["activities"] = $this->activities_model->get_activities($where, $order, $order_method, $limit_per_page, $page*$limit_per_page);
         $v_data['order_method'] = $order_method;
         $v_data['counter'] = $page * $limit_per_page;
         $v_data['route'] = 'activities';       
         $data['title'] = 'activities';
        //  $status_array =array();
        //  $activity_name = array();
        //  $activity_phone = array();
        //  $activity_email = array();
        //  $activity_date = array();
        //  $check_duplicate = array();
         $data['content'] = $this->load->view('activity/all_activities', $v_data, TRUE); 

         ///$search_options = array();
         foreach ($this->activities_model->all_activities()->result() as $value) 
            {
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
            $activity_id = $this->activities_model->save_activity();

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
    // public function search_proprietor() 
    // {
    //     $sql_search_condition = '';
    //     $email = $this->input->post('email_search_param');
    //     $name = $this->input->post('name_search_param');
    //     $date = $this->input->post('date_search_param');
    //     $status = $this->input->post('status_search_param') == NULL ? 'null' : $this->input->post('status_search_param');
    //     $phone = $this->input->post('phone_search_param');

    //     if($email != NULL && !empty($email))
    //     {
    //         $sql_search_condition .= ' AND activity.activity_email = "'. $email . '"';
    //     }
    //     if($name != NULL && !empty($name))
    //     {
    //         $sql_search_condition .= ' AND activity.activity_name = "'. $name . '"'; 
    //     }
    //     if($date != NULL && !empty($date))
    //     {
    //         $sql_search_condition .= ' AND activity.activity_date= "'. $date . '"';
    //     } 
    //     if($status != 'null' )
    //     {
    //         $sql_search_condition .= ' AND activity.activity_status = '. $status;
    //     }
       
	// 	//set serach sessions
    //     $this->session->set_userdata('activities_search_params', $sql_search_condition);
    //     // echo($sql_search_condition);die();
    //     redirect('activities/all-activities');
        
	// }
}
