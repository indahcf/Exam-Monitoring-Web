<?php

namespace App\Models;

use CodeIgniter\Model;

class TahunAkademikModel extends Model
{
    protected $table            = 'tahun_akademik';
    protected $primaryKey       = 'id_tahun_akademik';
    protected $allowedFields    = ['tahun', 'semester', 'aktif'];

    public function getTahunAkademik($id_tahun_akademik = false)
    {
        if ($id_tahun_akademik == false) {
            return $this->findAll();
        }

        return $this->where(['tahun_akademik.id_tahun_akademik' => $id_tahun_akademik])->first();
    }
}
