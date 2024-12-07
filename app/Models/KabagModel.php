<?php

namespace App\Models;

use CodeIgniter\Model;

class KabagModel extends Model
{
    protected $table = 'kabags'; 
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'created_at']; 

    public function getAllKabags()
    {
        return $this->findAll(); 
    }
}
