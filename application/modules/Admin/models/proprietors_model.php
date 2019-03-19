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
    public function get_all_proprietors($where, $limit, $order, $order_method, $start)
    {
        $this->db->select('*');
        $this->db->from('proprietor');
        $this->db->where($where );
        $this->db->limit($limit, $start);
        $this->db->order_by($order, $order_method);
        return $this->db->get();
    }
    public function all_proprietors()
    {
        $this->db->select('*');
        $this->db->from('proprietor');
        $this->db->where('deleted = 0');
        return $this->db->get();
    }

    public function count_proprietors()
    {
        $this->db->where('deleted = 0');
        $query = $this->db->get('proprietor')->num_rows();
        return $query;
    }
}
?>