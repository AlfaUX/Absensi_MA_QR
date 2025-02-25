<?php

namespace App\Controllers;

use App\Models\AbsensiModel;
use App\Models\SiswaModel;
use App\Models\KeteranganModel;
use App\Models\KelasModel;
use CodeIgniter\Controller;

class AbsensiController extends Controller
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
        return view('absensi/scan_qr', ['title' => 'Scan QR Code']);
    }

    public function prosesScan()
    {
        $request = service('request');
        $nisn = $request->getPost('qr_code'); // NISN from QR
        $type = $request->getPost('type'); // Get type (datang/pulang)
        
        if (!$nisn) {
            return $this->response->setJSON(['keterangan' => 'error', 'message' => 'QR Code tidak valid.']);
        }
        
        // Get student data by NISN
        $siswa = $this->siswaModel->where('nisn', $nisn)->first();
        if (!$siswa) {
            return $this->response->setJSON(['keterangan' => 'error', 'message' => 'Siswa tidak ditemukan.']);
        }
        
        $id_siswa = $siswa['id_siswa'];
        $tanggal_hari_ini = date('Y-m-d');
        
        // Check if it's entry (datang) or exit (pulang)
        if ($type == 'datang') {
            // Check if already attended today
            $jumlah_absensi = $this->absensiModel->where('id_siswa', $id_siswa)
                                                 ->where('tanggal', $tanggal_hari_ini)
                                                 ->countAllResults();
            
            if ($jumlah_absensi >= 1) {
                return $this->response->setJSON([
                    'keterangan' => 'sudah_absen',
                    'message' => 'Anda sudah absen datang hari ini!'
                ]);
            }
            
            // Get attendance status (e.g., "Hadir")
            $id_keterangan = $this->keteranganModel->where('keterangan', 'Hadir')->first()['id_keterangan'];
            
            date_default_timezone_set('Asia/Jakarta');
            // Save new attendance record
            $data = [
                'id_siswa' => $id_siswa,
                'nisn' => $nisn, // Make sure to store NISN for later reference
                'tanggal' => $tanggal_hari_ini,
                'jam_masuk' => date('H:i:s'),
                'id_keterangan' => $id_keterangan,
            ];
            $this->absensiModel->insert($data);
            
            return $this->response->setJSON([
                'keterangan' => 'success',
                'message' => 'Absensi datang berhasil!',
                'siswa' => $siswa
            ]);
        } 
        // Handle exit attendance (pulang)
        else if ($type == 'pulang') {
            // Look for today's attendance record for this student
            $absensi = $this->absensiModel->where('id_siswa', $id_siswa)
                                          ->where('tanggal', $tanggal_hari_ini)
                                          ->first();
            
            // If no entry attendance found
            if (!$absensi) {
                return $this->response->setJSON([
                    'keterangan' => 'error',
                    'message' => 'Anda belum melakukan absensi datang hari ini!'
                ]);
            }
            
            // If exit attendance already recorded
            if (!empty($absensi['jam_pulang'])) {
                return $this->response->setJSON([
                    'keterangan' => 'sudah_absen',
                    'message' => 'Anda sudah melakukan absensi pulang hari ini!'
                ]);
            }
            
            date_default_timezone_set('Asia/Jakarta');
            // Update the existing attendance record with exit time
            $this->absensiModel->update($absensi['id_absensi'], [
                'jam_pulang' => date('H:i:s')
            ]);
            
            return $this->response->setJSON([
                'keterangan' => 'success',
                'message' => 'Absensi pulang berhasil!',
                'siswa' => $siswa
            ]);
        }
        
        // Invalid attendance type
        return $this->response->setJSON([
            'keterangan' => 'error',
            'message' => 'Tipe absensi tidak valid!'
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