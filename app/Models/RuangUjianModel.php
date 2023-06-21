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
        $ruang_ada = $this->db->table('jadwal_ruang')->select('ruang_ujian.ruang_ujian')->join('ruang_ujian', 'jadwal_ruang.id_ruang_ujian=ruang_ujian.id_ruang_ujian', 'right')->join('jadwal_ujian', 'jadwal_ruang.id_jadwal_ujian=jadwal_ujian.id_jadwal_ujian', 'left')->where('tanggal = "' . $tanggal . '" AND ("' . $jam_mulai . '" BETWEEN jam_mulai AND jam_selesai OR "' . $jam_selesai . '" BETWEEN jam_mulai AND jam_selesai OR ("' . $jam_mulai . '" <= jam_mulai AND "' . $jam_selesai . '" >= jam_selesai))');
        // dd($ruang_ada);
        return $this->db->table('ruang_ujian')->select('*')->whereNotIn('ruang_ujian', $ruang_ada)->Get()->getResultArray();
    }

    public function getRuanganTersediaEdit($tanggal, $jam_mulai, $jam_selesai, $id_jadwal_ujian)
    {
        $ruang_ada = $this->db->table('jadwal_ruang')->where("jadwal_ruang.id_jadwal_ujian !=", $id_jadwal_ujian)->join('ruang_ujian', 'jadwal_ruang.id_ruang_ujian=ruang_ujian.id_ruang_ujian', 'right')->join('jadwal_ujian', 'jadwal_ruang.id_jadwal_ujian=jadwal_ujian.id_jadwal_ujian', 'left')->where('tanggal = "' . $tanggal . '" AND ("' . $jam_mulai . '" BETWEEN jam_mulai AND jam_selesai OR "' . $jam_selesai . '" BETWEEN jam_mulai AND jam_selesai OR ("' . $jam_mulai . '" <= jam_mulai AND "' . $jam_selesai . '" >= jam_selesai))');
        // dd($ruang_ada);
        return $this->db->table('ruang_ujian')->select('*')->join('jadwal_ruang', 'jadwal_ruang.id_ruang_ujian=ruang_ujian.id_ruang_ujian')->whereNotIn('ruang_ujian', $ruang_ada)->Get()->getResultArray();
    }

    // public function getRuanganTersediaEdit($tanggal, $jam_mulai, $jam_selesai, $id_jadwal_ujian)
    // {
    //     $ruang_ada = $this->db->table('jadwal_ruang')->select('ruang_ujian.ruang_ujian')->join('ruang_ujian', 'jadwal_ruang.id_ruang_ujian=ruang_ujian.id_ruang_ujian', 'right')->join('jadwal_ujian', 'jadwal_ruang.id_jadwal_ujian=jadwal_ujian.id_jadwal_ujian', 'left')->where('tanggal = "' . $tanggal . '" AND ("' . $jam_mulai . '" BETWEEN jam_mulai AND jam_selesai OR "' . $jam_selesai . '" BETWEEN jam_mulai AND jam_selesai OR ("' . $jam_mulai . '" <= jam_mulai AND "' . $jam_selesai . '" >= jam_selesai))');
    //     // dd($ruang_ada);
    //     return $this->db->table('ruang_ujian')->select('*')->join('jadwal_ruang', 'jadwal_ruang.id_ruang_ujian=ruang_ujian.id_ruang_ujian')->where('jadwal_ruang.id_jadwal_ujian !=', $id_jadwal_ujian)->whereNotIn('ruang_ujian', $ruang_ada)->Get()->getResultArray();
    // }

    // public function getRuanganTersediaEdit($tanggal, $jam_mulai, $jam_selesai, $id_jadwal_ujian)
    // {
    //     $ruang_ada = $this->db->table('jadwal_ruang')->select('ruang_ujian.ruang_ujian')->join('ruang_ujian', 'jadwal_ruang.id_ruang_ujian=ruang_ujian.id_ruang_ujian', 'right')->join('jadwal_ujian', 'jadwal_ruang.id_jadwal_ujian=jadwal_ujian.id_jadwal_ujian', 'left')->where('tanggal = "' . $tanggal . '" AND ("' . $jam_mulai . '" BETWEEN jam_mulai AND jam_selesai OR "' . $jam_selesai . '" BETWEEN jam_mulai AND jam_selesai OR ("' . $jam_mulai . '" <= jam_mulai AND "' . $jam_selesai . '" >= jam_selesai))');
    //     // dd($ruang_ada);
    //     return $this->db->table('ruang_ujian')->select('*')->join('jadwal_ruang', 'jadwal_ruang.id_ruang_ujian=ruang_ujian.id_ruang_ujian')->where('jadwal_ruang.id_jadwal_ujian !=', $id_jadwal_ujian)->whereNotIn('ruang_ujian', $ruang_ada)->Get()->getResultArray();
    // }
}
