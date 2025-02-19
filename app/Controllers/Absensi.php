<?php

namespace App\Controllers;

use App\Models\AbsensiModel;
use App\Models\SiswaModel;
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
    
        // Cek jumlah absensi hari ini
        $jumlah_absensi = $this->absensiModel->hitungAbsensiHarian($id_siswa, $tanggal_hari_ini);
    
        if ($jumlah_absensi >= 2) {
            return $this->response->setJSON([
                'keterangan' => 'error',
                'message' => 'Anda sudah absen 2 kali hari ini, absensi ditolak!'
            ]);
        }
    
        // Ambil ID keterangan default (misalnya "Hadir")
        $id_keterangan = $this->absensiModel->getIdKeterangan('Hadir');
    
        if (!$id_keterangan) {
            return $this->response->setJSON(['keterangan' => 'error', 'message' => 'Kategori absensi tidak ditemukan.']);
        }
    
        // Simpan absensi
        $data = [
            'id_siswa' => $id_siswa,
            'waktu_absensi' => date('Y-m-d H:i:s'),
            'id_keterangan' => $id_keterangan,
        ];
        $this->absensiModel->insert($data);
    
        return $this->response->setJSON([
            'keterangan' => 'success',
            'message' => 'Absensi berhasil!',
            'siswa' => $siswa
        ]);
    }
    
    public function update($id)
    {
        $id_keterangan = $this->request->getPost('id_keterangan');
        $this->absensiModel->update($id, ['id_keterangan' => $id_keterangan]);

        return redirect()->to('/absensi')->with('pesan', 'Keterangan absensi berhasil diperbarui.');
    }

    public function hapus($id)
    {
        $this->absensiModel->delete($id);
        return redirect()->to(base_url('absensi'))->with('success', 'Data berhasil dihapus');
    }    
    
}
