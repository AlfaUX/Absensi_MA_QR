<?php

namespace App\Controllers;

use App\Models\AdminModel;
use CodeIgniter\Controller;

class Admin_login extends Controller
{
    public function index()
    {
        return view('/pages/admin_login');
    }

    public function prosesLogin()
    {
        $session = session();
        $model = new AdminModel();
    
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
    
        $admin = $model->where('username', $username)->first();
    
        if ($admin) {
            if (password_verify($password, $admin['password'])) { // Verifikasi password
                $session->set([
                    'logged_in' => true,
                    'admin_id' => $admin['id_admin'], // Sesuaikan primary key di tabel
                    'username' => $admin['username'],
                    'nama' => $admin['nama'] // Tambahkan nama admin ke session
                ]);
                return redirect()->to(base_url('pages/dashboard')); // Arahkan ke halaman admin utama
            } else {
                $session->setFlashdata('error', 'Password salah!');
                return redirect()->to(base_url('pages/admin_login'));
            }
        } else {
            $session->setFlashdata('error', 'Username tidak ditemukan!');
            return redirect()->to(base_url('pages/admin_login'));
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/pages/admin_login');
    }
}
