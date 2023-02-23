<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'nama' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255'
            ],
            'username' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'unique' => true
            ],
            'password' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ]
        ]);

        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('users', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
