<?php

namespace App\Models;

use CodeIgniter\Model;

class SoalUjianModel extends Model
{
    protected $table            = 'soal_ujian';
    protected $primaryKey       = 'id_soal_ujian';
    protected $allowedFields    = ['id_kelas', 'id_tahun_akademik', 'soal_ujian', 'periode_ujian', 'bentuk_soal', 'metode', 'status'];
    protected $useTimestamps    = true;

    public function getSoalUjian()
    {
        return $this->join('kelas', 'soal_ujian.id_kelas=kelas.id_kelas')->join('matkul', 'kelas.id_matkul=matkul.id_matkul')->join('dosen', 'kelas.id_dosen=dosen.id_dosen')->join('prodi', 'matkul.id_prodi=prodi.id_prodi')->findAll();
    }
}
