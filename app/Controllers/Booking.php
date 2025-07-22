<?php

namespace App\Controllers;

use App\Models\BookingModel;
use App\Models\LayananModel;
use App\Models\CapsterModel;
use App\Models\JadwalModel;
use App\Models\CapsterLayananModel;
use App\Models\ViewBookingModel;

class Booking extends BaseController
{
    protected $bookingModel, $layananModel, $capsterModel, $jadwalModel, $capsterLayananModel, $viewBookingModel;

    public function __construct()
    {
        $this->bookingModel = new BookingModel();
        $this->layananModel = new LayananModel();
        $this->capsterModel = new CapsterModel();
        $this->jadwalModel = new JadwalModel();
        $this->capsterLayananModel = new CapsterLayananModel();
        $this->viewBookingModel = new ViewBookingModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Bills Barbershop',
            'capster' => $this->capsterModel->findAll(),
            'layanan' => $this->layananModel->findAll(),
        ];
        // landing page
        return view('customer/index', $data);
    }

    public function booking()
    {
        $layanan = $this->layananModel->findAll();
        $capster = $this->capsterModel->findAll();

        // Ambil semua data capster_layanan (join ke layanan untuk ambil nama & harga) 
        $capsterLayananRaw = $this->capsterLayananModel->getCapsterLayanan(); // dari model CapsterLayananModel

        // Susun data per capster → layanan
        $layanan_per_capster = [];
        foreach ($capsterLayananRaw as $item) {
            $layanan_per_capster[$item['capster_id']][] = [
                'layanan_id'    => $item['layanan_id'],
                'nama_layanan'  => $item['nama_layanan'],
                'harga'         => $item['harga']
            ];
        }

        // Ambil jadwal tersedia
        $jadwal = $this->jadwalModel
            ->where('status', 'tersedia')
            ->where('tanggal >=', date('Y-m-d'))
            ->orderBy('tanggal', 'ASC')
            ->findAll();

        // Susun jadwal per capster → tanggal → jam
        $data_jadwal = [];
        foreach ($jadwal as $j) {
            $data_jadwal[$j['capster_id']][$j['tanggal']][] = $j['jam'];
        }

        $data = [
            'layanan' => $layanan,
            'capster' => $capster,
            'layanan_per_capster' => $layanan_per_capster,
            'data_jadwal' => $data_jadwal
        ];

        return view('customer/booking/form_booking', $data);
    }

    public function simpanBooking()
    {
        $aturan = [
            'capster_id' => [
                'label' => 'Capster',
                'rules' => 'required|is_not_unique[capster.id]',
                'errors' => [
                    'required' => 'Capster harus dipilih.',
                    'is_not_unique' => 'Capster yang dipilih tidak valid. refresh halaman dan coba lagi'
                ]
            ],
            'layanan_id' => [
                'label' => 'Layanan',
                'rules' => 'required|is_not_unique[layanan.id]',
                'errors' => [
                    'required' => 'Layanan harus dipilih.',
                    'is_not_unique' => 'Layanan yang dipilih tidak valid. refresh halaman dan coba lagi'
                ]
            ],
            'tanggal' => [
                'label' => 'Tanggal',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal harus diisi.'
                ]
            ],
            'jam' => [
                'label' => 'Jam',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jam harus diisi.'
                ]
            ],
            'nama_customer' => [
                'label' => 'Nama Customer',
                'rules' => 'required|min_length[3]|max_length[100]',
                'errors' => [
                    'required' => 'Nama customer harus diisi.',
                    'min_length' => 'Nama customer minimal 3 karakter. refresh halaman dan coba lagi',
                    'max_length' => 'Nama customer maksimal 100 karakter. refresh halaman dan coba lagi.'
                ]
            ],
            'no_hp' => [
                'label' => 'Nomor HP',
                'rules' => 'required|regex_match[/^08[0-9]{8,11}$/]',
                'errors' => [
                    'required' => 'Nomor HP wajib diisi.',
                    'regex_match' => 'Format nomor HP tidak valid (harus diawali 08 dan 10–13 digit). refresh halaman dan coba lagi',
                ],
            ],
            'catatan' => [
                'label' => 'Catatan',
                'rules' => 'permit_empty|max_length[500]',
                'errors' => [
                    'max_length' => 'Catatan maksimal 500 karakter. refresh halaman dan coba lagi'
                ]
            ],
        ];

        if (!$this->validate($aturan)) {
            // Kirim kembali dengan input dan error ke halaman sebelumnya
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            exit; // Pastikan untuk menghentikan eksekusi jika validasi gagal
        } else {
            // Jika validasi berhasil, simpan data booking
            $data = [
                'nama_customer' => $this->request->getPost('nama_customer'),
                'no_hp'         => $this->request->getPost('no_hp'),
                'layanan_id'    => $this->request->getPost('layanan_id'),
                'capster_id'    => $this->request->getPost('capster_id'),
                'tanggal'       => $this->request->getPost('tanggal'),
                'jam'           => $this->request->getPost('jam'),
                'catatan'       => $this->request->getPost('catatan'),
            ];

            $this->bookingModel->save($data);
            $id = $this->bookingModel->getInsertID(); // Ambil ID terakhir

            // Update status di tabel jadwal
            $this->jadwalModel
                ->where('capster_id', $data['capster_id'])
                ->where('tanggal', $data['tanggal'])
                ->where('jam', $data['jam'])
                ->set(['status' => 'penuh']) // atau 'tidak tersedia'
                ->update();

            // kalo cuman status nya di update tanpa menyaring capster, tanggal dan jam nya maka semua status di tabel jadwal juga ikut berubah maka dari itu harus pake where

            session()->setFlashdata('pesan', 'Anda memiliki bookingan baru!');
            return redirect()->to('customer/booking/detail/' . $id); // Arahkan ke halaman detail dari id getinsertID
        }
    }

    public function detail($id)
    {
        // booking dari view_booking berdasarkan ID booking
        $booking = $this->viewBookingModel->find($id);

        // Jika booking tidak ditemukan, tampilkan error 404
        if (!$booking) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Booking dengan ID $id tidak ditemukan.");
        }

        // Ambil data layanan dan capster yang berelasi
        $layanan = $this->layananModel->find($booking['layanan_id']);
        $capster = $this->capsterModel->find($booking['capster_id']);
        $capsterLayanan = $this->capsterLayananModel->getCapsterLayanan(); // Ambil semua relasi // Ambil data 

        // Cek harga yang tersedia
        if ($booking['harga_khusus'] !== null) {
            $harga = $booking['harga_khusus']; // Gunakan harga capster khusus
        } else {
            $harga = $booking['harga_umum']; // Gunakan harga umum dari layanan
        }


        // admin WA-nya
        $noAdmin = '6289616640360';
        // Buat isi pesan ke wa
        $pesan = "*Booking Bills Barbershop*\n";
        $pesan .= "Nama: " . $booking['nama_customer'] . "\n";
        $pesan .= "No HP: " . $booking['no_hp'] . "\n";
        $pesan .= "Layanan: " . $layanan['nama_layanan'] . "\n";
        $pesan .= "Harga: Rp " . number_format($harga) . "\n";
        $pesan .= "Capster: " . $capster['nama'] . "\n";
        $pesan .= "Tanggal: " . date('d M Y', strtotime($booking['tanggal'])) . "\n";
        $pesan .= "Jam: " . $booking['jam'] . "\n";
        if (!empty($booking['catatan'])) {
            $pesan .= "Catatan: " . $booking['catatan'] . "\n";
        }
        // Encode dan buat link WA
        $linkWA = 'https://wa.me/' . $noAdmin . '?text=' . urlencode($pesan);

        $data = [
            'booking' => $booking,
            'layanan' => $layanan,
            'capster' => $capster,
            'harga' => $harga,
            'linkWA' => $linkWA,
        ];

        // Kirim data ke view detail
        return view('customer/booking/detail', $data);
    }
}
