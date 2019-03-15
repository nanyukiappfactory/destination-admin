<?php 
class Activity_Model extends CI_Model
{   
    protected $table = "activity";

    public function all_activities()
    {
        $this->db->select('*');
        $this->db->from('activity');
        $this->db->where('deleted = 0');
        return $this->db->get();
    }
    public function save_activity()
    {   
        $data = array(
            'activity_name' => $this->input->post('activity_name'),    
            'activity_date' => $this->input->post('activity_date'),
            'activity_longitude' => $this->input->post('activity_longitude'),
            'activity_latitude' => $this->input->post('activity_latitude'),
            'activity_phone' => $this->input->post('activity_phone'),
            'activity_email' => $this->input->post('activity_email'),
            'activity_description' => $this->input->post('activity_description'),
            'created_by' => 1 ,
            'deleted' => 0,
            'modified_by' => 0,
            'deleted' => 0,
            'modified_on' => date('Y/m/d'),
            'created_on' => date('Y/m/d')
        );

        if($this->db->insert('activity', $data))
        {
            $insert_id = $this->db->insert_id();
            return  $insert_id;
        }
        else
        {
            return FALSE;
        }
    }
  
}

?>