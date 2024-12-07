<?php

namespace App\Models;

use CodeIgniter\Model;

class AccountMovementModel extends Model
{
    protected $table = 'account_movements';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'from_kabag_id', 'to_kabag_id', 'status', 'created_at'];

    public function insert_movement($data)
    {
        return $this->insert($data);
    }
}
