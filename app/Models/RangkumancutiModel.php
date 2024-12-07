<?php

namespace App\Models;

use CodeIgniter\Model;

class RangkumancutiModel extends Model
{
    protected $table = 'histori_cuti';
    protected $primaryKey = 'id';
    protected $allowedFields = ['karyawan_id', 'tanggal_mulai', 'tanggal_akhir', 'jumlah_hari', 'keterangan', 'tahun_cuti', 'created_at'];

    public function getRangkumanCuti()
    {
        return $this->db->query("
            SELECT 
                d.name AS nama_karyawan, -- Mengambil nama karyawan
                COUNT(*) AS jumlah_cuti,
                MIN(h.tanggal_mulai) AS tanggal_mulai_pertama,
                MAX(h.tanggal_akhir) AS tanggal_akhir_terakhir,
                GROUP_CONCAT(CONCAT(h.tanggal_mulai, ' - ', h.tanggal_akhir, ' | ', h.keterangan) SEPARATOR '; ') AS rincian_cuti
            FROM 
                histori_cuti h
            JOIN 
                data_karyawan d ON d.id = h.karyawan_id
            GROUP BY 
                d.id
            ORDER BY 
                d.id
        ")->getResult();
    }
}
