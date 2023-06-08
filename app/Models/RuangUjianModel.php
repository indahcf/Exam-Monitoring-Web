<?php

namespace App\Models;

use CodeIgniter\Model;

class RuangUjianModel extends Model
{
    protected $table            = 'ruang_ujian';
    protected $primaryKey       = 'id_ruang_ujian';
    protected $allowedFields    = ['ruang_ujian', 'kapasitas'];
    protected $useTimestamps    = true;

    public function getRuanganTersedia($tanggal, $jam_mulai, $jam_selesai)
    {
        return $this->join('jadwal_ujian')->join('jadwal_ruang', 'jadwal_ujian.id_jadwal_ujian=jadwal_ruang.id_jadwal_ujian')->where('jadwal_ujian !=', $tanggal)->where('jadwal_ujian !=', $jam_mulai)->where('jadwal_ujian !=', $jam_selesai)->Get()->getResultArray();
    }
}
