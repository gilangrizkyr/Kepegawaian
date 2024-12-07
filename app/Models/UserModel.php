<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'data_karyawan';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name',
        'nip',
        'foto_profil',
        'jenis_kelamin',
        'pendidikan_terakhir',
        'golongan_terakhir',
        'jabatan_terakhir',
        'status',
        'tanggal_masuk',
        'tanggal_keluar',
        'keterangan'
    ];

    public function get_all_users()
    {
        return $this->orderBy('id', 'DESC')->findAll();
    }

    public function get_user_by_id($id)
    {
        return $this->find($id);
    }

    public function insert_user($data)
    {
        if (!$this->insert($data)) {
            log_message('error', 'Gagal menyimpan data: ' . implode(', ', $this->errors()));
            return false;
        }
        return true;
    }

    public function update_user($id, $data)
    {
        return $this->update($id, $data);
    }

    public function delete_user($id)
    {
        return $this->delete($id);
    }
    public function getStatusCounts()
    {
        return $this->select('status, COUNT(*) as count')
            ->groupBy('status')
            ->findAll();
    }
}
