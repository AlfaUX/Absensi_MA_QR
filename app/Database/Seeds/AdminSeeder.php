<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'nama'      => 'Admin Rohid',
            'username'  => 'superdede',
            'password'  => password_hash('superdede', PASSWORD_DEFAULT),
            'created_at' => Time::now(),
            'updated_at' => Time::now(),
        ];

        $this->db->table('tb_admin')->insert($data);
    }
}
