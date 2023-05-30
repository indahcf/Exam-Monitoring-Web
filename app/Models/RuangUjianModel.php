<?php

namespace App\Models;

use CodeIgniter\Model;

class RuangUjianModel extends Model
{
    protected $table            = 'ruang_ujian';
    protected $primaryKey       = 'id_ruang_ujian';
    protected $allowedFields    = ['ruang_ujian', 'kapasitas'];
    protected $useTimestamps    = true;
}
