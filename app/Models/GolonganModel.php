<?php

namespace App\Models;

use CodeIgniter\Model;

class GolonganModel extends Model
{
    protected $table = 'golongan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name'];

    public function getAllData()
    {
        return $this->findAll();
    }
}
