<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Barang extends Migration
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
            'deskripsi' => [
                'type'           => 'TEXT',
				'constraint'     => '255'
            ],
            'satuan' => [
                'type'           => 'VARCHAR',
				'constraint'     => '255'
            ],
            'harga' => [
                'type'           => 'DOUBLE'
            ],
            'provinsi_brg' => [
                'type'           => 'VARCHAR',
				'constraint'     => '255'
            ],
            'kota_barang' => [
                'type'           => 'VARCHAR',
				'constraint'     => '255'
            ],
            'jumlah' => [
                'type'           => 'INT',
				'constraint'     => 11
            ],
            'berat' => [
                'type'           => 'INT',
				'constraint'     => 11
            ],
            'gambar' => [
                'type'           => 'VARCHAR',
				'constraint'     => '255'
            ]
        ]);

        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('barang', TRUE);
    }

    public function down()
    {
        $this->forge->createTable('barang', TRUE);
    }
}
