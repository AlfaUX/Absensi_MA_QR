<?php

namespace App\Models;

use CodeIgniter\Model;

class KelasModel extends Model
{
    protected $table = 'tb_kelas';
    protected $primaryKey = 'id_kelas';
    protected $allowedFields = ['kelas'];

    public function getAllKelas()
    {
        return $this->distinct()->select('kelas')->findAll();
    }
}
