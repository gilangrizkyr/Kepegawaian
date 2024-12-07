<?php

namespace App\Models;

use CodeIgniter\Model;

class DeskripsiModel extends Model
{
    protected $table = 'tampilan';  // Nama tabel yang digunakan
    protected $primaryKey = 'id';  // Kolom primary key
    protected $allowedFields = ['deskripsi'];  // Kolom yang bisa di-assign

    // Mengambil data deskripsi yang ada (harus hanya ada satu)
    public function getDeskripsi()
    {
        return $this->first();  // Mengambil data pertama, asumsinya hanya ada satu
    }
}
