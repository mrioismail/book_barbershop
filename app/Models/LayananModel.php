<?php

namespace App\Models;

use CodeIgniter\Model;

class LayananModel extends Model
{
    protected $table = 'layanan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['foto_layanan', 'nama_layanan', 'harga_layanan', 'detail_layanan'];
}
