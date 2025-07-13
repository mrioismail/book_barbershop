<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CapsterModel;
use App\Models\BookingModel;

class Capster extends BaseController
{
    protected $capsterModel;
    protected $bookingModel;

    public function __construct()
    {
        $this->capsterModel = new CapsterModel();
        $this->bookingModel = new BookingModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Capster',
            'capster' => $this->capsterModel->findAll(),
        ];

        return view('admin/capster/index', $data);
    }

    public function detail($id)
    {
        $data = [
            'title' => 'Detail capster',
            'capster' => $this->capsterModel->find($id),
        ];
        return view('admin/capster/detail', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah capster',
            'pesan' => service('validation'),
        ];
        return view('admin/capster/create', $data);
    }

    public function store()
    {
        $foto_capster = $this->request->getFile('foto_capster');
        $nama = $this->request->getPost('nama');
        $pengalaman = $this->request->getPost('pengalaman');

        $aturan = [
            'foto_capster' => [
                'label' => 'Foto Capster',
                'rules' => 'uploaded[foto_capster]|max_size[foto_capster,1024]|is_image[foto_capster]|mime_in[foto_capster,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded'  => 'Foto Capster wajib diunggah.',
                    'max_size'  => 'Ukuran foto capster tidak boleh lebih dari 1MB.',
                    'is_image'  => 'File yang diunggah harus berupa gambar.',
                    'mime_in'   => 'Format foto harus JPG, JPEG, atau PNG.',
                ]
            ],
            'nama' => [
                'label' => 'Nama Capster',
                'rules' => 'required|min_length[3]|max_length[100]',
                'errors' => [
                    'required'   => 'Nama Capster wajib diisi.',
                    'min_length' => 'Nama Capster minimal terdiri dari 3 karakter.',
                    'max_length' => 'Nama Capster maksimal terdiri dari 100 karakter.'
                ]
            ],
            'pengalaman' => [
                'label' => 'Pengalaman',
                'rules' => 'required|permit_empty|max_length[500]',
                'errors' => [
                    'required'   => 'Pengalaman wajib diisi.',
                    'max_length' => 'Pengalamn maksimal terdiri dari 500 karakter.'
                ]
            ],
        ];

        // jika error atau validasi gagal
        if (!$this->validate($aturan)) {
            $data = [
                'title' => 'Tambah capster',
                'pesan' => service('validation'),
            ];
            return view('admin/capster/create', $data);
        } else {
            // cek jika memiliki nama yg sudah terdaftar atau sama
            $cek_capster = $this->capsterModel
                ->where('nama', $nama)
                ->first();
            if ($cek_capster) {
                session()->setFlashdata('pesan', 'Gagal! Nama capster sudah terdaftar.');
                return redirect()->to('admin/capster/create')->withInput();
            }
            // jika validasi berhasil
            // upload foto capster
            $nama_foto = $foto_capster->getRandomName();
            $foto_capster->move('admin/assets/images/uploads', $nama_foto);

            // simpan data capster 
            $data = [
                'foto_capster' => $nama_foto,
                'nama'         => $nama,
                'pengalaman'   => $pengalaman,
            ];
            $this->capsterModel->insert($data);
            session()->setFlashdata('pesan', 'Capster berhasil ditambahkan!');
            return redirect()->to('admin/capster');
        }

        $this->capsterModel->insert([
            'foto_capster'    => $this->request->getPost('foto_capster'), // Pastikan ini sesuai dengan input form
            'nama_capster'    => $this->request->getPost('nama_capster'),
            'pengalaman'      => $this->request->getPost('pengalaman'),
        ]);

        return redirect()->to('admin/capster/index')->with('success', 'capster berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit capster',
            'capster' => $this->capsterModel->find($id),
        ];

        return view('admin/capster/edit', $data);
    }

    public function update($id)
    {
        // ambil data dari form
        $foto_capster_lama = $this->request->getPost('foto_capster_lama');
        $foto_capster = $this->request->getFile('foto_capster');
        $nama = $this->request->getPost('nama');
        $pengalaman = $this->request->getPost('pengalaman');

        // Cek jika capster sudah dipakai di booking
        // $cek_capster = $this->bookingModel
        //     ->where('capster_id', $id)
        //     ->first();
        // if ($cek_capster) {
        //     session()->setFlashdata('pesan', 'Gagal Edit! Capster sudah digunakan di data booking.');
        //     return redirect()->to('admin/capster/edit/' . $id)->withInput();
        // }

        // Cek jika nama capster sudah dipakai oleh capster lain
        $cek_nama_capster = $this->capsterModel
            ->where('nama', $nama)
            ->where('id !=', $id)
            ->first();
        if ($cek_nama_capster) {
            session()->setFlashdata('pesan', 'Gagal Edit! Nama capster sudah digunakan oleh capster lain.');
            return redirect()->to('admin/capster/edit/' . $id)->withInput();
        }

        $aturan = [
            'foto_capster' => [
                'label' => 'Foto Capster',
                'rules' => 'max_size[foto_capster,1024]|is_image[foto_capster]|mime_in[foto_capster,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size'  => 'Ukuran foto capster tidak boleh lebih dari 1MB.',
                    'is_image'  => 'File yang diunggah harus berupa gambar.',
                    'mime_in'   => 'Format foto harus JPG, JPEG, atau PNG.',
                ]
            ],
            'nama' => [
                'label' => 'Nama Capster',
                'rules' => 'required|min_length[3]|max_length[100]',
                'errors' => [
                    'required'   => 'Nama Capster wajib diisi.',
                    'min_length' => 'Nama Capster minimal terdiri dari 3 karakter.',
                    'max_length' => 'Nama Capster maksimal terdiri dari 100 karakter.'
                ]
            ],
            'pengalaman' => [
                'label' => 'Pengalaman',
                'rules' => 'required|permit_empty|max_length[500]',
                'errors' => [
                    'required'   => 'Pengalaman wajib diisi.',
                    'max_length' => 'Pengalamn maksimal terdiri dari 500 karakter.'
                ]
            ],
        ];
        // jika error atau validasi gagal
        if (!$this->validate($aturan)) {
            $data = [
                'title' => 'Edit capster',
                'capster' => $this->capsterModel->find($id),
                'pesan' => service('validation'),
            ];
            return view('admin/capster/edit', $data);
        }

        // jika validasi berhasil
        $data = [
            'nama'    => $nama,
            'pengalaman'  => $pengalaman,
        ];
        // jika ada foto capster yang diunggah
        if ($foto_capster != '') {
            // hapus foto lama jika ada
            unlink('admin/assets/images/uploads/' . $foto_capster_lama);
            // upload foto capster baru
            $nama_foto = $foto_capster->getRandomName();
            $foto_capster->move('admin/assets/images/uploads', $nama_foto);
            $data['foto_capster'] = $nama_foto;
        }
        // update data capster
        $this->capsterModel->update($id, $data);
        session()->setFlashdata('pesan', 'Capster berhasil diperbarui!');
        return redirect()->to('admin/capster');
    }

    public function delete($id)
    {
        $capster = $this->capsterModel->find($id);

        // cek layanan yg ada di tabel booking
        $cek_capster = $this->bookingModel
            ->where('capster_id', $id)
            ->first();
        if ($cek_capster) {
            session()->setFlashdata('pesan', 'Gagal Hapus! Capster sudah di booking.');
            return redirect()->to('admin/capster/detail/' . $id)->withInput();
        }

        if ($capster) {
            // hapus foto capster jika ada
            if ($capster['foto_capster']) {
                unlink('admin/assets/images/uploads/' . $capster['foto_capster']);
            }
            // hapus data capster
            $this->capsterModel->delete($id);
            session()->setFlashdata('pesan', 'Capster berhasil dihapus!');
        } else {
            session()->setFlashdata('pesan', 'Capster tidak ditemukan!');
        }
        return redirect()->to('admin/capster');
    }
}
