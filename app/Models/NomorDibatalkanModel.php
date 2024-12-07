<?php

namespace App\Models;

use CodeIgniter\Model;

class NomorDibatalkanModel extends Model
{
    protected $table = 'nomor_dibatalkan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nomor_surat', 'alasan_dibatalkan'];
    protected $useTimestamps = true;
}
