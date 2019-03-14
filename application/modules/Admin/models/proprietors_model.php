<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Proprietors_model extends CI_Model
{
    public function add_proprietor()
    {

        $data = array(
            'first_name' => $this->input->post('first_name'), 
            'last_name' => $this->input->post('last_name'),
            'proprietor_phone' => $this->input->post('proprietor_phone'),
            'national_id' => $this->input->post('national_id'),
            'business_reg_id' => $this->input->post('business_reg_id'),
            'created_by' => 1,
            'modified_by' => 0,
            'modified_on' => date('Y/m/d H:i:s'),
            'created_on' => date('Y/m/d H:i:s'),
        );

        if ($this->db->insert('proprietor', $data)) {
            $insert_id = $this->db->insert_id();
            return $insert_id;

        } else {
            return false;
        }

    }
}
?>