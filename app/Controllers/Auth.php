<?php

namespace App\Controllers;

use App\Models\AkunModel;

class Auth extends BaseController
{
    public function index()
    {
        return view('auth/login');
    }

    public function login()
    {
        $akunModel = new AkunModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $akun = $akunModel->where('username', $username)->first();

        if ($akun && password_verify($password, $akun['password'])) {
            $session_data = [
                'login' => true,
                'id' => $akun['id'],
                'nama' => $akun['nama'],
                'username' => $akun['username'],
                'role' => $akun['role'],
            ];
            session()->set($session_data);
            return redirect()->to('admin/home');
        } else {
            session()->setFlashdata('pesan', 'Username atau Password salah, Coba lagi!');
            return redirect()->to('login');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
