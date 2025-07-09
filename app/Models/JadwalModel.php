<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalModel extends Model
{
    protected $table = 'jadwal';
    protected $primaryKey = 'id';
    protected $allowedFields = ['capster_id', 'tanggal', 'jam', 'status'];

    // JOIN tabel capster untuk ambil nama capster dan info lain
    public function getWithCapster()
    {
        return $this->select('jadwal.*, capster.nama, capster.pengalaman')
            ->join('capster', 'capster.id = jadwal.capster_id')
            ->orderBy('tanggal', 'ASC')
            ->orderBy('jam', 'ASC')
            ->findAll();
    }
}
