<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CapsterModel;
use App\Models\LayananModel;
use App\Models\JadwalModel;
use App\Models\BookingModel;
use App\Models\ViewBookingModel;

class Booking extends BaseController
{
    protected $capsterModel;
    protected $layananModel;
    protected $jadwalModel;
    protected $bookingModel;
    protected $viewBookingModel;

    public function __construct()
    {
        $this->capsterModel = new CapsterModel();
        $this->layananModel = new LayananModel();
        $this->jadwalModel = new JadwalModel();
        $this->bookingModel = new BookingModel();
        $this->viewBookingModel = new ViewBookingModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Booking',
            'booking' =>  $this->viewBookingModel->findAll(),
        ];
        return view('admin/booking/index', $data);
    }

    public function detail($id)
    {
        $data = [
            'title' => 'Detail Booking',
            'booking' => $this->viewBookingModel->find($id),
        ];
        return view('admin/booking/detail', $data);
    }

    public function update($id)
    {
        // ambil data dari form
        $status = $this->request->getPost('status');

        $aturan = [
            'status' => [
                'label' => 'Status Booking',
                'rules' => 'required|in_list[booked,batal,selesai]',
                'errors' => [
                    'required' => 'Status booking harus dipilih.',
                    'in_list' => 'Status booking tidak valid.',
                ]
            ],
        ];

        // jika error atau validasi gagal
        if (!$this->validate($aturan)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors())
                ->with('errors', 'Gagal memperbarui status booking!');
            exit;
        }

        // jika validasi berhasil
        $data = [
            'status' => $status,
        ];
        // update data booking
        $this->bookingModel->update($id, $data);
        session()->setFlashdata('pesan', 'Status booking berhasil diperbarui!');
        return redirect()->to('admin/booking');
    }

    public function delete($id)
    {
        $booking = $this->bookingModel->find($id);
        if (!$booking) {
            session()->setFlashdata('errors', 'Booking tidak ditemukan!');
            return redirect()->to('admin/booking');
        }
        // cek jika tanggal booking sudah lewat hari ini
        if (strtotime($booking['tanggal']) < time()) {
            session()->setFlashdata('errors', 'Gagal Hapus! Booking sudah lewat hari ini.');
            return redirect()->to('admin/booking/detail/' . $id);
        }

        // cek apakah booking sudah selesai
        if ($booking['status'] === 'selesai') {
            session()->setFlashdata('errors', 'Gagal Hapus! Status Booking sudah selesai.');
            return redirect()->to('admin/booking/detail/' . $id);
        }

        // jika booking dalam status batal dan booked, maka bisa dihapus dengan syarat :

        // saat kita menghapus data booking yg status batal atau booked, maka otomatis kita merubah status di tabel jadwal menjadi Tersedia kembali yg sebelumnya sudah diambil oleh booking ini
        // Cari jadwal berdasarkan capster_id, tanggal, dan jam dari data booking
        $jadwal = $this->jadwalModel
            ->where('capster_id', $booking['capster_id'])
            ->where('tanggal', $booking['tanggal'])
            ->where('jam', $booking['jam'])
            ->first();
        if ($jadwal) {
            $jadwal['status'] = 'Tersedia';
            $this->jadwalModel->update($jadwal['id'], $jadwal);
        }

        $this->bookingModel->delete($id);
        session()->setFlashdata('pesan', 'Booking berhasil dihapus!');
        return redirect()->to('admin/booking');
    }

    public function laporan()
    {
        $tanggal_awal = $this->request->getGet('tanggal_awal');
        $tanggal_akhir = $this->request->getGet('tanggal_akhir');

        $viewBookingModel = new ViewBookingModel();

        if ($tanggal_awal && $tanggal_akhir) {
            $viewBookingModel->where('view_booking.tanggal >=', $tanggal_awal);
            $viewBookingModel->where('view_booking.tanggal <=', $tanggal_akhir);
        }

        $data = [
            'title' => 'Laporan Booking',
            'booking' => $viewBookingModel->findAll()
        ];

        return view('admin/booking/laporan', $data);
    }
}
