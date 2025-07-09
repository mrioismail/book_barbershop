<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\LayananModel;
use App\Models\CapsterModel;
use App\Models\JadwalModel;
use App\Models\BookingModel;
use App\Models\ViewBookingModel;

class Home extends BaseController
{
    protected $LayananModel;
    protected $CapsterModel;
    protected $JadwalModel;
    protected $BookingModel;
    protected $ViewBookingModel;

    public function __construct()
    {
        $this->LayananModel = new LayananModel();
        $this->CapsterModel = new CapsterModel();
        $this->JadwalModel = new JadwalModel();
        $this->BookingModel = new BookingModel();
        $this->ViewBookingModel = new ViewBookingModel();
    }
    public function index()
    {
        $data = [
            'total_layanan'        => $this->LayananModel->countAll(),
            'total_capster'        => $this->CapsterModel->countAll(),
            'jadwal_tersedia'      => $this->JadwalModel->where('status', 'tersedia')->countAllResults(),
            'jadwal_penuh'         => $this->JadwalModel->where('status', 'penuh')->countAllResults(),
            'total_booking'        => $this->BookingModel->countAll(),
            'total_selesai'        => $this->ViewBookingModel->where('status', 'selesai')->countAllResults(),
            'total_batal'          => $this->ViewBookingModel->where('status', 'batal')->countAllResults(),
            'total_booked'         => $this->ViewBookingModel->where('status', 'booked')->countAllResults(),
            'total_harga_selesai'  => $this->ViewBookingModel
                ->selectSum('harga')
                ->where('status', 'selesai')
                ->get()->getRow()->harga ?? 0
        ];

        return view('admin/home', $data);
    }
}
