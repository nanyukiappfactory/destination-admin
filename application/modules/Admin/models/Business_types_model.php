<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Business_types_model extends CI_Model
{
    public function save_business_type()
    {   
        $data = array(
            'business_type_name' => $this->input->post('business_type_name'),
            'created_by' => 1,
            'business_type_status' => 1,
            'deleted' => 0,
            'modified_by' => 0,
            'deleted_by' => 0,
            'modified_on' => date('Y/m/d H:i:s'),
            'created_on' => date('Y/m/d H:i:s')
        );
        
        if($this->db->insert('business_type', $data))
        {
            $insert_id = $this->db->insert_id();
            return  $insert_id;
        }
        else
        {
            return FALSE;
        }
    }
    
    public function single_business_type($business_type_id)
    {
        $this->db->where('business_type_id', $business_type_id);
        $query = $this->db->get('business_type');

        if($query->num_rows() > 0)
        {
            return $query->row();
        }
        else
        {
            return FALSE;
        }
    }

    public function edit_business_type($id)
    {
        $data = array(
            'business_type_name' => $this->input->post('business_type_name')
        );

        $this->db->set($data);
        $this->db->where('business_type_id', $id);
        if($this->db->update('business_type'))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    public function get_business_types($where, $order, $order_method, $limit, $start)
    {
        $this->db->select("*");
        $this->db->from("business_type");
        $this->db->limit($limit, $start);
        $this->db->order_by($order, $order_method);
        $this->db->where($where);
        return $this->db->get();
    }
    
    public function activate_status($business_type_id, $new_status)
    {
        $this->db->set("business_type_status", $new_status);
        $this->db->where("business_type_id", $business_type_id);
        return $this->db->update("business_type");
    }

    public function deactivate_status($business_type_id, $new_status)
    {
        $this->db->set("business_type_status", $new_status);
        $this->db->where("business_type_id", $business_type_id);
        return $this->db->update("business_type");
    }

    public function delete($id)
    {
        $this->db->set("deleted", 1);
        $this->db->where("business_type_id", $id);
        return $this->db->update("business_type");
    }
    

    public function countAll($where)
    {
        $this->db->where($where);
        return $this->db->get("business_type")->num_rows();
    }

}

?>