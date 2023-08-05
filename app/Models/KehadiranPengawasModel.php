<?php

namespace App\Models;

use CodeIgniter\Model;

class KehadiranPengawasModel extends Model
{
    protected $table            = 'kehadiran_pengawas';
    protected $primaryKey       = 'id_kehadiran_pengawas';
    protected $allowedFields    = ['id_jadwal_ruang', 'pengawas_1', 'pengawas_2', 'pengawas_3'];
    protected $useTimestamps    = true;

    public function filterKehadiranPengawas($id_tahun_akademik, $periode_ujian)
    {
        // dd($id_tahun_akademik);
        // dd($periode_ujian);
        return $this->db->table('jadwal_ruang')
            ->select('jadwal_ruang.*, jadwal_ujian.*, ruang_ujian.*, kelas.*, matkul.*, dosen.*, prodi.*, pengawas.*, jadwal_pengawas.*, tahun_akademik.*')
            ->join('jadwal_ujian', 'jadwal_ujian.id_jadwal_ujian=jadwal_ruang.id_jadwal_ujian', 'right')
            ->join('ruang_ujian', 'jadwal_ruang.id_ruang_ujian=ruang_ujian.id_ruang_ujian', 'left')
            ->join('kelas', 'jadwal_ujian.id_kelas=kelas.id_kelas')
            ->join('matkul', 'kelas.id_matkul=matkul.id_matkul')
            ->join('dosen', 'kelas.id_dosen=dosen.id_dosen')
            ->join('prodi', 'matkul.id_prodi=prodi.id_prodi')
            ->join('jadwal_pengawas', 'jadwal_ruang.id_jadwal_ruang=jadwal_pengawas.id_jadwal_ruang')
            ->join('pengawas', 'jadwal_pengawas.id_pengawas=pengawas.id_pengawas')
            ->join('tahun_akademik', 'jadwal_ujian.id_tahun_akademik=tahun_akademik.id_tahun_akademik')
            ->where('jadwal_ujian.id_tahun_akademik', $id_tahun_akademik)
            ->where('periode_ujian', $periode_ujian)
            ->get()
            ->getResultArray();
    }
}
