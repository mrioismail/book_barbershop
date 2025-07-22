<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CapsterModel;
use App\Models\LayananModel;
use App\Models\CapsterLayananModel;
use App\Models\ViewBookingModel;

class CapsterLayanan extends BaseController
{
    protected $capsterModel;
    protected $layananModel;
    protected $CapsterLayananModel;
    protected $viewBookingModel;

    public function __construct()
    {
        $this->capsterModel = new CapsterModel();
        $this->layananModel = new LayananModel();
        $this->CapsterLayananModel = new CapsterLayananModel();
        $this->viewBookingModel = new ViewBookingModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Capster Layanan',
            'capster_layanan' => $this->CapsterLayananModel->getCapsterLayanan(), // Ambil model semua data capster layanan
        ];
        return view('admin/capster_layanan/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Capster Layanan',
            'capster' => $this->capsterModel->findAll(), // Ambil semua capster
            'layanan' => $this->layananModel->findAll(), // Ambil semua layanan
            'pesan' => service('validation'),
        ];
        return view('admin/capster_layanan/create', $data);
    }

    public function store()
    {
        $capster_id = $this->request->getPost('capster_id');
        $layanan_id = $this->request->getPost('layanan_id');
        $harga = $this->request->getPost('harga');

        $aturan = [
            'capster_id' => [
                'label' => 'Capster',
                'rules' => 'required|is_not_unique[capster.id]',
                'errors' => [
                    'required' => 'Capster wajib dipilih.',
                    'is_not_unique' => 'Capster tidak ditemukan.'
                ]
            ],
            'layanan_id' => [
                'label' => 'Layanan',
                'rules' => 'required|is_not_unique[layanan.id]',
                'errors' => [
                    'required' => 'Layanan wajib dipilih.',
                    'is_not_unique' => 'Layanan tidak ditemukan.'
                ]
            ],
            'harga' => [
                'label' => 'Harga',
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Harga wajib diisi.',
                    'numeric'  => 'Harga harus berupa angka.'
                ]
            ]
        ];

        // jika error atau validasi gagal
        if (!$this->validate($aturan)) {
            $data = [
                'title' => 'Tambah Capster Layanan',
                'capster' => $this->capsterModel->findAll(), // Ambil semua capster
                'layanan' => $this->layananModel->findAll(), // Ambil semua layanan
                'pesan' => service('validation'),
            ];
            return view('admin/capster_layanan/create', $data);
        } else {
            // simpan data capster layanan 
            $data = [
                'capster_id' => $capster_id,
                'layanan_id' => $layanan_id,
                'harga' => $harga
            ];
            $this->CapsterLayananModel->insert($data);
            session()->setFlashdata('pesan', 'Capster Layanan berhasil ditambahkan!');
            return redirect()->to('admin/capster_layanan');
        }
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Capster Layanan',
            'capster' => $this->capsterModel->findAll(), // Ambil semua capster
            'layanan' => $this->layananModel->findAll(), // Ambil semua layanan
            'capster_layanan' => $this->CapsterLayananModel->find($id), // Ambil data capster layanan berdasarkan ID
            'pesan' => service('validation'),
        ];
        return view('admin/capster_layanan/edit', $data);
    }

    public function update($id)
    {
        // ambil data dari form
        $capster_id = $this->request->getPost('capster_id');
        $layanan_id = $this->request->getPost('layanan_id');
        $harga = $this->request->getPost('harga');

        $aturan = [
            'capster_id' => [
                'label' => 'Capster',
                'rules' => 'required|is_not_unique[capster.id]',
                'errors' => [
                    'required' => 'Capster wajib dipilih.',
                    'is_not_unique' => 'Capster tidak ditemukan.'
                ]
            ],
            'layanan_id' => [
                'label' => 'Layanan',
                'rules' => 'required|is_not_unique[layanan.id]',
                'errors' => [
                    'required' => 'Layanan wajib dipilih.',
                    'is_not_unique' => 'Layanan tidak ditemukan.'
                ]
            ],
            'harga' => [
                'label' => 'Harga',
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Harga wajib diisi.',
                    'numeric'  => 'Harga harus berupa angka.'
                ]
            ]
        ];

        // jika error atau validasi gagal
        if (!$this->validate($aturan)) {
            $data = [
                'title' => 'Edit Capster Layanan',
                'capster' => $this->capsterModel->findAll(), // Ambil semua capster
                'layanan' => $this->layananModel->findAll(), // Ambil semua layanan
                'capster_layanan' => $this->CapsterLayananModel->find($id), // Ambil data capster layanan berdasarkan ID
                'pesan' => service('validation'),
            ];
            return view('admin/capster_layanan/edit', $data);
        } else {
            // simpan data capster layanan 
            $data = [
                'capster_id' => $capster_id,
                'layanan_id' => $layanan_id,
                'harga' => $harga
            ];
            $this->CapsterLayananModel->update($id, $data);
            session()->setFlashdata('pesan', 'Capster Layanan berhasil diperbarui!');
            return redirect()->to('admin/capster_layanan');
        }
    }

    public function delete($id)
    {
        // Cek apakah harga capster ini sudah digunakan dalam tabel booking
        $hargaCapster = $this->viewBookingModel
            ->where('id_harga_khusus', $id)
            ->first();

        if ($hargaCapster) {
            session()->setFlashdata('errors', 'Harga capster ini tidak dapat dihapus karena sudah digunakan dalam data booking.');
            return redirect()->to('admin/capster_layanan');
        }


        $capster_layanan = $this->CapsterLayananModel->find($id);
        if (!$capster_layanan) {
            session()->setFlashdata('errors', 'Capster Layanan tidak ditemukan!');
            return redirect()->to('admin/capster_layanan');
        }

        $this->CapsterLayananModel->delete($id);
        session()->setFlashdata('pesan', 'Capster Layanan berhasil dihapus!');
        return redirect()->to('admin/capster_layanan');
    }
}
