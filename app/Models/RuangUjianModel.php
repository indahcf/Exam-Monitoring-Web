<?php

namespace App\Models;

use CodeIgniter\Model;

class RuangUjianModel extends Model
{
    protected $table            = 'ruang_ujian';
    protected $primaryKey       = 'id_ruang_ujian';
    protected $allowedFields    = ['ruang_ujian', 'kapasitas'];

    public function getRuangUjian($id_ruang_ujian = false)
    {
        if ($id_ruang_ujian == false) {
            return $this->findAll();
        }

        return $this->where(['ruang_ujian.id_ruang_ujian' => $id_ruang_ujian])->first();
    }
}
