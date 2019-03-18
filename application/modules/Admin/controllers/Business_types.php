<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
    require_once "./application/modules/admin/controllers/Admin.php";

    class Business_types extends admin
    {
        function __construct()
        {
            parent:: __construct();

            $this->load->model('business_type_model');
        }

        public function index($order = 'business_type.created_on', $order_method = 'DESC')
        {
            $where = 'deleted = 0';
            $limit_per_page = 5;
            $page = ($this->uri->segment(5)) ? ($this->uri->segment(5) - 1) : 0;

            $config['base_url'] = base_url(). 'business-types/all-business-types/'.$order . '/'.$order_method;
            $config['total_rows'] = $this->business_type_model->countAll();
            $config['per_page'] = $limit_per_page;
            $config['uri_segment'] = 5;
            $config['numlinks'] = 2;
            $config['use_page_numbers'] = TRUE;
            $config['reuse_query_string'] = TRUE;

            $this->pagination->initialize($config);

            $v_data['links'] = $this->pagination->create_links(); 

            $v_data['business_types'] = $this->business_type_model->get_business_types($where, $order, $order_method, $limit_per_page, $page * $limit_per_page);
            $v_data['order_method'] = $order_method;
            $v_data['counter'] = $page * $limit_per_page;

            $data['title'] = 'Business Type';
            $data['content'] = $this->load->view('business_type/all_business_type', $v_data, TRUE);

            $data['route'] = 'business_types';
            
            $business_type_name = array();
            $status_array = array();
            $check_duplicate = array();
            $search_options = array();

            foreach ($this->business_type_model->all_business_types()->result() as $value) {

                $status_value = '';
    
                if ($value->business_type_status == 1) {
                    $status_value = 'Active';
    
                } else if ($value->business_type_status == 0) {
                    $status_value = 'Inactive';
    
                }
    
                if (count($check_duplicate) > 0) {
                    if (!in_array($status_value, $check_duplicate)) {
                        array_push($status_array, array(
                            'id' => $value->business_type_status,
                            'name' => $status_value)
                        );
                        array_push($check_duplicate, $status_value);
                    }
                } 
                else {
                    array_push($status_array, array(
                        'id' => $value->business_type_status,
                        'name' => $status_value)
                    );
    
                    array_push($check_duplicate, $status_value);
                }
    
                array_push($business_type_name, array(
                    'id' => $value->business_type_name,
                    'name' => $value->business_type_name,
                ));
            }
    
            array_push($search_options, array('status_array_search_param', $status_array, 'Status'));
            array_push($search_options, array('business_type_name_search_param', $business_type_name, 'Business Type Name'));
    
            $data['title'] = 'Business Types';
            $data['search_options'] = $search_options;

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

        public function search_proprietor() 
        {
            $sql_search_condition = '';

            $business_type_name = $this->input->post('business_type_name_search_param');
            $status_array = $this->input->post('status_array_search_param') == NULL ? 'null' : $this->input->post('status_array_search_param');

            if($business_type_name != NULL && !empty($business_type_name))
            {
                $sql_search_condition .= ' AND business_type.business_type_name = "'. $business_type_name . '"';
            }

            if($status_array != 'null' )
            {
                $sql_search_condition .= ' AND business_type.business_type_status = '. $business_type_status;
            }
        
            //set serach sessions
            $this->session->set_userdata('business_types_search_params', $sql_search_condition);
            redirect('business-types/all-business-types');
            
        }
    }
    
?>