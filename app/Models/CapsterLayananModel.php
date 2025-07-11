<?php

namespace App\Models;

use CodeIgniter\Model;

class CapsterLayananModel extends Model
{
    protected $table = 'capster_layanan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['capster_id', 'layanan_id', 'harga'];

    public function getByCapster($capster_id)
    {
        return $this->select('capster_layanan.*, layanan.nama as nama_layanan')
            ->join('layanan', 'layanan.id = capster_layanan.layanan_id')
            ->where('capster_id', $capster_id)
            ->findAll();
    }

    public function getCapsterLayanan()
    {
        // buat relasi ke tabel capster dan layanan
        return $this->select('capster_layanan.*, capster.nama, layanan.nama_layanan')
            ->join('capster', 'capster.id = capster_layanan.capster_id')
            ->join('layanan', 'layanan.id = capster_layanan.layanan_id')
            ->findAll();
    }
}
