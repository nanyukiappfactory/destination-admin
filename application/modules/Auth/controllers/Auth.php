<?php 
require_once "./application/modules/admin/controllers/Admin.php";
if(!defined('BASEPATH')) exit('No direct access script allowed');
    
    class Auth extends MX_Controller
    {
        function __construct()
        {
            parent:: __construct();

            $this->load->model('auth_model');
        }

        public function index()
        {
            echo 'kibaki';
            $this->form_validation->set_rules('admin_name', '', 'required');
            $this->form_validation->set_rules('admin_password', '', 'required');

            if($this->form_validation->run() == TRUE)
            {
                $admin_username = $this->input->post('admin_name');
                $admin_password= md5($this->input->post('admin_password'));

                if($this->auth_model->validate_administrator($username, $password) == TRUE)
                {
                    redirect('dashboard');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Incorrect Username or Password');
                    redirect('login');
                }
            }
        }
    }
?>