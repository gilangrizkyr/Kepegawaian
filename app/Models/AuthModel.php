<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name',
        'nip',
        'jenis_kelamin',
        'username',
        'password',
        'role',
        'created_at',
        'jabatan',
    ];

    public function get_all_users()
    {
        return $this->findAll();
    }

    public function getEnumValues($table, $column)
    {
        $query = $this->db->query("SHOW COLUMNS FROM $table LIKE '$column'");
        $row = $query->getRow();
        if ($row) {
            preg_match('/^enum\((.*)\)$/', $row->Type, $matches);
            $enum = [];
            foreach (explode(',', $matches[1]) as $value) {
                $enum[] = trim($value, "'");
            }
            return $enum;
        }
        return [];
    }
}
