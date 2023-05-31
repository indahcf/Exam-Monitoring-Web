<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalUjianModel extends Model
{
    protected $table            = 'jadwal_ujian';
    protected $primaryKey       = 'id_jadwal_ujian';
    protected $allowedFields    = ['id_kelas', 'id_ruang_ujian', 'id_tahun_akademik', 'jumlah_peserta', 'tanggal', 'jam_mulai', 'jam_selesai', 'total_hadir', 'jumlah_lju'];
    protected $useTimestamps    = true;

    public function getJadwalUjian()
    {
        return $this->join('kelas', 'jadwal_ujian.id_kelas=kelas.id_kelas')->join('ruang_ujian', 'jadwal_ujian.id_ruang_ujian=ruang_ujian.id_ruang_ujian')->join('matkul', 'kelas.id_matkul=matkul.id_matkul')->join('dosen', 'kelas.id_dosen=dosen.id_dosen')->join('prodi', 'matkul.id_prodi=prodi.id_prodi')->findAll();
    }
}
