<?php

namespace App\Models;

use CodeIgniter\Model;

class UserRoleModel extends Model
{
    protected $table            = 'user_role';
    protected $primaryKey       = 'id_user_role';
    protected $allowedFields    = ['id_user', 'id_role'];
    protected $useTimestamps    = true;

    public function getRoleNameByUserId($id_user)
    {
        $role = $this->join('role', 'user_role.id_role=role.id_role')->where('user_role.id_user', $id_user)->findAll();

        $roleName = array_column($role, 'role');

        return $roleName;
    }

    public function getIdRoleByUserId($id_user)
    {
        $role = $this->join('role', 'user_role.id_role=role.id_role')->where('user_role.id_user', $id_user)->findAll();

        $roleName = array_column($role, 'id_role');

        return $roleName;
    }
}
