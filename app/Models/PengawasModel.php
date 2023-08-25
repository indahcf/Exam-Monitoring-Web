<?php

namespace App\Models;

use CodeIgniter\Model;

class PengawasModel extends Model
{
    protected $table            = 'pengawas';
    protected $primaryKey       = 'id_pengawas';
    protected $allowedFields    = ['id_user', 'nip', 'pengawas'];
    protected $useTimestamps    = true;

    public function getPengawas()
    {
        return $this->join('users', 'users.id=pengawas.id_user')->findAll();
    }

    public function getPengawasTersedia($tanggal, $jam_mulai, $jam_selesai)
    {
        $pengawas_ada = $this->db->table('jadwal_ruang')->select('pengawas.pengawas')->join('ruang_ujian', 'jadwal_ruang.id_ruang_ujian=ruang_ujian.id_ruang_ujian', 'right')->join('jadwal_ujian', 'jadwal_ruang.id_jadwal_ujian=jadwal_ujian.id_jadwal_ujian', 'left')->join('jadwal_pengawas', 'jadwal_ruang.id_jadwal_ruang=jadwal_pengawas.id_jadwal_ruang')->join('pengawas', 'jadwal_pengawas.id_pengawas=pengawas.id_pengawas')->where('tanggal = "' . $tanggal . '" AND ("' . $jam_mulai . '" BETWEEN jam_mulai AND jam_selesai OR "' . $jam_selesai . '" BETWEEN jam_mulai AND jam_selesai OR ("' . $jam_mulai . '" <= jam_mulai AND "' . $jam_selesai . '" >= jam_selesai))');
        // dd($pengawas_ada);
        return $this->db->table('pengawas')->select('*')->whereNotIn('pengawas', $pengawas_ada)->Get()->getResultArray();
    }

    public function getPengawasTersediaEdit($tanggal, $jam_mulai, $jam_selesai, $id_jadwal_ujian)
    {
        $pengawas_ada = $this->db->table('jadwal_ruang')->select('pengawas.pengawas')->join('ruang_ujian', 'jadwal_ruang.id_ruang_ujian=ruang_ujian.id_ruang_ujian', 'right')->join('jadwal_ujian', 'jadwal_ruang.id_jadwal_ujian=jadwal_ujian.id_jadwal_ujian', 'left')->join('jadwal_pengawas', 'jadwal_ruang.id_jadwal_ruang=jadwal_pengawas.id_jadwal_ruang')->join('pengawas', 'jadwal_pengawas.id_pengawas=pengawas.id_pengawas')->where('tanggal = "' . $tanggal . '" AND ("' . $jam_mulai . '" BETWEEN jam_mulai AND jam_selesai OR "' . $jam_selesai . '" BETWEEN jam_mulai AND jam_selesai OR ("' . $jam_mulai . '" <= jam_mulai AND "' . $jam_selesai . '" >= jam_selesai)) AND jadwal_ujian.id_jadwal_ujian != "' . $id_jadwal_ujian . '"');
        // dd($pengawas_ada);
        return $this->db->table('pengawas')->select('*')->whereNotIn('pengawas', $pengawas_ada)->Get()->getResultArray();
    }
}
