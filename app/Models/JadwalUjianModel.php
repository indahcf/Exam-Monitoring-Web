<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalUjianModel extends Model
{
    protected $table            = 'jadwal_ujian';
    protected $primaryKey       = 'id_jadwal_ujian';
    protected $allowedFields    = ['id_kelas', 'id_tahun_akademik', 'periode_ujian', 'tanggal', 'jam_mulai', 'jam_selesai', 'total_hadir', 'jumlah_lju'];
    protected $useTimestamps    = true;

    public function getJadwalUjian()
    {
        return $this->db->table('jadwal_ruang')->join('jadwal_ujian', 'jadwal_ujian.id_jadwal_ujian=jadwal_ruang.id_jadwal_ujian', 'right')->join('ruang_ujian', 'jadwal_ruang.id_ruang_ujian=ruang_ujian.id_ruang_ujian', 'left')->join('kelas', 'jadwal_ujian.id_kelas=kelas.id_kelas')->join('matkul', 'kelas.id_matkul=matkul.id_matkul')->join('dosen', 'kelas.id_dosen=dosen.id_dosen')->join('prodi', 'matkul.id_prodi=prodi.id_prodi')->get()->getResultArray();
    }

    public function filterTahunAkademik($id_tahun_akademik, $periode_ujian)
    {
        // dd($id_tahun_akademik);
        return $this->db->table('jadwal_ruang')->join('jadwal_ujian', 'jadwal_ujian.id_jadwal_ujian=jadwal_ruang.id_jadwal_ujian', 'right')->join('ruang_ujian', 'jadwal_ruang.id_ruang_ujian=ruang_ujian.id_ruang_ujian', 'left')->join('kelas', 'jadwal_ujian.id_kelas=kelas.id_kelas')->join('matkul', 'kelas.id_matkul=matkul.id_matkul')->join('dosen', 'kelas.id_dosen=dosen.id_dosen')->join('prodi', 'matkul.id_prodi=prodi.id_prodi')->where('id_tahun_akademik = "' . $id_tahun_akademik . '" AND periode_ujian = "' . $periode_ujian . '"')->get()->getResultArray();
    }
}
