<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratModel extends Model
{
    protected $table = 'surat';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nomor_surat', 'kepada', 'tembusan', 'tahun', 'tanggal_keluar', 'perihal', 'status', 'alasan_dibatalkan'];
    protected $useTimestamps = true;
}
