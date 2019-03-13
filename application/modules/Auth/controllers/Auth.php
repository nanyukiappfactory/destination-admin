<?php

class Auth extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();

<<<<<<< HEAD
        public function index()
        {
            $this->form_validation->set_rules('admin_name', '', 'required');
            $this->form_validation->set_rules('admin_password', '', 'required');
=======
        $this->load->model('auth_model');
    }
>>>>>>> fe34edc15d0f87f6a2d1b438e0b8125393b7b0f4

    public function index()
    {
  
        // $this->load->view('admin/layouts/layout', $data);
        $this->form_validation->set_rules('admin_username', 'inputUsername', 'required');
        $this->form_validation->set_rules('admin_password', 'inputPassword', 'required');
        
        if ($this->form_validation->run() == true) {
            $admin_username = $this->input->post('admin_username');
            $admin_password = md5($this->input->post('admin_password'));

            if ($this->auth_model->validate_administrator($admin_username, $admin_password) == true) {
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('error', 'Incorrect Username or Password');
            }
        }
        $this->load->view('login_layout');
    }
}
