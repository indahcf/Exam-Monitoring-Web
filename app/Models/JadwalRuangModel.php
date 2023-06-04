<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalRuangModel extends Model
{
    protected $table            = 'jadwal_ruang';
    protected $primaryKey       = 'id_jadwal_ruang';
    protected $allowedFields    = ['id_jadwal_ujian', 'id_ruang_ujian', 'jumlah_peserta'];
    protected $useTimestamps    = true;

    // public function getJadwalRuang()
    // {
    //     return $this->join('jadwal_ujian', 'jadwal_ruang.id_jadwal_ujian=jadwal_ujian.id_jadwal_ujian')->join('ruang_ujian', 'jadwal_ruang.id_ruang_ujian=ruang_ujian.id_ruang_ujian')->findAll();
    // }
}
