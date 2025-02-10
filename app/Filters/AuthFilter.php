<?php
// Di AuthFilter.php
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface 
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Ubah pengecekan session sesuai dengan yang diset di controller
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('pages/admin_login'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak perlu mengubah apa pun di sini
    }
}
