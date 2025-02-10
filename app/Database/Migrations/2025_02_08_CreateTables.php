<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTables extends Migration
{
    public function up()
    {
        // Tabel Admin
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'auto_increment' => true],
            'username'    => ['type' => 'VARCHAR', 'constraint' => 100],
            'password'    => ['type' => 'VARCHAR', 'constraint' => 255],
            'created_at'  => ['type' => 'DATETIME'],
            'updated_at'  => ['type' => 'DATETIME'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('admin');

        // Tabel Guru
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'auto_increment' => true],
            'nama'       => ['type' => 'VARCHAR', 'constraint' => 100],
            'email'      => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'nuptk'      => ['type' => 'VARCHAR', 'constraint' => 20, 'unique' => true],
            'created_at' => ['type' => 'DATETIME'],
            'updated_at' => ['type' => 'DATETIME'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('guru');

        // Tabel Siswa
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'auto_increment' => true],
            'nama'       => ['type' => 'VARCHAR', 'constraint' => 100],
            'email'      => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'nisn'       => ['type' => 'VARCHAR', 'constraint' => 20, 'unique' => true],
            'nis'        => ['type' => 'VARCHAR', 'constraint' => 20, 'unique' => true],
            'created_at' => ['type' => 'DATETIME'],
            'updated_at' => ['type' => 'DATETIME'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('siswa');

        // Tabel Absensi
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'auto_increment' => true],
            'user_id'    => ['type' => 'INT'],
            'role'       => ['type' => 'ENUM', 'constraint' => ['guru', 'siswa']],
            'tanggal'    => ['type' => 'DATE'],
            'waktu'      => ['type' => 'TIME'],
            'status'     => ['type' => 'VARCHAR', 'constraint' => 20],
            'created_at' => ['type' => 'DATETIME'],
            'updated_at' => ['type' => 'DATETIME'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('absensi');

        // Tabel Profil Sekolah
        $this->forge->addField([
            'id'            => ['type' => 'INT', 'auto_increment' => true],
            'nama_sekolah'  => ['type' => 'VARCHAR', 'constraint' => 255],
            'logo'          => ['type' => 'VARCHAR', 'constraint' => 255],
            'created_at'    => ['type' => 'DATETIME'],
            'updated_at'    => ['type' => 'DATETIME'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('profil_sekolah');
    }

    public function down()
    {
        $this->forge->dropTable('admin');
        $this->forge->dropTable('guru');
        $this->forge->dropTable('siswa');
        $this->forge->dropTable('absensi');
        $this->forge->dropTable('profil_sekolah');
    }
}
