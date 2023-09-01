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
            ->select('jadwal_ruang.*, jadwal_ujian.*, ruang_ujian.*, kelas.*, matkul.*, dosen.*, prodi.*, tahun_akademik.*, kehadiran_pengawas.pengawas_1, kehadiran_pengawas.pengawas_2, kehadiran_pengawas.pengawas_3, pengawas1.pengawas as pengawas_bertugas_1, pengawas2.pengawas as pengawas_bertugas_2')
            ->join('jadwal_ujian', 'jadwal_ujian.id_jadwal_ujian=jadwal_ruang.id_jadwal_ujian')
            ->join('tahun_akademik', 'jadwal_ujian.id_tahun_akademik=tahun_akademik.id_tahun_akademik')
            ->join('ruang_ujian', 'jadwal_ruang.id_ruang_ujian=ruang_ujian.id_ruang_ujian')
            ->join('kelas', 'jadwal_ujian.id_kelas=kelas.id_kelas')
            ->join('matkul', 'kelas.id_matkul=matkul.id_matkul')
            ->join('dosen', 'kelas.id_dosen=dosen.id_dosen')
            ->join('prodi', 'matkul.id_prodi=prodi.id_prodi')
            ->join('kehadiran_pengawas', 'jadwal_ruang.id_jadwal_ruang=kehadiran_pengawas.id_jadwal_ruang', 'left')
            ->join('pengawas as pengawas1', 'kehadiran_pengawas.pengawas_1=pengawas1.id_pengawas', 'left')
            ->join('pengawas as pengawas2', 'kehadiran_pengawas.pengawas_2=pengawas2.id_pengawas', 'left')
            ->where('jadwal_ujian.id_tahun_akademik', $id_tahun_akademik)
            ->where('periode_ujian', $periode_ujian)
            ->orderBy('jadwal_ujian.id_jadwal_ujian', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function filterKehadiranPengawasKoordinator($id_tahun_akademik, $periode_ujian)
    {
        $id_users = user_id();
        $id_koordinator = $this->db->table('dosen')->join('users', 'users.id=dosen.id_user')->where('id', $id_users)->Get()->getRow()->id_dosen;
        return $this->db->table('jadwal_ruang')
            ->select('jadwal_ruang.*, jadwal_ujian.*, ruang_ujian.*, kelas.*, matkul.*, dosen.*, prodi.*, tahun_akademik.*, kehadiran_pengawas.pengawas_1, kehadiran_pengawas.pengawas_2, kehadiran_pengawas.pengawas_3, pengawas1.pengawas as pengawas_bertugas_1, pengawas2.pengawas as pengawas_bertugas_2')
            ->join('jadwal_ujian', 'jadwal_ujian.id_jadwal_ujian=jadwal_ruang.id_jadwal_ujian')
            ->join('tahun_akademik', 'jadwal_ujian.id_tahun_akademik=tahun_akademik.id_tahun_akademik')
            ->join('ruang_ujian', 'jadwal_ruang.id_ruang_ujian=ruang_ujian.id_ruang_ujian')
            ->join('kelas', 'jadwal_ujian.id_kelas=kelas.id_kelas')
            ->join('matkul', 'kelas.id_matkul=matkul.id_matkul')
            ->join('dosen', 'kelas.id_dosen=dosen.id_dosen')
            ->join('prodi', 'matkul.id_prodi=prodi.id_prodi')
            ->join('kehadiran_pengawas', 'jadwal_ruang.id_jadwal_ruang=kehadiran_pengawas.id_jadwal_ruang', 'left')
            ->join('pengawas as pengawas1', 'kehadiran_pengawas.pengawas_1=pengawas1.id_pengawas', 'left')
            ->join('pengawas as pengawas2', 'kehadiran_pengawas.pengawas_2=pengawas2.id_pengawas', 'left')
            ->where('jadwal_ujian.id_tahun_akademik', $id_tahun_akademik)
            ->where('periode_ujian', $periode_ujian)
            ->where('jadwal_ujian.koordinator_ujian', $id_koordinator)
            ->orderBy('jadwal_ujian.id_jadwal_ujian', 'ASC')
            ->get()
            ->getResultArray();
    }
}
