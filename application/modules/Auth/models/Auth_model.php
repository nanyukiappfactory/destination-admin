<?php
if (!defined('BASEPATH')) { exit('No direct access script allowed'); }
    class Auth_model extends CI_Model
    {
        public function validate_administrator($username, $password)
        {
            if($username == "admin" && $password == md5(123456))
            {
                $sess_array = array(
                    'username' => $username,
                    'login_status' => TRUE
                );
                $this->session->set_userdata('login_status', $sess_array);
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }
        public function check_login_status()
        {
            if($this->session->userdata('login_status'))
            {
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }
    }

?>