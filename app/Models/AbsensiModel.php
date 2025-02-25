<?php

namespace App\Models;

use CodeIgniter\Model;

class AbsensiModel extends Model
{
    protected $table = 'tb_absensi';
    protected $primaryKey = 'id_absensi';
    protected $allowedFields = ['id_siswa','id_kelas','nisn','nama_siswa', 'kelas', 'tanggal', 'jam_masuk', 'jam_pulang', 'id_keterangan'];

    // Ambil data absensi berdasarkan kelas
    public function getAbsensiByKelas($kelas_id = null)
    {
        $builder = $this->db->table('tb_absensi a');
        $builder->select('a.id_absensi, s.nisn, s.nama_siswa, k.kelas, a.tanggal, a.jam_masuk, a.jam_pulang, kt.keterangan');
        $builder->join('tb_siswa s', 's.id_siswa = a.id_siswa');
        $builder->join('tb_kelas k', 'k.id_kelas = s.id_kelas');
        $builder->join('tb_keterangan kt', 'kt.id_keterangan = a.id_keterangan');
        
        if ($kelas_id) {
            $builder->where('s.id_kelas', $kelas_id);
        }
        
        return $builder->get()->getResultArray();
    }

    // Cari siswa berdasarkan NISN
    public function getSiswaByNisn($nisn)
    {
        return $this->db->table('tb_siswa')->where('nisn', $nisn)->get()->getRowArray();
    }

    // Insert absensi dengan jam_masuk yang benar
    public function insertAbsensi($data)
    {
        return $this->db->table('tb_absensi')->insert([
            'id_siswa'      => $data['id_siswa'],
            'id_keterangan' => $data['id_keterangan'],
            'tanggal'       => date('Y-m-d'),
            'jam_masuk'         => date('H:i:s') // Perbaikan penulisan jam_masuk
        ]);
    }

    // Ambil ID keterangan berdasarkan nama keterangan
    public function getIdKeterangan($keterangan)
    {
        $result = $this->db->table('tb_keterangan')->where('keterangan', $keterangan)->get()->getRowArray();
        return $result ? $result['id_keterangan'] : null;
    }

    // Menghitung jumlah absensi siswa dalam satu hari
    public function hitungAbsensiHarian($id_siswa, $tanggal)
    {
        return $this->db->table('tb_absensi')
            ->where('id_siswa', $id_siswa)
            ->where('tanggal', $tanggal)
            ->countAllResults();
    }

    // Ambil semua data absensi lengkap
    public function getAll()
    {
        return $this->db->table('tb_absensi')
            ->select('tb_absensi.*, tb_siswa.nisn, tb_siswa.nama_siswa, tb_kelas.kelas, tb_keterangan.keterangan')
            ->join('tb_siswa', 'tb_siswa.id_siswa = tb_absensi.id_siswa')
            ->join('tb_kelas', 'tb_kelas.id_kelas = tb_siswa.id_kelas')
            ->join('tb_keterangan', 'tb_keterangan.id_keterangan = tb_absensi.id_keterangan')
            ->get()
            ->getResultArray();
    }
    
}