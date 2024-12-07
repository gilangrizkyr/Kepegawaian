<?php

namespace App\Models;

use CodeIgniter\Model;

class CutiModel extends Model
{
    protected $table = 'data_karyawan';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name',
        'nip',
        'jenis_kelamin',
        'pendidikan_terakhir',
        'golongan_terakhir',
        'jabatan_terakhir',
        'status',
        'tanggal_masuk',
        'tanggal_keluar',
        'keterangan',
        'keterangan_cuti',
        'total_cuti',
        'sisa_cuti',
        'cuti_diambil',
        'tanggal_mulai_cuti',
        'tanggal_cuti_terakhir',
        'status_cuti'
    ];

    public function getHistoriCuti($id)
    {
        return $this->db->table('histori_cuti')
            ->where('karyawan_id', $id)
            ->get()
            ->getResultArray();
    }

    public function updateCuti($id, $sisaCuti, $cutiDiambil, $keterangan)
    {
        try {
            $this->update($id, [
                'sisa_cuti' => $sisaCuti,
                'cuti_diambil' => $cutiDiambil,
                'tanggal_cuti_terakhir' => date('Y-m-d'),
                'keterangan_cuti' => $keterangan
            ]);
        } catch (\Exception $e) {
            log_message('error', 'Error updating cuti: ' . $e->getMessage());
            throw $e;
        }
    }

    public function isSedangCuti($karyawanId)
    {
        $today = date('Y-m-d');

        return $this->where('id', $karyawanId)
            ->where('tanggal_mulai_cuti <=', $today)
            ->where('tanggal_cuti_terakhir >=', $today)
            ->first() !== null;
    }

    public function searchUsers($name = null, $nip = null)
    {
        $builder = $this->builder();

        if ($name) {
            $builder->like('name', $name);
        }
        if ($nip) {
            $builder->like('nip', $nip);
        }

        return $builder->get()->getResultArray();
    }

    public function getTotalCutiToday()
    {
        $today = date('Y-m-d');

        return $this->db->table('histori_cuti')
            ->where('tanggal_mulai <=', $today)
            ->where('tanggal_akhir >=', $today)
            ->countAllResults();
    }
}
