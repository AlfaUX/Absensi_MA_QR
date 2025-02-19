<?php

namespace App\Models;

use CodeIgniter\Model;

class AbsensiModel extends Model
{
    protected $table = 'tb_absensi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_siswa', 'waktu_absensi', 'id_keterangan'];

    // Ambil data absensi berdasarkan kelas
    public function getAbsensiByKelas($kelas = null)
    {
        $builder = $this->db->table('tb_absensi')
                            ->select('tb_absensi.*, tb_siswa.nisn, tb_siswa.nama_siswa, tb_kelas.kelas, tb_keterangan.keterangan')
                            ->join('tb_siswa', 'tb_siswa.id_siswa = tb_absensi.id_siswa')
                            ->join('tb_kelas', 'tb_kelas.id_kelas = tb_siswa.id_kelas')
                            ->join('tb_keterangan', 'tb_keterangan.id = tb_absensi.id_keterangan');

        if ($kelas) {
            $builder->where('tb_siswa.id_kelas', $kelas);
        }

        return $builder->get()->getResultArray();
    }

    // Cari siswa berdasarkan NISN
    public function getSiswaByNisn($nisn)
    {
        return $this->db->table('tb_siswa')->where('nisn', $nisn)->get()->getRowArray();
    }

    public function insertAbsensi($data)
    {
        return $this->db->table('tb_absensi')->insert([
            'id_siswa'     => $data['id_siswa'],
            'id_keterangan' => $data['id_keterangan'],
            'tanggal'      => date('Y-m-d') // Pastikan tanggal diisi dengan format benar
        ]);
    }


    // Ambil ID keterangan berdasarkan nama keterangan
    public function getIdKeterangan($keterangan)
    {
        $result = $this->db->table('tb_keterangan')->where('keterangan', $keterangan)->get()->getRowArray();
        return $result ? $result['id'] : null;
    }

    // Menghitung jumlah absensi siswa dalam satu hari
    public function hitungAbsensiHarian($id_siswa, $tanggal)
    {
        return $this->db->table('tb_absensi')
            ->where('id_siswa', $id_siswa)
            ->where('DATE(waktu_absensi)', $tanggal)
            ->countAllResults();
    }



    public function getAll()
    {
        return $this->db->table('tb_absensi')
            ->select('tb_absensi.id_siswa, tb_siswa.nama_siswa, tb_keterangan.keterangan, tb_absensi.tanggal')
            ->join('tb_siswa', 'tb_absensi.id_siswa = tb_siswa.id_siswa') 
            ->join('tb_keterangan', 'tb_absensi.id_keterangan = tb_keterangan.id') 
            ->get()
            ->getResultArray();
    }
    

}
