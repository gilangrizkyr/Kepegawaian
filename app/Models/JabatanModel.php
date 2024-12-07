<?php

namespace App\Models;

use CodeIgniter\Model;

class JabatanModel extends Model
{
    protected $table = 'jabatan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name'];

    public function getAllData()
    {
        return $this->orderBy('id', 'DESC')->findAll();
    }
}
