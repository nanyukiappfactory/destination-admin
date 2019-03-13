<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require_once "./application/modules/admin/controllers/Admin.php";

    class Activities extends admin
    {

        function __construct()
        {
            parent:: __construct();
        }

        public function index()
        {
            $this->load->view('layouts/layout');       
        }
    }
        ?>