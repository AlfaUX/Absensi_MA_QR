<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAbsensiTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true, 'unsigned' => true],
            'nisn'      => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'tanggal'       => ['type' => 'DATE'],
            'absen_masuk'   => ['type' => 'TIME', 'null' => true],
            'absen_pulang'  => ['type' => 'TIME', 'null' => true],
            'keterangan'    => ['type' => 'ENUM', 'constraint' => ['Masuk', 'Terlambat', 'Izin', 'Alpha', 'Tanpa Keterangan'], 'default' => 'Tanpa Keterangan'],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('nisn', 'siswa', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('absensi');
    }

    public function down()
    {
        $this->forge->dropTable('absensi');
    }
}
