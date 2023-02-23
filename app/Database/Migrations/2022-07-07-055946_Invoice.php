<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Invoice extends Migration
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
            'user_id' => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true
			],
            'alamat' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'           => true
            ],
            'provinsi' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'           => true
            ],
            'kota' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'           => true
            ],
            'kurir' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'           => true
            ],
            'total_jumlah' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'total_harga' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'total_berat' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'tgl_pesan' => [
                'type'           => 'DATETIME',
            ],
            'batas_bayar' => [
                'type'           => 'DATETIME',
            ],
            'metode_pembayaran' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'           => true
            ],
            'status' => [
                'type' => 'ENUM("cart", "dikonfirmasi", "dikirim")',
                'default' => 'cart'
            ]
        ]);

        $this->forge->addKey('id', TRUE);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('orders', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('orders');
    }
}