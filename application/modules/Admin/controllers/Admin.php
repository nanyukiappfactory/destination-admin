<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MX_Controller
{
    function __construct()
    {
        parent :: __construct();
        $this->load->model('auth/auth_model');
        if($this->auth_model->check_login_status() == FALSE)
        {
            redirect('login');
        }
    }

    public function index()
    {     
        
        $this->session->set_flashdata('success', 'Welcome back Admin');
       redirect('activities/all-activities');
    }

    public function admin_logout()
    {
        $this->session->sess_destroy();
        redirect("login");
    }

}

?>
