<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalRuangModel extends Model
{
    protected $table            = 'jadwal_ruang';
    protected $primaryKey       = 'id_jadwal_ruang';
    protected $allowedFields    = ['id_jadwal_ujian', 'id_ruang_ujian', 'jumlah_peserta'];
    protected $useTimestamps    = true;
}
