<?php

namespace App\Models;

use CodeIgniter\Model;

class KaryawanModel extends Model
{
    protected $table = 'data_karyawan';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name',
        'foto_profil',
        'nip',
        'jenis_kelamin',
        'pendidikan_terakhir',
        'status',
        'tanggal_masuk',
        'tanggal_keluar',
        'keterangan',
        'golongan_terakhir', // Foreign key to golongan
        'jabatan_terakhir'   // Foreign key to jabatan
    ];

    public function getAllData()
    {
        return $this->findAll();
    }
}
