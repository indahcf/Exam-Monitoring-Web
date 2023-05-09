<?php

namespace App\Models;

use CodeIgniter\Model;

class DosenModel extends Model
{
    protected $table            = 'dosen';
    protected $primaryKey       = 'id_dosen';
    protected $allowedFields    = ['id_prodi', 'nidn', 'dosen'];

    public function getDosen($id_dosen = false)
    {
        if ($id_dosen == false) {
            return $this->join('prodi', 'dosen.id_prodi=prodi.id_prodi')->findAll();
        }

        return $this->where(['dosen.id_dosen' => $id_dosen])->join('prodi', 'dosen.id_prodi=prodi.id_prodi')->first();
    }

    public function editDosen($id_dosen = false)
    {
        if ($id_dosen == false) {
            return $this->findAll();
        }

        return $this->where(['dosen.id_dosen' => $id_dosen])->first();
    }
}
