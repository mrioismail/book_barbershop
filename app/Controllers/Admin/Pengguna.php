<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AkunModel;

class Pengguna extends BaseController
{
    protected $akunModel;

    public function __construct()
    {
        $this->akunModel = new AkunModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Halaman Pengguna',
            'pengguna' => $this->akunModel->findAll(),
        ];

        return view('admin/pengguna/index', $data);
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Data Pengguna',
            'pengguna' => $this->akunModel->find($id),
            'pesan' => service('validation'),
        ];

        return view('admin/pengguna/edit', $data);
    }

    public function update($id)
    {
        $aturan = [
            'username' => [
                'label' => 'Username',
                'rules' => 'required|min_length[3]|max_length[100]|regex_match[/^[a-z0-9_]+$/]',
                'errors' => [
                    'required'    => 'Mohon isi kolom {field}.',
                    'min_length'  => '{field} minimal harus 3 karakter.',
                    'max_length'  => '{field} maksimal 100 karakter.',
                    'regex_match' => '{field} hanya boleh huruf kecil, angka, dan tanpa spasi.',
                ]
            ],
            'nama' => [
                'label' => 'Nama Lengkap',
                'rules' => 'required|min_length[3]|max_length[100]',
                'errors' => [
                    'required'   => 'Mohon isi kolom {field}.',
                    'min_length' => '{field} minimal harus 3 karakter.',
                    'max_length' => '{field} maksimal 100 karakter.',
                ]
            ],
        ];

        // Validasi data
        if (!$this->validate($aturan)) {
            $data = [
                'title' => 'Edit Data Pengguna',
                'pengguna' => $this->akunModel->find($id),
                'pesan' => service('validation'),
            ];

            return view('admin/pengguna/edit', $data);
        }
        // Data valid → update
        $data = [
            'username' => $this->request->getPost('username'),
            'nama' => $this->request->getPost('nama'),
            'role' => $this->request->getPost('role') ?? 'admin', // fallback untuk hidden input
        ];

        $this->akunModel->update($id, $data);
        session()->setFlashdata('pesan', 'Data pengguna berhasil diperbarui.');
        return redirect()->to('admin/pengguna');
    }

    public function gantiPassword($id)
    {
        $data = [
            'title' => 'Ganti Password',
            'pengguna' => $this->akunModel->find($id),
            'pesan' => service('validation'),
        ];

        return view('admin/ganti_password', $data);
    }

    public function updatePassword($id)
    {
        $pengguna = $this->akunModel->find($id);


        // Validasi input
        $aturan = [
            'password_lama' => [
                'label' => 'Password Lama',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi.'
                ]
            ],
            'password_baru' => [
                'label' => 'Password Baru',
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'min_length' => '{field} minimal 5 karakter.'
                ]
            ],
            'konfirmasi_password' => [
                'label' => 'Konfirmasi Password',
                'rules' => 'required|matches[password_baru]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'matches' => '{field} tidak cocok dengan Password Baru.'
                ]
            ]
        ];

        if (!$this->validate($aturan)) {
            $data = [
                'title' => 'Ganti Password',
                'pengguna' => $this->akunModel->find($id),
                'pesan' => service('validation'),
            ];

            return view('admin/ganti_password', $data);
        }

        $passwordLama = $this->request->getPost('password_lama');
        $passwordBaru = $this->request->getPost('password_baru');
        $konfirmasi = $this->request->getPost('konfirmasi_password');

        // Cek password lama manual
        if (!password_verify($passwordLama, $pengguna['password'])) {
            return redirect()->back()->withInput()->with('pesan', 'Password lama tidak sesuai.');
        }

        // Simpan password baru
        $data = [
            'password' => password_hash($passwordBaru, PASSWORD_DEFAULT),
        ];

        $this->akunModel->update($id, $data);

        session()->setFlashdata('pesan', 'Password berhasil diubah, silakan login kembali.');
        return redirect()->to('logout');
    }

    public function resetPassword($id)
    {
        $pengguna = $this->akunModel->find($id);

        $this->akunModel->update($id, [
            'password' => password_hash($pengguna['username'], PASSWORD_DEFAULT)
        ]);

        session()->setFlashdata('pesan', 'Password berhasil direset (password sekarang sama dengan username), silakan login kembali.');
        return redirect()->to('logout');
    }
}
