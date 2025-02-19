<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTbAbsensiKeterangan extends Migration
{
    public function up()
    {
        // Tabel tb_keterangan
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'keterangan' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tb_keterangan');

        // Tabel tb_absensi
        $this->forge->addField([
            'id_absensi' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_siswa' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'tanggal' => [
                'type' => 'DATE',
            ],
            'waktu' => [
                'type' => 'TIME',
            ],
            'id_keterangan' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_absensi', true);
        $this->forge->addForeignKey('id_siswa', 'tb_siswa', 'id_siswa', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_keterangan', 'tb_keterangan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tb_absensi');
    }

    public function down()
    {
        $this->forge->dropTable('tb_absensi');
        $this->forge->dropTable('tb_keterangan');
    }
}
