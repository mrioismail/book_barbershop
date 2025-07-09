<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ViewBookingModel;

class Notifikasi extends BaseController
{
    public function index()
    {
        $viewBooking = new ViewBookingModel();

        $notifBooking = $viewBooking
            ->where('DATE(dibuat_pada)', date('Y-m-d'))
            ->where('status', 'booked')
            ->orderBy('dibuat_pada', 'DESC')
            ->findAll(5);

        return view('admin/notifikasi_booking', [
            'notifBooking' => $notifBooking
        ]);
    }
};
