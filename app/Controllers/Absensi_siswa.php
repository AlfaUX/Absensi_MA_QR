<?php

namespace App\Controllers;

use App\Models\AbsensiModel;
use App\Models\SiswaModel;
use CodeIgniter\Controller;

class Absensi_siswa extends BaseController
{
    protected $absensiModel;
    protected $siswaModel;

    public function __construct()
    {
        $this->absensiModel = new AbsensiModel();
        $this->siswaModel = new SiswaModel();
    }

    public function index()
    {
        $data['absensi'] = $this->absensiModel
            ->select('absensi.*, siswa.nama, siswa.nisn')
            ->join('siswa', 'siswa.nisn = absensi.nisn')
            ->findAll();

        return view('/pages/absensi_siswa', $data);
    }

    public function scanQR()
    {
        $qrInput = $this->request->getPost('nisn');
    
        if (empty($qrInput)) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'QR Code tidak boleh kosong']);
        }
    
        // Parsing QR Code untuk menangani format lebih dari satu baris
        $qrData = explode("\n", trim($qrInput));
        $nisn = isset($qrData[1]) ? str_replace("NISN: ", "", $qrData[1]) : $qrData[0];
    
        if (empty($nisn)) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'NISN tidak valid']);
        }
    
        // Cari siswa berdasarkan NISN
        $siswa = $this->siswaModel->where('nisn', $nisn)->first();
    
        if (!$siswa) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Siswa tidak ditemukan']);
        }
    
        $jamSekarang = date('H:i:s');
        $batasTerlambat = '07:00:00';
        $tanggalHariIni = date('Y-m-d');
    
        // Cek apakah sudah ada absen masuk hari ini
        $absensiHariIni = $this->absensiModel
            ->where('nisn', $nisn) // Gunakan nisn sebagai penghubung
            ->where('DATE(absen_masuk)', $tanggalHariIni)
            ->first();
    
        if (!$absensiHariIni) {
            // Absen masuk
            $keterangan = ($jamSekarang > $batasTerlambat) ? 'Terlambat' : 'Masuk';
            $this->absensiModel->insert([
                'nisn' => $nisn, // Simpan NISN ke tabel absensi
                'absen_masuk' => date('Y-m-d H:i:s'),
                'keterangan' => $keterangan
            ]);
    
            return $this->response->setJSON(['status' => 'success', 'message' => 'Absen masuk berhasil', 'keterangan' => $keterangan]);
        } elseif (empty($absensiHariIni['absen_pulang'])) {
            // Absen pulang
            $this->absensiModel->update($absensiHariIni['id'], ['absen_pulang' => date('Y-m-d H:i:s')]);
    
            return $this->response->setJSON(['status' => 'success', 'message' => 'Absen pulang berhasil']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Anda sudah absen masuk & pulang hari ini']);
        }
    }

    
    public function updateKeterangan()
    {
        $id = $this->request->getPost('id');
        $keterangan = $this->request->getPost('keterangan');

        if (empty($id) || empty($keterangan)) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'ID dan keterangan tidak boleh kosong']);
        }

        $validKeterangan = ['Masuk', 'Terlambat', 'Izin', 'Alpha', 'Tanpa Keterangan'];
        if (!in_array($keterangan, $validKeterangan)) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Keterangan tidak valid']);
        }

        // Cek apakah data absensi ada
        $absensi = $this->absensiModel->find($id);
        if (!$absensi) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Data absensi tidak ditemukan']);
        }

        $this->absensiModel->update($id, ['keterangan' => $keterangan]);

        return $this->response->setJSON(['status' => 'success', 'message' => 'Keterangan berhasil diperbarui']);
    }
}
