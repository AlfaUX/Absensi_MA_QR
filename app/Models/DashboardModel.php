<?php 
// app/Models/DashboardModel.php
namespace App\Models;

use CodeIgniter\Model;

class DashboardModel extends Model
{
    // Menghitung jumlah siswa
    public function getStudentCount()
    {
        return $this->db->table('tb_siswa')->countAllResults();
    }


    // Menghitung jumlah admin
    public function getAdminCount()
    {
        return $this->db->table('tb_admin')->countAllResults(); 
    }

    // Persentase kehadiran hari ini
    public function getTodayAttendance()
    {
        $today = date('Y-m-d');
        $builder = $this->db->table('tb_absensi');
        $total = $builder->where('tanggal', $today)->countAllResults();

        $hadir = $this->db->table('tb_absensi')
                         ->where('tanggal', $today)
                         ->where('id_keterangan', 'hadir')
                         ->countAllResults();

        return $total > 0 ? round(($hadir / $total) * 100, 1) : 0;
    }

    // Statistik kehadiran selama 7 hari terakhir
    public function getWeeklyAttendance()
    {
        $builder = $this->db->table('tb_absensi');
        $builder->select("DATE_FORMAT(tanggal, '%W') as hari, 
        COUNT(CASE WHEN id_keterangan = 'hadir' THEN 1 END) * 100.0 / COUNT(*) as persentase");
        $builder->where('tanggal >=', date('Y-m-d', strtotime('-7 days')));
        $builder->groupBy('hari');
        $builder->orderBy('MIN(tanggal)', 'ASC');  // Agregasi untuk ORDER BY

        return $builder->get()->getResultArray();
    }

    // Statistik kehadiran per kelas hari ini
    public function getClassAttendance()
    {
        $today = date('Y-m-d');
        $builder = $this->db->table('tb_absensi a');
        $builder->select("kelas,
                          COUNT(CASE WHEN a.id_keterangan = 'hadir' THEN 1 END) as jumlah_hadir,
                          COUNT(CASE WHEN a.id_keterangan != 'hadir' THEN 1 END) as jumlah_tidak_hadir,
                          (COUNT(CASE WHEN a.id_keterangan = 'hadir' THEN 1 END) * 100.0) / COUNT(*) as persentase");
        $builder->where('a.tanggal', $today);
        $builder->groupBy('kelas');
        
        return $builder->get()->getResultArray();
    }
}
