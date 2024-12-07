<?php

namespace App\Models;

use CodeIgniter\Model;

class InstruksiModel extends Model
{
    protected $table = 'instruksi_pimpinan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'keterangan', 'tanggal_acara'];
    protected $useTimestamps = false; // Menggunakan timestamps untuk 'created_at' dan 'updated_at' jika diperlukan

    // Untuk mengambil semua data instruksi, diurutkan berdasarkan ID
    public function getAllInstruksi()
    {
        return $this->orderBy('id', 'DESC')->findAll();
    }

    // Untuk mendapatkan instruksi berdasarkan ID
    public function getInstruksiById($id)
    {
        return $this->find($id);
    }

    // Fungsi untuk menambahkan instruksi
    public function createInstruksi($data)
    {
        return $this->insert($data);
    }

    // Fungsi untuk memperbarui instruksi
    public function updateInstruksi($id, $data)
    {
        return $this->update($id, $data);
    }

    // Fungsi untuk menghapus instruksi
    public function deleteInstruksi($id)
    {
        return $this->delete($id);
    }
}
