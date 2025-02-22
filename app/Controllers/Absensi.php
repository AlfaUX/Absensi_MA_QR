<?php

namespace App\Controllers;

use App\Models\AbsensiModel;
use App\Models\SiswaModel;
use App\Models\KeteranganModel;
use App\Models\KelasModel;
use CodeIgniter\Controller;

class Absensi extends Controller
{
    protected $absensiModel;
    protected $siswaModel;
    protected $kelasModel;
    protected $keteranganModel;
    
    public function __construct()
    {
        $this->absensiModel = new AbsensiModel();
        $this->siswaModel   = new SiswaModel();
        $this->kelasModel   = new KelasModel();
        $this->keteranganModel = new \App\Models\KeteranganModel();
    }

    // Menampilkan daftar absensi
    public function index()
    {
        $kelas = $this->kelasModel->findAll();
        $kelasFilter = $this->request->getGet('kelas');
        $absensi = $this->absensiModel->getAbsensiByKelas($kelasFilter);
        $data['absensi'] = $this->absensiModel->findAll(); // Ambil data absensi
        $data['keterangan'] = $this->keteranganModel->findAll(); // Ambil data keterangan absensi

        return view('absensi/index', [
            'title' => 'Data Absensi',
            'kelas' => $kelas,
            'absensi' => $absensi
        ]);
    }

    // Scan QR Code dan Simpan Absensi
    public function scan()
    {
        return view('absensi/scan', ['title' => 'Scan QR Code']);
    }

    // Proses hasil scan QR
    public function prosesScan()
    {
        $request = service('request');
        $nisn = $request->getPost('qr_code'); // NISN dikodekan dalam QR
    
        if (!$nisn) {
            return $this->response->setJSON(['keterangan' => 'error', 'message' => 'QR Code tidak valid.']);
        }
    
        // Cari siswa berdasarkan NISN
        $siswa = $this->absensiModel->getSiswaByNisn($nisn);
        if (!$siswa) {
            return $this->response->setJSON(['keterangan' => 'error', 'message' => 'Siswa tidak ditemukan.']);
        }
    
        $id_siswa = $siswa['id_siswa'];
        $tanggal_hari_ini = date('Y-m-d');
        $waktu_hari_ini = date('H:i:s');
    
        // Cek jumlah absensi hari ini
        $jumlah_absensi = $this->absensiModel->hitungAbsensiHarian($id_siswa, $tanggal_hari_ini, $waktu_hari_ini);
    
        if ($jumlah_absensi >= 1) {
            return $this->response->setJSON([
                'keterangan' => 'sudah_absen',
                'message' => 'Anda sudah absen hari ini, absensi ditolak!'
            ]);
        }
        
    
        // Ambil ID keterangan default (misalnya "Hadir")
        $id_keterangan = $this->absensiModel->getIdKeterangan('Hadir');
    
        if (!$id_keterangan) {
            return $this->response->setJSON(['keterangan' => 'error', 'message' => 'Kategori absensi tidak ditemukan.']);
        }

        date_default_timezone_set('Asia/Jakarta');
    
        // Simpan absensi
        $data = [
            'id_siswa' => $id_siswa,
            'waktu_absensi' => date('Y-m-d H:i:s'),
            'tanggal'=> date('Y-m-d', strtotime(date('d-m-Y'))), // Mengubah format
            'waktu' => date('H:i:s'),
            'id_keterangan' => $id_keterangan,
        ];
        $this->absensiModel->insert($data);
    
        return $this->response->setJSON([
            'keterangan' => 'success',
            'message' => 'Absensi berhasil!',
            'siswa' => $siswa
        ]);
    }           
    
    
    public function edit($id)
    {
        $absensiModel = new AbsensiModel();
        $keteranganModel = new KeteranganModel();
    
        // JOIN absensi dan siswa berdasarkan NISN
        $absensi = $absensiModel
            ->select('tb_absensi.*, tb_siswa.nama_siswa')
            ->join('tb_siswa', 'tb_siswa.nisn = tb_absensi.nisn')
            ->where('tb_absensi.id_absensi', $id)
            ->first();
    
        $keterangan = $keteranganModel->findAll();
    
        if (!$absensi) {
            return redirect()->to('/absensi')->with('error', 'Data absensi tidak ditemukan');
        }
    
        return view('absensi/edit', [
            'absensi' => $absensi,
            'keterangan' => $keterangan
        ]);
        
    }
    
    public function filterAttendance()
    {
        $selectedDate = $this->request->getPost('selected_date'); // Ambil dari input form

        $attendanceData = $this->attendanceModel->where('tanggal', $selectedDate)->findAll();

        return view('pages/attendance', ['attendanceData' => $attendanceData, 'selectedDate' => $selectedDate]);
    }

    
    
    public function update()
    {
        $absensiModel = new AbsensiModel();
    
        $id = $this->request->getPost('id_absensi');
        $id_keterangan = $this->request->getPost('id_keterangan');
    
        $absensiModel->update($id, [
            'id_keterangan' => $id_keterangan
        ]);
    
        return redirect()->to('/absensi')->with('success', 'Data absensi berhasil diperbarui');
    }
    

    public function hapus($id) 
    {
        $this->absensiModel->delete($id);
        session()->setFlashdata('pesan', 'Data absensi berhasil dihapus!');
        return redirect()->to('absensi');
    }

    
    
}
