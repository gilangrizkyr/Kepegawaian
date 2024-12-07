<?php

namespace App\Models;

use CodeIgniter\Model;

class AcaraModel extends Model
{
    protected $table = 'acara';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name',
        'keterangan',
        'tanggal_acara'
    ];

    public function getAllAcara()
    {
        return $this->orderBy('id', 'DESC')->findAll();
    }

    public function deleteAcara($id)
    {
        return $this->delete($id);
    }

    public function createAcara($data)
    {
        return $this->insert($data);
    }

    public function updateAcara($id, $data)
    {
        return $this->update($id, $data);
    }

    public function getAcaraById($id)
    {
        return $this->find($id);
    }
}
