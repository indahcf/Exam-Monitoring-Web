<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalUjianModel extends Model
{
    protected $table            = 'jadwal_ujian';
    protected $primaryKey       = 'id_jadwal_ujian';
    protected $allowedFields    = ['id_prodi', 'id_kelas', 'id_dosen', 'id_ruang_ujian', 'id_tahun_akademik', 'jumlah_peserta', 'waktu_ujian', 'total_hadir', 'jumlah_lju'];
    protected $useTimestamps    = true;

    public function getJadwalUjian($id_jadwal_ujian = false)
    {
        if ($id_jadwal_ujian == false) {
            return $this->join('prodi', 'jadwal_ujian.id_prodi=prodi.id_prodi')->join('kelas', 'jadwal_ujian.id_kelas=kelas.id_kelas')->join('dosen', 'jadwal_ujian.id_dosen=dosen.id_dosen')->join('ruang_ujian', 'jadwal_ujian.id_ruang_ujian=ruang_ujian.id_ruang_ujian')->join('tahun_akademik', 'jadwal_ujian.id_tahun_akademik=tahun_akademik.id_tahun_akademik')->join('matkul', 'jadwal_ujian.id_matkul=matkul.id_matkul')->findAll();
        }

        return $this->where(['jadwal_ujian.id_jadwal_ujian' => $id_jadwal_ujian])->join('prodi', 'jadwal_ujian.id_prodi=prodi.id_prodi')->join('kelas', 'jadwal_ujian.id_kelas=kelas.id_kelas')->join('dosen', 'jadwal_ujian.id_dosen=dosen.id_dosen')->join('ruang_ujian', 'jadwal_ujian.id_ruang_ujian=ruang_ujian.id_ruang_ujian')->join('tahun_akademik', 'jadwal_ujian.id_tahun_akademik=tahun_akademik.id_tahun_akademik')->join('matkul', 'jadwal_ujian.id_matkul=matkul.id_matkul')->first();
    }

    public function allKelas($id_prodi)
    {
        return $this->db->table('kelas')->where('id_prodi', $id_prodi)->Get()->getResultArray();
    }

    public function allDosen($id_kelas)
    {
        return $this->db->table('dosen')->where('id_kelas', $id_kelas)->Get()->getResultArray();
    }
}
