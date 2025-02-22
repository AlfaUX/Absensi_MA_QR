<?php

namespace App\Controllers;

use App\Models\ProfilSekolahModel;
use CodeIgniter\Controller;

class ProfilSekolahController extends Controller
{
    public function index()
    {
        $model = new ProfilSekolahModel();
        $profil = $model->first();

        return view('admin/profil_sekolah/index', ['profil' => $profil]);
    }

    public function edit()
    {
        $model = new ProfilSekolahModel();
        $profil = $model->first();
    
        // Debugging
        // dd($profil);
    
        return view('admin/profil_sekolah/edit', ['profil' => $profil]);
    }
    

    public function update()
    {
        $model = new ProfilSekolahModel();
        $id = $this->request->getPost('id');

        $data = [
            'nama_sekolah'    => $this->request->getPost('nama_sekolah'),
            'alamat'          => $this->request->getPost('alamat'),
            'tahun_pelajaran' => $this->request->getPost('tahun_pelajaran'),
        ];

        // Handle Upload Logo
        $logo = $this->request->getFile('logo');
        if ($logo && $logo->isValid()) {
            $logoName = $logo->getRandomName();
            $logo->move('uploads/logo', $logoName);
            $data['logo'] = 'uploads/logo/' . $logoName;
        }

        $model->update($id, $data);

        return redirect()->to('admin/profil_sekolah/index')->with('message', 'Profil sekolah berhasil diperbarui!');
    }
}
