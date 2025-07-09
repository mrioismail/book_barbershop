<?php

namespace App\Models;

use CodeIgniter\Model;

class ViewBookingModel extends Model
{
    protected $table            = 'view_booking';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [];
    protected $useTimestamps    = false;
}
