<?php

namespace App\Models;

use CodeIgniter\Model;

class MatkulModel extends Model
{
    protected $table            = 'prodi';
    protected $primaryKey       = 'id_matkul';
    protected $allowedFields    = ['id_prodi', 'kode_matkul', 'matkul', 'jumlah_sks', 'semester'];

    public function getMatkul($id_matkul = false)
    {
        if ($id_matkul == false) {
            return $this->findAll();
        }

        return $this->where(['matkul.id_matkul' => $id_matkul])->first();
    }
}
