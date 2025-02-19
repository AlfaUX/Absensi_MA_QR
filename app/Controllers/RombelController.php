<?php

namespace App\Controllers;
use App\Models\RombelModel;
use App\Models\KelasModel;
use CodeIgniter\Controller;

class RombelController extends Controller
{
    public function index()
    {
        $model = new RombelModel();
        $data['rombel'] = $model->join('tb_kelas', 'tb_kelas.id_kelas = tb_rombel.id_kelas')->findAll();
        return view('pages/rombel/index_rombel', $data);
    }

    public function create()
    {
        $kelasModel = new KelasModel();
        $data['kelas'] = $kelasModel->findAll();
        return view('pages/rombel/create_rombel', $data);
    }

    public function store()
    {
        $model = new RombelModel();
        $model->insert([
            'nama_rombel' => $this->request->getPost('nama_rombel'),
            'id_kelas' => $this->request->getPost('id_kelas')
        ]);
        return redirect()->to('/rombel');
    }

    public function edit($id)
    {
        $model = new RombelModel();
        $kelasModel = new KelasModel();
        $data['rombel'] = $model->find($id);
        $data['kelas'] = $kelasModel->findAll();
        return view('pages/rombel/edit_rombel', $data);
    }

    public function update($id)
    {
        $model = new RombelModel();
        $model->update($id, [
            'nama_rombel' => $this->request->getPost('nama_rombel'),
            'id_kelas' => $this->request->getPost('id_kelas')
        ]);
        return redirect()->to('/rombel');
    }

    public function delete($id)
    {
        $model = new RombelModel();
        $model->delete($id);
        return redirect()->to('/rombel');
    }
}