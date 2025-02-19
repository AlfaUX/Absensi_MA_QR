<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class KelasSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['kelas' => 'X A'],
            ['kelas' => 'X B'],
            ['kelas' => 'X C'],
            ['kelas' => 'XI A'],
            ['kelas' => 'XI B'],
            ['kelas' => 'XI C'],
            ['kelas' => 'XII A'],
            ['kelas' => 'XII B'],
            ['kelas' => 'XII C'],
        ];

        // Insert ke database
        $this->db->table('tb_kelas')->insertBatch($data);
    }
}
