<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require_once "./application/modules/admin/controllers/Admin.php";

    class Activities extends admin
    {

        function __construct()
        {
            parent:: __construct();
        }

        public function all_activities()
        {
            $arr = array('1', '12', 'sam', '1992');
            $v_data['here'] = $arr ;
            $data['content'] = $this->load->view('activity/all_activities', $v_data, TRUE);
            $this->load->view('layouts/layout', $data);       
        }
    }
        ?>