<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['email', 'password_hash'];
    protected $useTimestamps    = true;

    public function getUser()
    {
        return $this->join('user_role', 'user_role.id_user=users.id', 'left')
            ->join('role', 'role.id_role=user_role.id_role', 'left')
            ->findAll();
    }
}
