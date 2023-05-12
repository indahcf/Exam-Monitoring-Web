<?php

namespace App\Models;

use CodeIgniter\Model;

class PengawasModel extends Model
{
    protected $table            = 'pengawas';
    protected $primaryKey       = 'id_pengawas';
    protected $allowedFields    = ['nip', 'pengawas'];

    public function getPengawas($id_pengawas = false)
    {
        if ($id_pengawas == false) {
            return $this->findAll();
        }

        return $this->where(['pengawas.id_pengawas' => $id_pengawas])->first();
    }
}
