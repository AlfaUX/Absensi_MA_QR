<?php

namespace App\Controllers;
use App\Models\AdminModel;
use CodeIgniter\Controller;

class Admin_login extends Controller
{
    public function index()
    {
        return view('/pages/admin_login'); // Pastikan nama file benar (loginadm.php)
    }
    
    public function prosesLogin()
    {
        $session = session();
        $model = new AdminModel();
    
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
    
        $admin = $model->where('username', $username)->first();
    
        if ($admin) {
            if ($admin['password'] == $password) { // TANPA password_verify()
                $session->set([
                    'logged_in' => true,
                    'admin_id' => $admin['id'],
                    'username' => $admin['username']
                ]);
                return redirect()->to(base_url('pages/dashboard')); // Pastikan ini sesuai dengan routing
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
        $session = session();
        $session->destroy(); // Hapus semua session
    
        return redirect()->to('/pages/admin_login'); // Arahkan ke halaman login
    }
    

}