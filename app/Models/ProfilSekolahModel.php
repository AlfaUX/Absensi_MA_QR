<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfilSekolahModel extends Model
{
    protected $table      = 'profil_sekolah';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_sekolah', 'alamat', 'tahun_pelajaran', 'logo', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}
