<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Activities_Model extends CI_Model
{
    protected $table = "activity";
    public function all_activities()
    {
        $this->db->select('*');
        $this->db->from('activity');
        $this->db->where('deleted = 0');
        return $this->db->get();
    }
    public function get_activities($where, $order, $order_method, $limit, $start)
    {
        $this->db->select('*');
        $this->db->from('activity');
        $this->db->limit($limit, $start);
        $this->db->order_by($order, $order_method);
        $this->db->where($where);
        return $this->db->get();
    }
    public function countAll($where)
    {
        $this->db->where($where);
        return $this->db->get($this->table)->num_rows();
    }

    public function save_activity($file_name, $thumb_name)
    {
        $user_id = $this->session->userdata('login_status')['id'];

        $data = array(
            'activity_name' => $this->input->post('activity_name'),
            'activity_date' => $this->input->post('activity_date'),
            'activity_longitude' => $this->input->post('activity_longitude'),
            'activity_latitude' => $this->input->post('activity_latitude'),
            'activity_phone' => $this->input->post('activity_phone'),
            'activity_email' => $this->input->post('activity_email'),
            'activity_description' => $this->input->post('activity_description'),
            'activity_image_name' => $file_name,
            'activity_thumb_name' => $thumb_name,
            'created_by' => $user_id,
            'deleted' => 0,
            'modified_by' => $user_id,
            'deleted' => 0,
            'modified_on' => date('Y/m/d H:i:s'),
            'created_on' => date('Y/m/d H:i:s'),
        );

        if ($this->db->insert('activity', $data)) {
            $insert_id = $this->db->insert_id();
            return $insert_id;
        } else {
            return false;
        }
    }
    public function edit_activity($activity_id)
    {
        $data = array(
            'activity_name' => $this->input->post('activity_name'),
            'activity_description' => $this->input->post('activity_description'),
            'activity_date' => $this->input->post('activity_date'),
            'activity_longitude' => $this->input->post('activity_longitude'),
            'activity_latitude' => $this->input->post('activity_latitude'),
            'activity_phone' => $this->input->post('activity_phone'),
            'activity_email' => $this->input->post('activity_email')
        );
        $this->db->set($data);
        $this->db->where('activity_id', $activity_id);
        if ($this->db->update('activity')) {
            return true;
        } else {
            return false;
        }
    }
    public function single_activity($activity_id)
    {
        $this->db->where('activity_id', $activity_id);
        $query = $this->db->get('activity');
        if($query->num_rows() > 0)
        {
            return $query->row();
        }
        else
        {
            return FALSE;
        }
    }
    public function activate_status($activity_id, $new_activity_status)
    {
        $this->db->set("activity_status", $new_activity_status);
        $this->db->where("activity_id", $activity_id);
        return $this->db->update("activity");
    }
    public function deactivate_status($activity_id, $new_activity_status)
    {
        $this->db->set("activity_status", $new_activity_status);
        $this->db->where("activity_id", $activity_id);
        return $this->db->update("activity");
    }
    public function delete($activity_id)
    {
        $this->db->set("deleted", 1);
        $this->db->where("activity_id", $activity_id);
        return $this->db->update("activity");
    }
}
