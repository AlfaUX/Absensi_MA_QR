<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
    protected $table = 'tb_siswa';
    protected $primaryKey = 'id_siswa';
    protected $allowedFields = ['nisn', 'nama_siswa', 'id_kelas', 'jenis_kelamin', 'no_hp'];

    public function getSiswa($kelas = null)
    {
        $builder = $this->db->table($this->table);
        $builder->select('tb_siswa.*, tb_kelas.kelas'); 
        $builder->join('tb_kelas', 'tb_kelas.id_kelas = tb_siswa.id_kelas', 'left');

        if ($kelas) {
            $builder->where('tb_kelas.kelas', $kelas);
        }

        return $builder->get()->getResultArray();
    }
}
