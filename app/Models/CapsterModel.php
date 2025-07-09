<?php

namespace App\Models;

use CodeIgniter\Model;

class CapsterModel extends Model
{
    protected $table = 'capster';
    protected $primaryKey = 'id';
    protected $allowedFields = ['foto_capster', 'nama', 'pengalaman'];
}
