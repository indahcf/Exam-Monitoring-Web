<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['fullname', 'email', 'role', 'password_hash'];
    protected $useTimestamps    = true;
}
