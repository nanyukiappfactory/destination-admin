<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Business_type_model extends CI_Model
{
    public function save_business_type()
    {   
        $data = array(
            'business_type_name' => $this->input->post('business_type_name'),
            'created_by' => 1 ,
            'deleted' => 0,
            'modified_by' => 0,
            'deleted' => 0,
            'modified_on' => date('Y/m/d'),
            'created_on' => date('Y/m/d')
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

    public function all_business_types()
    {
        $this->db->select("*");
        $this->db->from("business_type");
        $this->db->where("deleted = 0");
        return $this->db->get();
    }

}

?>