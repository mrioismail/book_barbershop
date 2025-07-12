<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CapsterModel;
use App\Models\JadwalModel;
use App\Models\BookingModel;

class Jadwal extends BaseController
{
    protected $CapsterModel;
    protected $JadwalModel;
    protected $bookingModel;

    public function __construct()
    {
        $this->CapsterModel = new CapsterModel();
        $this->JadwalModel = new JadwalModel();
        $this->bookingModel = new BookingModel();
    }

    public function index()
    {

        $data = [
            'title' => 'Jadwal',
            'jadwal' => $this->JadwalModel->getWithCapster(), // dari model JadwalModel

        ];
        return view('admin/jadwal/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Jadwal',
            'capster' => $this->CapsterModel->findAll(),
            'pesan' => service('validation'),
        ];
        return view('admin/jadwal/create', $data);
    }

    public function store()
    {
        $mode = $this->request->getPost('mode');
        $capster_id = $this->request->getPost('capster_id');
        $tanggal = $this->request->getPost('tanggal');
        $status = $this->request->getPost('status');

        $aturan = [
            'capster_id' => [
                'label' => 'Capster',
                'rules' => 'required|is_not_unique[capster.id]',
                'errors' => [
                    'required' => 'Capster harus dipilih.'
                ]
            ],
            'tanggal' => [
                'label' => 'Tanggal',
                'rules' => 'required|valid_date[Y-m-d]',
                'errors' => [
                    'required' => 'Tanggal harus diisi dan valid.'
                ]
            ],
            'status' => [
                'label' => 'Status',
                'rules' => 'required|in_list[tersedia,penuh]',
                'errors' => [
                    'required' => 'Status harus diisi.'
                ]
            ]
        ];

        if ($mode === 'manual') {
            $aturan['jam'] = [
                'label' => 'Jam',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jam harus diisi.'
                ]
            ];
        } elseif ($mode === 'range') {
            $aturan['jam_mulai'] = [
                'label' => 'Jam Mulai',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jam mulai harus diisi.'
                ]
            ];
            $aturan['jam_selesai'] = [
                'label' => 'Jam Selesai',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jam selesai harus diisi.'
                ]
            ];
        }

        if (!$this->validate($aturan)) {
            $data = [
                'title' => 'Tambah Jadwal',
                'capster' => $this->CapsterModel->findAll(),
                'pesan' => service('validation'),
            ];
            return view('admin/jadwal/create', $data);
        }

        // ✅ Proses simpan setelah lolos validasi dasar
        if ($mode === 'manual') {
            $jam = $this->request->getPost('jam');

            // Cek jam bulat
            if (date('i', strtotime($jam)) != '00') {
                return redirect()->to(base_url('admin/jadwal/create'))->withInput()->with('pesan', 'Jam harus bulat...');
            }

            // Cek apakah jadwal sudah ada & statusnya penuh
            $cek = $this->JadwalModel
                ->where('capster_id', $capster_id)
                ->where('tanggal', $tanggal)
                ->where('jam', $jam)
                ->first();

            if ($cek) {
                return redirect()->to(base_url('admin/jadwal/create'))->withInput()->with('pesan', 'Jadwal sudah ada, pilih jadwal lain.');
            }

            $this->JadwalModel->save([
                'capster_id' => $capster_id,
                'tanggal'    => $tanggal,
                'jam'        => $jam,
                'status'     => $status,
            ]);
        } elseif ($mode === 'range') {
            $jamMulai = strtotime($this->request->getPost('jam_mulai'));
            $jamSelesai = strtotime($this->request->getPost('jam_selesai'));

            if (date('i', $jamMulai) != '00' || date('i', $jamSelesai) != '00') {
                return redirect()->to(base_url('admin/jadwal/create'))->with('pesan', 'Gagal! Jam mulai dan jam selesai harus jam bulat.');
            }

            if ($jamMulai >= $jamSelesai) {
                return redirect()->to(base_url('admin/jadwal/create'))->withInput()->with('pesan', 'Gagal! Jam selesai harus lebih besar dari jam mulai.');
            }

            // Cek setiap jam dalam rentang
            while ($jamMulai < $jamSelesai) {
                $jamFormatted = date('H:i', $jamMulai);

                $cek = $this->JadwalModel
                    ->where('capster_id', $capster_id)
                    ->where('tanggal', $tanggal)
                    ->where('jam', $jamFormatted)
                    ->where('status', 'penuh')
                    ->first();

                if ($cek) {
                    return redirect()->to(base_url('admin/jadwal/create'))->withInput()->with('pesan', 'Jam ' . $jamFormatted . ' sudah penuh. Tidak bisa menambahkan.');
                }

                $this->JadwalModel->save([
                    'capster_id' => $capster_id,
                    'tanggal'    => $tanggal,
                    'jam'        => $jamFormatted,
                    'status'     => $status,
                ]);

                $jamMulai += 3600;
            }
        }

        session()->setFlashdata('pesan', 'Jadwal berhasil ditambahkan!');
        return redirect()->to('admin/jadwal');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Jadwal',
            'jadwal' => $this->JadwalModel->find($id),
            'capster' => $this->CapsterModel->findAll(),
            'pesan' => service('validation'),
        ];
        return view('admin/jadwal/edit', $data);
    }

    public function update($id)
    {
        $capster_id = $this->request->getPost('capster_id');
        $tanggal = $this->request->getPost('tanggal');
        $jam = $this->request->getPost('jam');
        $status = $this->request->getPost('status');

        $aturan = [
            'capster_id' => [
                'label' => 'Capster',
                'rules' => 'required|is_not_unique[capster.id]',
                'errors' => [
                    'required' => 'Capster harus dipilih.'
                ]
            ],
            'tanggal' => [
                'label' => 'Tanggal',
                'rules' => 'required|valid_date[Y-m-d]',
                'errors' => [
                    'required' => 'Tanggal harus diisi dan valid.'
                ]
            ],
            'status' => [
                'label' => 'Status',
                'rules' => 'required|in_list[Tersedia,Penuh]',
                'errors' => [
                    'required' => 'Status harus diisi.'
                ]
            ]
        ];

        // jika validasi tidak terpenuhi atau gagal maka kembali ke form edit
        if (!$this->validate($aturan)) {
            $data = [
                'title' => 'Edit Jadwal',
                'jadwal' => $this->JadwalModel->find($id),
                'capster' => $this->CapsterModel->findAll(),
                'pesan' => service('validation'),
            ];
            return view('admin/jadwal/edit', $data);
        } else {
            // sebelum update data, cek apakah jam sudah bulat
            if (date('i', strtotime($jam)) != '00') {
                return redirect()->to(base_url('admin/jadwal/edit/' . $id))->withInput()->with('pesan', 'Jam harus bulat tanpa menit (contoh: 08:00).');
            }

            // Cek apakah jadwal sudah dipakai untuk booking
            $jadwal = $this->JadwalModel->find($id);
            $cekBooking = $this->bookingModel
                ->where('capster_id', $jadwal['capster_id'])
                ->where('tanggal', $jadwal['tanggal'])
                ->where('jam', $jadwal['jam'])
                ->first();

            if ($cekBooking) {
                return redirect()->to(base_url('admin/jadwal/edit/' . $id))->withInput()->with('pesan', 'Jadwal ini sudah dibooking, tidak bisa diupdate.');
            }

            // Cek apakah jadwal sudah ada & statusnya penuh
            $cek = $this->JadwalModel
                ->where('capster_id', $capster_id)
                ->where('tanggal', $tanggal)
                ->where('jam', $jam)
                ->where('id !=', $id) // abaikan data yang sedang diupdate
                ->first();
            if ($cek) {
                return redirect()->to(base_url('admin/jadwal/edit/' . $id))->withInput()->with('pesan', 'Jadwal ini sudah terdaftar, Pilih jadwal lain.');
            }

            // Validasi berhasil, lanjutkan update data
            $this->JadwalModel->update($id, [
                'capster_id' => $capster_id,
                'tanggal'    => $tanggal,
                'jam'        => $jam,
                'status'     => $status,
            ]);
            session()->setFlashdata('pesan', 'Jadwal berhasil diperbarui!');
            return redirect()->to('admin/jadwal');
        }
    }

    public function delete($id)
    {
        $jadwal = $this->JadwalModel->find($id);
        if (!$jadwal) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Jadwal tidak ditemukan');
        }

        // cek jika jadwal sudah di booking maka tidak bisa dihapus
        $cek = $this->JadwalModel
            ->where('id', $id)
            ->where('status', 'Tersedia') // hanya bisa dihapus jika statusnya tersedia
            ->first();
        if (!$cek) {
            session()->setFlashdata('pesan', 'Jadwal tidak dapat dihapus karena sudah di boking.');
            return redirect()->to('/admin/jadwal');
        }

        $this->JadwalModel->delete($id);
        session()->setFlashdata('pesan', 'Jadwal berhasil dihapus!');
        return redirect()->to('/admin/jadwal');
    }
}
