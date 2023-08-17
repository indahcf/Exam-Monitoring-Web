<?php

namespace App\Models;

use CodeIgniter\Model;

class SoalUjianModel extends Model
{
    protected $table            = 'soal_ujian';
    protected $primaryKey       = 'id_soal_ujian';
    protected $allowedFields    = ['id_tahun_akademik', 'id_dosen', 'soal_ujian', 'periode_ujian', 'bentuk_soal', 'metode', 'status_soal', 'durasi_pengerjaan', 'sifat_ujian', 'petunjuk', 'sub_cpmk', 'durasi_sks', 'pertanyaan', 'skor', 'gambar', 'catatan', 'saran'];
    protected $useTimestamps    = true;

    public function filterSoalUjian($id_tahun_akademik, $periode_ujian)
    {
        return $this->join('soal_kelas', 'soal_ujian.id_soal_ujian=soal_kelas.id_soal_ujian')
            ->join('kelas', 'soal_kelas.id_kelas=kelas.id_kelas')
            ->join('matkul', 'kelas.id_matkul=matkul.id_matkul')
            ->join('dosen', 'soal_ujian.id_dosen=dosen.id_dosen')
            ->join('prodi', 'matkul.id_prodi=prodi.id_prodi')
            ->join('tahun_akademik', 'soal_ujian.id_tahun_akademik=tahun_akademik.id_tahun_akademik')
            ->where('soal_ujian.id_tahun_akademik', $id_tahun_akademik)
            ->where('periode_ujian', $periode_ujian)
            ->findAll();
    }

    public function filterSoalUjianWithStatus($id_tahun_akademik, $periode_ujian)
    {
        return $this->join('soal_kelas', 'soal_ujian.id_soal_ujian=soal_kelas.id_soal_ujian')
            ->join('kelas', 'soal_kelas.id_kelas=kelas.id_kelas')
            ->join('matkul', 'kelas.id_matkul=matkul.id_matkul')
            ->join('dosen', 'soal_ujian.id_dosen=dosen.id_dosen')
            ->join('prodi', 'matkul.id_prodi=prodi.id_prodi')
            ->join('tahun_akademik', 'soal_ujian.id_tahun_akademik=tahun_akademik.id_tahun_akademik')
            ->where('soal_ujian.id_tahun_akademik', $id_tahun_akademik)
            ->where('periode_ujian', $periode_ujian)
            ->whereIn('status_soal', ['Diterima', 'Dicetak']) // Use whereIn for multiple status values
            ->findAll();
    }

    public function filterSoalUjianDosen()
    {
        $id_users = user_id();
        $id_dosen = $this->join('dosen', 'dosen.id_dosen=soal_ujian.id_dosen')->join('users', 'users.id=dosen.id_user')->where('id', $id_users)->Get()->getRow()->id_dosen;
        return $this->join('soal_kelas', 'soal_ujian.id_soal_ujian=soal_kelas.id_soal_ujian')
            ->join('kelas', 'soal_kelas.id_kelas=kelas.id_kelas')
            ->join('matkul', 'kelas.id_matkul=matkul.id_matkul')
            ->join('dosen', 'soal_ujian.id_dosen=dosen.id_dosen')
            ->join('prodi', 'matkul.id_prodi=prodi.id_prodi')
            ->join('tahun_akademik', 'soal_ujian.id_tahun_akademik=tahun_akademik.id_tahun_akademik')
            // ->where('soal_ujian.id_tahun_akademik', $id_tahun_akademik)
            // ->where('periode_ujian', $periode_ujian)
            ->where('soal_ujian.id_dosen', $id_dosen)
            ->findAll();
    }

    // public function filterSoalUjianDosen()
    // {
    //     $id_users = user_id();
    //     $queryResult = $this->join('dosen', 'dosen.id_dosen=soal_ujian.id_dosen')->join('users', 'users.id=dosen.id_user')->where('id', $id_users)->Get()->getRow();
    //     if ($queryResult) {
    //         $id_dosen = $queryResult->id_dosen;
    //         return $this->join('soal_kelas', 'soal_ujian.id_soal_ujian=soal_kelas.id_soal_ujian')
    //             ->join('kelas', 'soal_kelas.id_kelas=kelas.id_kelas')
    //             ->join('matkul', 'kelas.id_matkul=matkul.id_matkul')
    //             ->join('dosen', 'soal_ujian.id_dosen=dosen.id_dosen')
    //             ->join('prodi', 'matkul.id_prodi=prodi.id_prodi')
    //             ->join('tahun_akademik', 'soal_ujian.id_tahun_akademik=tahun_akademik.id_tahun_akademik')
    //             // ->where('soal_ujian.id_tahun_akademik', $id_tahun_akademik)
    //             // ->where('periode_ujian', $periode_ujian)
    //             ->where('soal_ujian.id_dosen', $id_dosen)
    //             ->findAll();
    //     }
    // }
}
