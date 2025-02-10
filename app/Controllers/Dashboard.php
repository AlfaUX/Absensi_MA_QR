<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('pages/   admin_login'));
        }
        return view('pages/dashboard');
    }
    
}
