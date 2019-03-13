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

            ),
            'deleted'=>array(

            ),
            'deleted_on'=>array(

            ),
            'deleted_by'=>array(

            ),
            'modified_by'=>array(

            ),
            
            'modified_on'=>array(

            ),
            
            'creation_on'=>array(

            ),
            
            'created_by'=>array(

            ),
        ));
    }

    public function down()
    {

    }
}
?>