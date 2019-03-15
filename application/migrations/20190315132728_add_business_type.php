<?php

defined('BASEPATH') or exit('no direct script access allowed');

class Migration_Add_business_type extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(array(
            'business_type_id'=>array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
                'null' => false
            ),
            'business_type_name'=>array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => false
            ),
            'business_type_status'=>array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'default'=>'1',
                'null' => false
            ),
            'deleted'=>array(
                'type' => 'TINYINT',
                'constraint' => '1',
                'null'=>false,
                'default'=>'0'
            ),
            'deleted_on'=>array(
                'type' => 'DATETIME',
                'null' => true
            ),
            'deleted_by'=>array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => true
            ),
            'modified_by'=>array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => true
            ),    
            'modified_on'=>array(
                'type' => 'TIMESTAMP',
                'null' => false,
                'onupdate' => 'CURRENT_TIMESTAMP'
            ),          
            'created_on'=>array(
                'type' => 'DATETIME',
                'null' => true
            ),        
            'created_by'=>array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => false
            ),
        ));
        $this->dbforge->add_key('business_type_id', true);
        $this->dbforge->create_table('business_type');
    }

    public function down()
    {
        $this->dbforge->drop_table('business_type');
    }
}
?>