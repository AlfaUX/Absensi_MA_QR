<?php

namespace App\Controllers;
use App\Models\KelasModel;
use CodeIgniter\Controller;

class KelasController extends Controller
{
    public function index()
    {
        $model = new KelasModel();
        $data['kelas'] = $model->findAll();
        return view('pages/kelas/index_kelas', $data);
    }

    public function store()
    {
        $model = new KelasModel();
        $model->insert(['kelas' => $this->request->getPost('kelas')]);
        return redirect()->to('/kelas');
    }

}