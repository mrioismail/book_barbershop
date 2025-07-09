<?php

namespace App\Controllers;

use App\Models\BookingModel;
use App\Models\LayananModel;
use App\Models\CapsterModel;
use App\Models\JadwalModel;

class Booking extends BaseController
{
    protected $bookingModel, $layananModel, $capsterModel, $jadwalModel;

    public function __construct()
    {
        $this->bookingModel = new BookingModel();
        $this->layananModel = new LayananModel();
        $this->capsterModel = new CapsterModel();
        $this->jadwalModel = new JadwalModel();
    }

    public function index()
    {
        $data = [
            'layanan' => $this->layananModel->findAll(),
        ];
        // landing page
        return view('customer/index', $data);
    }

    public function booking()
    {
        // Mengatur jadwal capster yang tersedia untuk ditampilkan ke user
        $layanan = $this->layananModel->findAll();
        $capster = $this->capsterModel->findAll();
        $jadwal = $this->jadwalModel
            ->where('status', 'tersedia') // Hanya tampilkan jadwal dengan status "tersedia"
            ->where('tanggal >=', date('Y-m-d')) // Hanya tampilkan jadwal dari hari ini ke depan
            ->orderBy('tanggal', 'ASC') // Urutkan berdasarkan tanggal terdekat
            ->findAll(); // Ambil seluruh data yang sesuai filter

        // Susun data jadwal per capster → tanggal → jam
        $data_jadwal = [];
        foreach ($jadwal as $j) {
            $data_jadwal[$j['capster_id']][$j['tanggal']][] = $j['jam'];
        }

        $data = [
            'layanan' => $layanan,
            'capster' => $capster,
            'data_jadwal' => $data_jadwal
        ];

        return view('customer/booking/form_booking', $data);
    }

    public function simpanBooking()
    {
        $aturan = [
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
            'layanan_id' => [
                'label' => 'Layanan',
                'rules' => 'required|is_not_unique[layanan.id]',
                'errors' => [
                    'required' => 'Layanan harus dipilih.',
                    'is_not_unique' => 'Layanan yang dipilih tidak valid. refresh halaman dan coba lagi'
                ]
            ],
            'capster_id' => [
                'label' => 'Capster',
                'rules' => 'required|is_not_unique[capster.id]',
                'errors' => [
                    'required' => 'Capster harus dipilih.',
                    'is_not_unique' => 'Capster yang dipilih tidak valid. refresh halaman dan coba lagi'
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

            session()->setFlashdata('pesan', 'Bookingan kamu berhasil!');
            return redirect()->to('customer/booking/detail/' . $id); // Arahkan ke halaman detail dari id getinsertID
        }
    }

    public function detail($id)
    {
        // Ambil data booking berdasarkan ID
        $booking = $this->bookingModel->find($id);

        // Jika booking tidak ditemukan, tampilkan error 404
        if (!$booking) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Booking dengan ID $id tidak ditemukan.");
        }

        // Ambil data layanan dan capster yang berelasi
        $layanan = $this->layananModel->find($booking['layanan_id']);
        $capster = $this->capsterModel->find($booking['capster_id']);

        // admin WA-nya
        $noAdmin = '6289616640360';
        // Buat isi pesan ke wa
        $pesan = "*Booking Bills Barbershop*\n";
        $pesan .= "Nama: " . $booking['nama_customer'] . "\n";
        $pesan .= "No HP: " . $booking['no_hp'] . "\n";
        $pesan .= "Layanan: " . $layanan['nama_layanan'] . "\n";
        $pesan .= "Harga: Rp " . number_format($layanan['harga'], 0, ',', '.') . "\n";
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
            'linkWA' => $linkWA,
        ];

        // Kirim data ke view detail
        return view('customer/booking/detail', $data);
    }
}
