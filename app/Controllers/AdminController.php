<?php namespace App\Controllers;

use App\Models\AdminModel;
use CodeIgniter\Controller;

class AdminController extends Controller
{
    public function index()
    {
        $model = new AdminModel();
        $admins = $model->findAll();

        return view('admin/index', ['admins' => $admins]);
    }

    public function create()
    {
        return view('admin/form'); // Form tambah admin
    }

    public function store()
    {
        $model = new AdminModel();
    
        $data = [
            'nama' => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];
    
        $model->insert($data);
        return redirect()->to('/admin/index')->with('message', 'Admin berhasil ditambahkan!');
    }

    public function edit($id_admin)
    {
        $model = new AdminModel();
        $admin = $model->find($id_admin);
    
        return view('admin/edit', ['admin' => $admin]);
    }

    public function update($id_admin)
    {
        $model = new AdminModel();

        $data = [
            'nama' => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
        ];

        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $model->update($id_admin, $data);
        return redirect()->to('/admin/index')->with('message', 'Admin berhasil diperbarui!');
    }

    public function delete($id)
    {
        $model = new AdminModel();
        $model->delete($id);

        return redirect()->to('/admin/index')->with('message', 'Admin berhasil dihapus!');
    }
}
