<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\LayananModel;
use App\Models\BookingModel;

class Layanan extends BaseController
{
    protected $layananModel;
    protected $bookingModel;

    public function __construct()
    {
        $this->layananModel = new LayananModel();
        $this->bookingModel = new BookingModel();
    }

    public function index()
    {

        $data = [
            'title' => 'Layanan',
            'layanan' =>  $this->layananModel->findAll(),
        ];
        return view('admin/layanan/index', $data);
    }

    public function detail($id)
    {
        $data = [
            'title' => 'Detail Layanan',
            'layanan' => $this->layananModel->find($id),
        ];
        return view('admin/layanan/detail', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Layanan',
            'pesan' => service('validation'),
        ];
        return view('admin/layanan/create', $data);
    }

    public function store()
    {
        $foto_layanan = $this->request->getFile('foto_layanan');
        $nama_layanan = $this->request->getPost('nama_layanan');
        $harga_layanan = $this->request->getPost('harga_layanan');
        $detail_layanan = $this->request->getPost('detail_layanan');

        $aturan = [
            'foto_layanan' => [
                'label' => 'Foto Layanan',
                'rules' => 'uploaded[foto_layanan]|max_size[foto_layanan,1024]|is_image[foto_layanan]|mime_in[foto_layanan,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded'  => 'Foto layanan wajib diunggah.',
                    'max_size'  => 'Ukuran foto layanan tidak boleh lebih dari 1MB.',
                    'is_image'  => 'File yang diunggah harus berupa gambar.',
                    'mime_in'   => 'Format foto harus JPG, JPEG, atau PNG.'
                ]
            ],
            'nama_layanan' => [
                'label' => 'Nama Layanan',
                'rules' => 'required|min_length[3]|max_length[100]',
                'errors' => [
                    'required'   => 'Nama layanan wajib diisi.',
                    'min_length' => 'Nama layanan minimal terdiri dari 3 karakter.',
                    'max_length' => 'Nama layanan maksimal terdiri dari 100 karakter.'
                ]
            ],
            'harga_layanan' => [
                'label' => 'Harga Layanan',
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Harga wajib diisi.',
                    'numeric'  => 'Harga harus berupa angka.'
                ]
            ],
            'detail_layanan' => [
                'label' => 'Detail Layanan',
                'rules' => 'permit_empty|max_length[500]',
                'errors' => [
                    'max_length' => 'Detail layanan maksimal terdiri dari 500 karakter.'
                ]
            ],
        ];

        // jika error atau validasi gagal
        if (!$this->validate($aturan)) {
            $data = [
                'title' => 'Tambah Layanan',
                'pesan' => service('validation'),
            ];
            return view('admin/layanan/create', $data);
        } else {
            $cek_layanan = $this->layananModel
                ->where('nama_layanan', $nama_layanan)
                ->first();

            if ($cek_layanan) {
                session()->setFlashdata('errors', 'Gagal! Nama layanan sudah terdaftar.');
                return redirect()->to('admin/layanan/create')->withInput();
            }

            // jika validasi berhasil
            // upload foto layanan
            $nama_foto = $foto_layanan->getRandomName();
            $foto_layanan->move('admin/assets/images/uploads', $nama_foto);

            // simpan data layanan 
            $data = [
                'foto_layanan'    => $nama_foto,
                'nama_layanan'    => $nama_layanan,
                'harga_layanan'   => $harga_layanan,
                'detail_layanan'  => $detail_layanan
            ];
            $this->layananModel->insert($data);
            session()->setFlashdata('pesan', 'Layanan berhasil ditambahkan!');
            return redirect()->to('admin/layanan');
        }

        return redirect()->to('admin/layanan/index')->with('pesan', 'Layanan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Layanan',
            'layanan' => $this->layananModel->find($id),
        ];

        return view('admin/layanan/edit', $data);
    }

    public function update($id)
    {
        // ambil data dari form
        $foto_layanan_lama = $this->request->getPost('foto_layanan_lama');
        $foto_layanan = $this->request->getFile('foto_layanan');
        $nama_layanan = $this->request->getPost('nama_layanan');
        $harga_layanan = $this->request->getPost('harga_layanan');
        $detail_layanan = $this->request->getPost('detail_layanan');

        $aturan = [
            'foto_layanan' => [
                'label' => 'Foto Layanan',
                'rules' => 'max_size[foto_layanan,1024]|is_image[foto_layanan]|mime_in[foto_layanan,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran foto maksimal 1MB.',
                    'is_image' => 'File harus berupa gambar.',
                    'mime_in' => 'Format gambar harus JPG, JPEG, atau PNG.',
                ]
            ],
            'nama_layanan' => [
                'label' => 'Nama Layanan',
                'rules' => 'required|min_length[3]|max_length[100]',
                'errors' => [
                    'required' => 'Nama layanan harus diisi.',
                    'min_length' => 'Nama layanan minimal 3 karakter.',
                    'max_length' => 'Nama layanan maksimal 100 karakter.',
                ]
            ],
            'harga_layanan' => [
                'label' => 'Harga Layanan',
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Harga wajib diisi.',
                    'numeric'  => 'Harga harus berupa angka.'
                ]
            ],
            'detail_layanan' => [
                'label' => 'Detail Layanan',
                'rules' => 'permit_empty|max_length[500]',
                'errors' => [
                    'max_length' => 'Detail layanan maksimal 500 karakter.',
                ]
            ],
        ];

        // jika error atau validasi gagal
        if (!$this->validate($aturan)) {
            $data = [
                'title' => 'Edit Layanan',
                'layanan' => $this->layananModel->find($id),
                'pesan' => service('validation'),
            ];
            return view('admin/layanan/edit', $data);
        }

        // cek layanan yg ada di tabel booking
        // $cek_layanan = $this->bookingModel
        //     ->where('layanan_id', $id)
        //     ->first();
        // if ($cek_layanan) {
        //     session()->setFlashdata('pesan', 'Gagal Edit! Nama layanan sudah di booking.');
        //     return redirect()->to('admin/layanan/edit/' . $id)->withInput();
        // }

        // jika validasi berhasil
        $data = [
            'nama_layanan'    => $nama_layanan,
            'harga_layanan'   => $harga_layanan,
            'detail_layanan'  => $detail_layanan
        ];
        // jika ada foto layanan yang diunggah
        if ($foto_layanan != '') {
            // hapus foto lama jika ada
            unlink('admin/assets/images/uploads/' . $foto_layanan_lama);
            // upload foto layanan baru
            $nama_foto = $foto_layanan->getRandomName();
            $foto_layanan->move('admin/assets/images/uploads/', $nama_foto);
            $data['foto_layanan'] = $nama_foto;
        }
        // update data layanan
        $this->layananModel->update($id, $data);
        session()->setFlashdata('pesan', 'Layanan berhasil diperbarui!');
        return redirect()->to('admin/layanan');
    }

    public function delete($id)
    {
        $layanan = $this->layananModel->find($id);

        // cek layanan yg ada di tabel booking
        $cek_layanan = $this->bookingModel
            ->where('layanan_id', $id)
            ->first();
        if ($cek_layanan) {
            session()->setFlashdata('errors', 'Gagal Hapus! Nama layanan sudah di booking.');
            return redirect()->to('admin/layanan/detail/' . $id)->withInput();
        }

        if ($layanan) {
            // hapus foto layanan jika ada
            if ($layanan['foto_layanan']) {
                unlink('admin/assets/images/uploads/' . $layanan['foto_layanan']);
            }
            // hapus data layanan
            $this->layananModel->delete($id);
            session()->setFlashdata('pesan', 'Layanan berhasil dihapus!');
        } else {
            session()->setFlashdata('pesan', 'Layanan tidak ditemukan!');
        }
        return redirect()->to('admin/layanan');
    }
}
