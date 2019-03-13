<?php
!defined('BASEPATH') or exit('no direct script access allowed');

class Migration_Add_proprietor extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(array(
            'proprietor_id'=>array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
                'null'=>false

            ),
            'first_name'=>array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null'=>false

            ),
            'last_name'=>array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null'=>false

            ),
            'proprietor_phone'=>array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null'=>false,

            ),
            'national_id'=>array(
                'type' => 'VARCHAR',
                'constraint' => '8',
                'null'=>false

            ),
            'business_reg_id'=>array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null'=>false

            ),
            'proprietor_status'=>array(
                'type' => 'TINYINT',
                'constraint' => '1',
                'null'=>false,
                'default'=>'1'

            ),
            'deleted'=>array(
                'type' => 'TINYINT',
                'constraint' => '1',
                'null'=>false,
                'default'=>'0'
            ),
            'deleted_by'=>array(
                'type' => 'INT',
                'constraint' => '11',
                'null'=>true

            ),
            
            'deleted_on'=>array(
                'type' => 'DATETIME',
                'null'=>true

            ),
            'created_on'=>array(
                'type' => 'DATETIME',
                'null'=>false,

            ),
            'created_by'=>array(
                'type' => 'INT',
                'constraint' => '11',
                'null'=>false


            ),
            'modified_by'=>array(
                'type' => 'INT',
                'constraint' => '11',
                'null'=>false

            ),
            'modified_on'=>array(
                'type' => 'TIMESTAMP',
                'null'=>false,
                'onupdate'=>'CURRENT_TIMESTAMP'

            )       
        ));
        $this->dbforge->add_key('proprietor_id', true);
        $this->dbforge->create_table('proprietor');
    }

    
   public function down()
   {
       $this->dbforge->drop_table('proprietor');
   }
}

?>