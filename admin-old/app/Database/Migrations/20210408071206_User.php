<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
	public function up()
	{
		$this->forge->addField([
                        'id'          => [
                                'type'           => 'INT',
                                'constraint'     => 11,
                                'auto_increment' => true,
                        ],
                        'comp_id'   => [
                                'type'           => 'INT',
                                'constraint'     => 11,
                        ],
                        'name' => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 50,
                                
                        ],
                         'password' => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '350',
                                
                        ],
                          'email' => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '350',
                                'unique'         => true,
                        ],
                        'power' => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 50,
                                
                        ],
                        'super_power'   => [
                                'type'           => 'INT',
                                'constraint'     => 11,
                                'null'           => true,
                        ],
                        'created_by' => [
                                'type'           => 'INT',
                                'constraint'     => 11,
                                
                        ],
                        'updated_at' => [
                                    'type'      => 'timestamp',
      
                        ],
                
                ]);
                $this->forge->addKey('id', true);
                $this->forge->createTable('saimtech_users');
       

	}

	public function down()
	{
		$this->forge->dropTable('saimtech_users');
	}
}
