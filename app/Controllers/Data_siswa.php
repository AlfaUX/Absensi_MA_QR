<?php
namespace App\Controllers;

use App\Models\SiswaModel;
use App\Models\KelasModel;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class Data_siswa extends BaseController
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
        $db = \Config\Database::connect();
        $builder = $db->table('tb_siswa');
        $builder->select('tb_siswa.*, kelas.kelas');
        $builder->join('kelas', 'kelas.id_kelas = tb_siswa.id_kelas', 'left');
        $query = $builder->get();
    
        $siswaModel = new SiswaModel();
        $kelasModel = new KelasModel(); 
    
        $data['siswa'] = $query->getResultArray();
        $data['kelas'] = $kelasModel->findAll(); 
    
        // Debugging: cek apakah $data['kelas'] berisi data
        if (empty($data['kelas'])) {
            dd('Kelas tidak ditemukan!', $data['kelas']);
        }
    
        return view('pages/data_siswa', $data);
    }
    

    public function tambah()
    {
        $kelasModel = new \App\Models\KelasModel();
        $data['kelas'] = $kelasModel->findAll(); 
        if ($this->request->getMethod() === 'post') {
            $dataSiswa = [
                'nisn' => $this->request->getPost('nisn'),
                'nama_siswa' => $this->request->getPost('nama_siswa'),
                'id_kelas' => $this->request->getPost('id_kelas'), // Ubah dari 'kelas' ke 'id_kelas'
                'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                'no_hp' => $this->request->getPost('no_hp')
            ];
    
            $this->siswaModel->insert($dataSiswa);
            return redirect()->to('/data_siswa')->with('success', 'Data siswa berhasil ditambahkan!');
        }
    
        return view('pages/tambah_siswa', $data);
    }

    public function edit($id_siswa)
    {
        $siswa = $this->siswaModel->find($id_siswa);
        $kelasModel = new \app\Models\KelasModel();
        
        if (!$siswa) {
            return redirect()->to('/data_siswa')->with('error', 'Siswa tidak ditemukan');
        }

        if ($this->request->getMethod() === 'post') {
            $updateData = [
                'nisn' => $this->request->getPost('nisn'),
                'nama_siswa' => $this->request->getPost('nama_siswa'),
                'id_kelas' => $this->request->getPost('id_kelas'), // Ubah dari 'kelas' ke 'id_kelas'
                'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                'no_hp' => $this->request->getPost('no_hp')
            ];

            $this->siswaModel->update($id_siswa, $updateData);
            return redirect()->to('/data_siswa')->with('success', 'Data siswa berhasil diperbarui!');
        }

        return view('pages/edit_siswa', ['siswa' => $siswa, 'kelas' => $this->kelasModel->findAll()]);
    }
}
