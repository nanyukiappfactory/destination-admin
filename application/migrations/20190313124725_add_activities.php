<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Migration_Add_activities extends CI_Migration{

    public function up()
    {
        $this->dbforge->add_field(array(
            'activity_id' =>array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
                'null' => false
            ),
            'activity_name' => array( 
                'type' => 'VARCHAR',
                'constraint' =>'100',
                'null' => false
            ),
            'activity_description' => array(
                'type' =>'VARCHAR',
                'constraint' => '100',
                'null' => false
            ),
            'activity_date' => array(
                'type' => 'DATETIME',
                'null' => false
            ),
            'activity_latitude' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false
            ),
            'activity_longitude' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false
            ),
            'activity_email' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => false
            ),
            'activity_phone' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => false
            ),
            'activity_status' => array(
                'type' => 'TINYINT',
                'constraint' => '1',
                'null' => false,
                'default' => 1
            ),
            'deleted' => array(
                'type' => 'TINYINT',
                'constraint' => '1',
                'null' => true
            ),
            'deleted_on' => array(
                'type' => 'TIMESTAMP',
                'null' => true
            ),
            'created_on' => array(
                'type' => 'TIMESTAMP',
                'null' => false
            ),
            'created_by' => array(
                'type' => 'VARCHAR',
                'constraint' => '32',
                'null' => false
            ),
            'modified_on' => array(
                'type' => 'TIMESTAMP',
                'null'=>false,
                'onupdate'=>'CURRENT_TIMESTAMP'
            ),
            'modified_by' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => false
            )
        ));
        $this->dbforge->add_key('activity_id', true);
        $this->dbforge->create_table('activities');
    }
    public function down()
    {
        $this->dbforge->drop_table('activities');
    }
        
}
?>