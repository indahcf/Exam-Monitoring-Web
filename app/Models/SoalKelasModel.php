<?php

namespace App\Models;

use CodeIgniter\Model;

class SoalKelasModel extends Model
{
    protected $table            = 'soal_kelas';
    protected $primaryKey       = 'id_soal_kelas';
    protected $allowedFields    = ['id_soal_ujian', 'id_kelas'];
    protected $useTimestamps    = true;
}
