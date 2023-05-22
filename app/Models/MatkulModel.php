<?php

namespace App\Models;

use CodeIgniter\Model;

class MatkulModel extends Model
{
    protected $table            = 'matkul';
    protected $primaryKey       = 'id_matkul';
    protected $allowedFields    = ['id_prodi', 'kode_matkul', 'matkul', 'jumlah_sks', 'semester'];
    protected $useTimestamps    = true;

    public function getMatkul($id_matkul = false)
    {
        if ($id_matkul == false) {
            return $this->join('prodi', 'matkul.id_prodi=prodi.id_prodi')->findAll();
        }

        return $this->where(['matkul.id_matkul' => $id_matkul])->join('prodi', 'matkul.id_prodi=prodi.id_prodi')->first();
    }
}
