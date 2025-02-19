<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KeteranganSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['keterangan' => 'Hadir'],
            ['keterangan' => 'Terlambat'],
            ['keterangan' => 'Sakit'],
            ['keterangan' => 'Izin'],
            ['keterangan' => 'Alpha'],
        ];

        $this->db->table('tb_keterangan')->insertBatch($data);
    }
}
