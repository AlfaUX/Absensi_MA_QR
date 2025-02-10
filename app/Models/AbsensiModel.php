<?php

namespace App\Models;

use CodeIgniter\Model;

class AbsensiModel extends Model
{
    protected $table = 'absensi';  // Nama tabel di database
    protected $primaryKey = 'id';
    protected $allowedFields = ['nisn', 'absen_masuk', 'absen_pulang', 'keterangan'];

    public function cekAbsensiHariIni($siswa_id)
    {
        return $this->where('siswa_id', $siswa_id)
                    ->where('DATE(absen_masuk)', date('Y-m-d'))
                    ->first();
    }
}
