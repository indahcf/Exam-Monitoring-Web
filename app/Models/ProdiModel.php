<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdiModel extends Model
{
    protected $table            = 'prodi';
    protected $primaryKey       = 'id_prodi';
    protected $allowedFields    = ['prodi'];
    protected $useTimestamps    = true;

    public function getProdi($id_prodi = false)
    {
        if ($id_prodi == false) {
            return $this->findAll();
        }

        return $this->where(['prodi.id_prodi' => $id_prodi])->first();
    }
}
