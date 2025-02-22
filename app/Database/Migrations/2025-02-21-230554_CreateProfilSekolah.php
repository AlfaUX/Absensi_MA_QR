<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProfilSekolah extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'              => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true, 'auto_increment' => true],
            'nama_sekolah'    => ['type' => 'VARCHAR', 'constraint' => 255],
            'alamat'          => ['type' => 'TEXT'],
            'tahun_pelajaran' => ['type' => 'VARCHAR', 'constraint' => 20],
            'logo'            => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'created_at'      => ['type' => 'DATETIME', 'null' => true],
            'updated_at'      => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('profil_sekolah');
    }

    public function down()
    {
        $this->forge->dropTable('profil_sekolah');
    }
}
