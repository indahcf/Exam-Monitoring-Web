<?php

namespace App\Models;

use CodeIgniter\Model;

class RuangUjianModel extends Model
{
    protected $table            = 'ruang_ujian';
    protected $primaryKey       = 'id_ruang_ujian';
    protected $allowedFields    = ['ruang_ujian', 'kapasitas'];
    protected $useTimestamps    = true;

    // public function getRuanganTersedia($tanggal)
    // {
    //     return $this->join('jadwal_ruang', 'jadwal_ruang.id_ruang_ujian=ruang_ujian.id_ruang_ujian', 'left')->join('jadwal_ujian', 'jadwal_ujian.id_jadwal_ujian=jadwal_ruang.id_jadwal_ujian', 'right')->Get()->getResultArray();
    // }

    // public function getRuanganTersedia($tanggal, $jam_mulai, $jam_selesai)
    // {
    //     return $this->db->table('ruang_ujian')->join('jadwal_ruang', 'jadwal_ruang.id_ruang_ujian=ruang_ujian.id_ruang_ujian', 'left')->join('jadwal_ujian', 'jadwal_ujian.id_jadwal_ujian=jadwal_ruang.id_jadwal_ujian', 'right')->where('jadwal_ujian.tanggal !=', $tanggal)->where('jadwal_ujian.jam_mulai !=', $jam_mulai)->where('jadwal_ujian.jam_selesai !=', $jam_selesai)->Get()->getResultArray();
    // }

    public function getRuanganTersedia($tanggal, $jam_mulai, $jam_selesai)
    {
        return $this->db->table('ruang_ujian')->select('*')->join('jadwal_ruang', 'jadwal_ruang.id_ruang_ujian=ruang_ujian.id_ruang_ujian', 'left')->join('jadwal_ujian', 'jadwal_ujian.id_jadwal_ujian=jadwal_ruang.id_jadwal_ujian', 'left')->where('jadwal_ujian.tanggal =', $tanggal)->where('jadwal_ujian.jam_mulai =', $jam_mulai)->where('jadwal_ujian.jam_selesai =', $jam_selesai)->Get()->getResultArray();
    }
}
