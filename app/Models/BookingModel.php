<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table      = 'booking';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nama_customer',
        'no_hp',
        'layanan_id',
        'capster_id',
        'tanggal',
        'jam',
        'catatan',
        'status',
        'dibuat_pada',
    ];
}
