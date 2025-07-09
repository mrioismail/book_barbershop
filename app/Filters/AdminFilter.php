<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // jika masuk tanpa login
        if (!session()->get('login')) {
            session()->setFlashdata('pesan', 'Anda harus login terlebih dahulu.');
            return redirect()->to(base_url('login'));
        }

        // ketika mencoba masuk hak akses (Admin)
        if (session()->get('role') != 'admin') {
            session()->setFlashdata('pesan', 'Anda tidak punya akses sebagai admin.');
            return redirect()->to('logout');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
