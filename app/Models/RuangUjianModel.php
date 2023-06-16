<?php

namespace App\Models;

use CodeIgniter\Model;

class RuangUjianModel extends Model
{
    protected $table            = 'ruang_ujian';
    protected $primaryKey       = 'id_ruang_ujian';
    protected $allowedFields    = ['ruang_ujian', 'kapasitas'];
    protected $useTimestamps    = true;
    protected $db;

    // public function __construct()
    // {
    //     $this->db = \Config\Database::connect();
    // }

    // public function getRuanganTersedia($tanggal)
    // {
    //     return $this->join('jadwal_ruang', 'jadwal_ruang.id_ruang_ujian=ruang_ujian.id_ruang_ujian', 'left')->join('jadwal_ujian', 'jadwal_ujian.id_jadwal_ujian=jadwal_ruang.id_jadwal_ujian', 'right')->Get()->getResultArray();
    // }

    // public function getRuanganTersedia($tanggal, $jam_mulai, $jam_selesai)
    // {
    //     return $this->db->table('ruang_ujian')->join('jadwal_ruang', 'jadwal_ruang.id_ruang_ujian=ruang_ujian.id_ruang_ujian', 'left')->join('jadwal_ujian', 'jadwal_ujian.id_jadwal_ujian=jadwal_ruang.id_jadwal_ujian', 'right')->where('jadwal_ujian.tanggal !=', $tanggal)->where('jadwal_ujian.jam_mulai !=', $jam_mulai)->where('jadwal_ujian.jam_selesai !=', $jam_selesai)->Get()->getResultArray();
    // }

    // public function getRuanganTersedia($tanggal, $jam_mulai, $jam_selesai)
    // {
    //     return $this->db->table('ruang_ujian')->select('*')->join('jadwal_ruang', 'jadwal_ruang.id_ruang_ujian=ruang_ujian.id_ruang_ujian', 'left')->join('jadwal_ujian', 'jadwal_ujian.id_jadwal_ujian=jadwal_ruang.id_jadwal_ujian', 'left')->where('jadwal_ujian.tanggal =', $tanggal)->where('jadwal_ujian.jam_mulai =', $jam_mulai)->where('jadwal_ujian.jam_selesai =', $jam_selesai)->Get()->getResultArray();
    // }

    // public function cobaRawQuery($tanggal, $jam_mulai, $jam_selesai)
    // {
    //     $sql = 'SELECT * FROM ruang_ujian LEFT JOIN `jadwal_ruang` ON `jadwal_ruang`.`id_ruang_ujian` = `ruang_ujian`.`id_ruang_ujian` LEFT JOIN `jadwal_ujian` ON `jadwal_ujian`.`id_jadwal_ujian` = `jadwal_ruang`.`id_jadwal_ujian` WHERE tanggal != ? AND jam_mulai != ? AND jam_selesai != ?';
    //     $result = $this->db->query($sql, [$tanggal, $jam_mulai, $jam_selesai]);
    //     return $result->getResultArray();
    // }

    public function getRuanganTersedia($tanggal, $jam_mulai, $jam_selesai)
    {
        $ruang_ada = $this->db->table('jadwal_ruang')->select('ruang_ujian.ruang_ujian')->join('ruang_ujian', 'jadwal_ruang.id_ruang_ujian=ruang_ujian.id_ruang_ujian', 'right')->join('jadwal_ujian', 'jadwal_ruang.id_jadwal_ujian=jadwal_ujian.id_jadwal_ujian', 'left')->where('jadwal_ujian.tanggal =', $tanggal)->where('jadwal_ujian.jam_mulai <=', $jam_mulai)->where('jadwal_ujian.jam_selesai >=', $jam_selesai);
        // dd($ruang_ada);
        return $this->db->table('ruang_ujian')->select('*')->whereNotIn('ruang_ujian', $ruang_ada)->Get()->getResultObject();
    }

    // public function cobaRawQuery()
    // {
    //     $sql = 'SELECT * FROM ruang_ujian LEFT JOIN `jadwal_ruang` ON `jadwal_ruang`.`id_ruang_ujian` = `ruang_ujian`.`id_ruang_ujian` LEFT JOIN `jadwal_ujian` ON `jadwal_ujian`.`id_jadwal_ujian` = `jadwal_ruang`.`id_jadwal_ujian`';
    //     $result = $this->db->query($sql);
    //     return $result->getResultArray();
    // }
}
