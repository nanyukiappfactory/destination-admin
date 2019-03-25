<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
    require_once "./application/modules/admin/controllers/Admin.php";

    class Business_types extends admin
    {
        function __construct()
        {
            parent:: __construct();

            $this->load->model('business_types_model');
        }

        public function index($order = 'business_type.created_on', $order_method = 'DESC')
        {
            $where = 'deleted = 0';
            
            $search_business_type_params = $this->session->userdata('search_business_type_params');
            if($search_business_type_params)
            {
                $where .= $search_business_type_params;
            }

            $limit_per_page = 5;
            $page = ($this->uri->segment(5)) ? ($this->uri->segment(5) - 1) : 0;

            $config['base_url'] = base_url(). 'business-types/all-business-types/'.$order . '/'.$order_method;
            $config['total_rows'] = $this->business_types_model->countAll($where);
            $config['per_page'] = $limit_per_page;
            $config['uri_segment'] = 5;
            $config['numlinks'] = 2;
            $config['use_page_numbers'] = TRUE;
            $config['reuse_query_string'] = TRUE;

            $this->pagination->initialize($config);
            
            $v_data['links'] = $this->pagination->create_links(); 

            $v_data['business_types'] = $this->business_types_model->get_business_types($where, $order, $order_method, $limit_per_page, $page * $limit_per_page);
            $v_data['order_method'] = $order_method;
            $v_data['counter'] = $page * $limit_per_page;
            $v_data['route'] = 'business-types';

            $data['title'] = 'Business Types';
            $data['content'] = $this->load->view('business_type/all_business_type', $v_data, TRUE);

            $this->load->view('admin/layouts/layout', $data); 
        }

        public function add_business_type()
        {
            $this->form_validation->set_rules('business_type_name', 'Name', 'required');

            if($this->form_validation->run() == TRUE)
            {
                $business_type_id = $this->business_types_model->save_business_type();
                if($business_type_id)
                {
                    $this->session->set_flashdata('success', 'Business ID: ' . $business_type_id . ' saved');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Unable to save Business Type. Try Again!');
                }
                redirect('business-types/all-business-types');
            }
            else
            {
                if(validation_errors())
                {
                    $this->session->set_flashdata('error', validation_errors());
                }
            }

            $data = array(
                "title" => "Add Business Type",
                "content" => $this->load->view('business_type/add_business_type', NULL, TRUE),
            );

            $this->load->view("layouts/layout", $data);
        }
        
        public function edit_business_type($business_type_id)
        {
            $this->form_validation->set_rules('business_type_name', 'Business Type Name', 'required');

            if($this->form_validation->run() == TRUE)
            {
                if($this->business_types_model->edit_business_type($business_type_id))
                {
                    $this->session->set_flashdata('success', 'Successfully updated');
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
            $data = array( 
                'title' => 'Edit Business Type',
                "content" => $this->load->view('business_type/edit_business_type', NULL, TRUE),
            );

            $this->load->view("layouts/layout", $data);
        }

        public function activate_business_type($business_type_id, $business_type_status)
        {
            if($business_type_status == 0)
            {
                $new_business_type_status = 1;
                $message = ' Activated successfully';
                $error_message = 'Unable to activate. Try again!';
            }
            else
            {
                $new_business_type_status = 0;
                $message = ' Deactivated successfully';
                $error_message = 'Unable to deactivate. Try again!';
            }

            if($this->business_types_model->activate_status($business_type_id, $new_business_type_status))
            {
                $this->session->set_flashdata('success', 'Business ID: ' . $business_type_id . $message);
            }
            else
            {
                $this->session->set_flashdata('error', $error_message);
            }
            redirect("business-types/all-business-types");
        }

        public function deactivate_business_type($business_type_id, $business_type_status)
        {
            if($business_type_status == 0)
            {
                $new_business_type_status = 1;
                $message = ' Activated successfully';
                $error_message = 'Unable to activate. Try again!';
            }
            else
            {
                $new_business_type_status = 0;
                $message = ' Deactivated successfully';
                $error_message = 'Unable to deactivate. Try again!';
            }

            if($this->business_types_model->deactivate_status($business_type_id, $new_business_type_status))
            {
                $this->session->set_flashdata('success', 'Business ID: ' . $business_type_id . $message);
            }
            else
            {
                $this->session->set_flashdata('error', $error_message);
            }
            redirect("business-types/all-business-types");
        }

        public function delete_business_type($business_type_id)
        {
            if ($this->business_types_model->delete($business_type_id)) 
            {
                $this->session->set_flashdata('success', 'Successfully deleted');
            }
            else 
            {
                $this->session->set_flashdata('error', 'Unable to delete');
            }
            redirect('business-types/all-business-types');
        }

        public function search_business_type() 
        {
            $status_str = $this->input->post('status');     
            $business_type_name = $this->input->post('business_type_name');
           
            $where = '';

            if($business_type_name)
            {
                $where .= ' AND business_type_name="'. $business_type_name .'"';            
                $this->session->set_userdata('search_business_type_name', $business_type_name);
            }

            if($status_str)
            {
                $status = $status_str == 'active' ? 1 : 0;
                $where .= ' AND business_type_status='. $status ;
                $this->session->set_userdata('checked_status', $status_str);
            }

            $this->session->set_userdata('search_business_type_params', $where);
            redirect('business-types/all-business-types');
        }

        public function close_search()
        {
            $this->session->unset_userdata('search_business_type_params');
            $this->session->unset_userdata('checked_status');
            $this->session->unset_userdata('search_business_type_name');
            redirect('business-types/all-business-types');
        }
    }
    
?>