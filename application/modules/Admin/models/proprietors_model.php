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
    public function single_proprietor($proprietor_id)
    {
        $this->db->where('proprietor_id', $proprietor_id);
        $query = $this->db->get('proprietor');

        if($query->num_rows() > 0)
        {
            return $query->row();
        }
        else
        {
            return FALSE;
        }
    }
    public function edit_proprietor($proprietor_id)
    {
        $data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'proprietor_phone'=>$this->input->post('proprietor_phone'),
            'national_id' =>$this->input->post('national_id'),
            'business_reg_id' =>$this->input->post('business_reg_id')
        );
        $this->db->set($data);
        $this->db->where('proprietor_id', $proprietor_id);
        if($this->db->update('proprietor'))
        {
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function count_proprietors($where)
    {
        $this->db->where($where);
        $query = $this->db->get('proprietor')->num_rows();
        return $query;
    }
}
?>