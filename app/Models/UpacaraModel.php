<?php

namespace App\Models;

use CodeIgniter\Model;

class UpacaraModel extends Model
{
    protected $table = 'upacara';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'keterangan', 'tanggal_acara'];
    protected $useTimestamps = false;

    public function getAllUpacara()
    {
        return $this->orderBy('id', 'DESC')->findAll();
    }

    public function deleteUpacara($id)
    {
        return $this->delete($id);
    }

    public function createUpacara($data)
    {
        return $this->insert($data);
    }

    public function updateUpacara($id, $data)
    {
        return $this->update($id, $data);
    }

    public function getUpacaraById($id)
    {
        return $this->find($id);
    }
}
