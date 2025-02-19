<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTables extends Migration
{
    public function up()
    {
        // Tabel tb_admin
        $this->forge->addField([
            'id_admin' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'password' => [
                'type' => 'TEXT',
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
        $this->forge->addKey('id_admin', true);
        $this->forge->createTable('tb_admin');

        // Tabel tb_kelas
        $this->forge->addField([
            'id_kelas' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kelas' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
        ]);
        $this->forge->addKey('id_kelas', true);
        $this->forge->createTable('tb_kelas');

        // Tabel tb_siswa
        $this->forge->addField([
            'id_siswa' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nisn' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'nama_siswa' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'id_kelas' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'jenis_kelamin' => [
                'type'       => 'ENUM',
                'constraint' => ['L', 'P'],
            ],
            'no_hp' => [
                'type'       => 'VARCHAR',
                'constraint' => 15,
            ],
        ]);
        $this->forge->addKey('id_siswa', true);
        $this->forge->addForeignKey('id_kelas', 'tb_kelas', 'id_kelas', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tb_siswa');

        
        
    }

    

    public function down()
    {
        $this->forge->dropTable('tb_siswa');
        $this->forge->dropTable('tb_kelas');
        $this->forge->dropTable('tb_admin');
    }
}


