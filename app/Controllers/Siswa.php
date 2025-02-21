<?php

namespace App\Controllers;

use App\Models\SiswaModel;
use App\Models\KelasModel;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;


class Siswa extends BaseController
{
    protected $siswaModel;
    protected $kelasModel;

    public function __construct()
    {
        $this->siswaModel = new SiswaModel();
        $this->kelasModel = new KelasModel();
    }

    public function index()
    {
        
        $model = new SiswaModel();
        $data['siswa'] = $this->siswaModel->findAll();
        $kelas = $this->request->getGet('kelas');
        $data = [
            'title' => 'Daftar Siswa',
            'siswa' => $this->siswaModel->getSiswa($kelas),
            'kelas' => $this->kelasModel->table('tb_kelas')->findAll()
        ];

        return view('siswa/index', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Siswa',
            'kelas' => $this->kelasModel->table('tb_kelas')->findAll()
        ];
        return view('siswa/tambah', $data);
    }

    public function simpan()
    {
        if (!$this->validate([
            'nisn' => 'required',
            'nama_siswa' => 'required',
            'id_kelas' => 'required|integer',
            'jenis_kelamin' => 'required',
            'no_hp' => 'required'
        ])) {
            return redirect()->to('/siswa/tambah')->withInput();
        }

        $this->siswaModel->save([
            'nisn' => $this->request->getPost('nisn'),
            'nama_siswa' => $this->request->getPost('nama_siswa'),
            'id_kelas' => $this->request->getPost('id_kelas'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'no_hp' => $this->request->getPost('no_hp')
        ]);

        session()->setFlashdata('pesan', 'Data siswa berhasil ditambahkan!');
        return redirect()->to('/siswa');
    }

        public function edit($id)
    {
        $siswa = $this->siswaModel->find($id);

        if (!$siswa) {
            return redirect()->to('/siswa')->with('error', 'Data siswa tidak ditemukan');
        }

        $data = [
            'title' => 'Edit Siswa',
            'siswa' => $this->siswaModel->find($id),
            'kelas' => $this->kelasModel->table('tb_kelas')->findAll()
        ];
        return view('siswa/edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            'nisn' => 'required',
            'nama_siswa' => 'required',
            'id_kelas' => 'required|integer',
            'jenis_kelamin' => 'required',
            'no_hp' => 'required'
        ])) {
            return redirect()->to('/siswa/edit/' . $id)->withInput();
        }

        $this->siswaModel->update($id, [
            'nisn' => $this->request->getPost('nisn'),
            'nama_siswa' => $this->request->getPost('nama_siswa'),
            'id_kelas' => $this->request->getPost('id_kelas'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'no_hp' => $this->request->getPost('no_hp')
        ]);

        session()->setFlashdata('pesan', 'Data siswa berhasil diperbarui!');
        return redirect()->to('/siswa');
    }

    public function hapus($id) 
    {
        $this->siswaModel->delete($id);
        session()->setFlashdata('pesan', 'Data siswa berhasil dihapus!');
        return redirect()->to('/siswa');
    }

    public function generate($id)
    {
        $model = new SiswaModel();
        $siswa = $model->find($id);
    
        if (!$siswa) {
            return redirect()->to('/siswa')->with('error', 'Siswa tidak ditemukan');
        }
    
        // Gunakan alias untuk menghindari bentrok nama kelas
        $qrCode = \Endroid\QrCode\QrCode::create($siswa['nisn'])
            ->setSize(300)
            ->setMargin(10);
        
        $writer = new \Endroid\QrCode\Writer\PngWriter();
        $result = $writer->write($qrCode);
    
        $filename = 'QR_' . $siswa['nisn'] . '.png';
        return $this->response
            ->setHeader('Content-Type', 'image/png')
            ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->setBody($result->getString());
    }
    
}
