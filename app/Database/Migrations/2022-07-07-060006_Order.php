<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Order extends Migration
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
            'order_id' => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true
			],
            'barang_id' => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true
			],
            'nama_barang' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255'
            ],
            'jumlah' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'berat' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'harga' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
        ]);

        $this->forge->addKey('id', TRUE);
        $this->forge->addForeignKey('order_id', 'orders', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('barang_id', 'barang', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('order_products', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('order_products');
    }
}
