<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateGuruTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_guru' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nuptk' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],
            'nama_guru' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'jenis_kelamin' => [
                'type'       => 'ENUM',
                'constraint' => ['Laki-laki', 'Perempuan'],
            ],
            'no_hp' => [
                'type'       => 'VARCHAR',
                'constraint' => 15,
                'null'       => true,
            ],
            'qr_code' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true, // Untuk menyimpan path/URL QR Code
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
        ]);

        $this->forge->addKey('id_guru', true);
        $this->forge->createTable('tb_guru'); // Nama tabel diperbarui di sini
    }

    public function down()
    {
        $this->forge->dropTable('tb_guru'); // Pastikan ini juga diperbarui
    }
}
