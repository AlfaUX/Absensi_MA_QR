<?php

namespace App\Controllers;

use App\Models\AbsensiModel; // Tambahkan ini
use CodeIgniter\Controller;

class QrController extends Controller
{
    protected $absensiModel;

    public function __construct()
    {
        $this->absensiModel = new AbsensiModel(); // Pastikan model dipanggil di konstruktor
    }

    public function absen()
    {
        $qr_data = $this->request->getPost('qr_data');

        if (!$qr_data) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'QR Code tidak valid']);
        }

        // Cari siswa berdasarkan NISN dari QR Code
        $siswa = $this->absensiModel->where('nisn', $qr_data)->first();

        if (!$siswa) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Siswa tidak ditemukan']);
        }

        $tanggalHariIni = date('Y-m-d');

        // Cek apakah sudah ada absen masuk hari ini
        $absensiHariIni = $this->absensiModel
            ->where('siswa_id', $siswa['id'])
            ->where('DATE(absen_masuk)', $tanggalHariIni)
            ->first();

        if (!$absensiHariIni) {
            // Absen masuk
            $data = [
                'siswa_id' => $siswa['id'],
                'absen_masuk' => date('Y-m-d H:i:s'),
                'keterangan' => 'Masuk',
            ];

            if ($this->absensiModel->insert($data)) {
                return $this->response->setJSON(['status' => 'success', 'message' => 'Absensi masuk berhasil']);
            }
        } elseif (!$absensiHariIni['absen_pulang']) {
            // Absen pulang
            $this->absensiModel->update($absensiHariIni['id'], ['absen_pulang' => date('Y-m-d H:i:s')]);

            return $this->response->setJSON(['status' => 'success', 'message' => 'Absensi pulang berhasil']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Anda sudah absen masuk & pulang hari ini']);
        }

        return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menyimpan absensi']);
    }

}
