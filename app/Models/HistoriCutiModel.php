<?php

namespace App\Models;

use CodeIgniter\Model;

class HistoriCutiModel extends Model
{
    protected $table = 'histori_cuti';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'karyawan_id',
        'tanggal_mulai',
        'tanggal_akhir',
        'jumlah_hari',
        'keterangan',
        'tahun_cuti',
        'created_at'
    ];
    
    public function getHistoriByKaryawanId($karyawanId)
    {
        return $this->where('karyawan_id', $karyawanId)->findAll();
    }
}

