<?php

namespace App\Models;

use CodeIgniter\Model;

class KehadiranPesertaModel extends Model
{
    protected $table            = 'kehadiran_peserta';
    protected $primaryKey       = 'id_kehadiran_peserta';
    protected $allowedFields    = ['id_jadwal_ruang', 'total_hadir', 'sakit', 'nim_sakit', 'izin', 'nim_izin', 'tanpa_ket', 'nim_tanpa_ket', 'tidak_memenuhi_syarat', 'nim_tidak_memenuhi_syarat', 'presensi_kurang', 'nim_presensi_kurang', 'jumlah_lju'];
    protected $useTimestamps    = true;

    public function filterKehadiranPeserta($id_tahun_akademik)
    {
        // dd($id_tahun_akademik);
        return $this->db->table('jadwal_ruang')
            ->select('jadwal_ruang.id_jadwal_ruang as id_ruang_peserta, jadwal_ruang.jumlah_peserta, jadwal_ujian.*, ruang_ujian.*, kelas.*, matkul.*, dosen.*, prodi.*, tahun_akademik.*, pengawas1.pengawas as nama_pengawas1, pengawas2.pengawas as nama_pengawas2, kehadiran_peserta.*, kejadian.*')
            ->join('jadwal_ujian', 'jadwal_ujian.id_jadwal_ujian=jadwal_ruang.id_jadwal_ujian')
            ->join('tahun_akademik', 'jadwal_ujian.id_tahun_akademik=tahun_akademik.id_tahun_akademik')
            ->join('ruang_ujian', 'jadwal_ruang.id_ruang_ujian=ruang_ujian.id_ruang_ujian')
            ->join('kelas', 'jadwal_ujian.id_kelas=kelas.id_kelas')
            ->join('matkul', 'kelas.id_matkul=matkul.id_matkul')
            ->join('dosen', 'kelas.id_dosen=dosen.id_dosen')
            ->join('prodi', 'matkul.id_prodi=prodi.id_prodi')
            ->join('kehadiran_peserta', 'jadwal_ruang.id_jadwal_ruang=kehadiran_peserta.id_jadwal_ruang', 'left')
            ->join('kehadiran_pengawas', 'jadwal_ruang.id_jadwal_ruang=kehadiran_pengawas.id_jadwal_ruang', 'left')
            ->join('pengawas as pengawas1', 'pengawas1.id_pengawas=kehadiran_pengawas.pengawas_1', 'left')
            ->join('pengawas as pengawas2', 'pengawas2.id_pengawas=kehadiran_pengawas.pengawas_2', 'left')
            ->join('kejadian', 'jadwal_ruang.id_jadwal_ruang=kejadian.id_jadwal_ruang', 'left')
            ->where('jadwal_ujian.id_tahun_akademik', $id_tahun_akademik)
            ->orderBy('jadwal_ujian.id_jadwal_ujian', 'ASC')
            ->orderBy('nim', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function filterKehadiranPesertaPengawas($id_tahun_akademik)
    {
        $id_users = user_id();

        if (count(array_intersect(user()->roles, ['Pengawas'])) > 0) {
            $id_pengawas = $this->db->table('pengawas')->join('users', 'users.id=pengawas.id_user')->where('id', $id_users)->Get()->getRow()->id_pengawas;
            return $this->db->table('jadwal_ruang')
                ->select('jadwal_ruang.id_jadwal_ruang as id_ruang_peserta, jadwal_ruang.jumlah_peserta, jadwal_ujian.*, ruang_ujian.*, kelas.*, matkul.*, dosen.*, prodi.*, tahun_akademik.*, pengawas1.pengawas as nama_pengawas1, pengawas2.pengawas as nama_pengawas2, kehadiran_peserta.*, kejadian.*')
                ->join('jadwal_ujian', 'jadwal_ujian.id_jadwal_ujian=jadwal_ruang.id_jadwal_ujian')
                ->join('tahun_akademik', 'jadwal_ujian.id_tahun_akademik=tahun_akademik.id_tahun_akademik')
                ->join('ruang_ujian', 'jadwal_ruang.id_ruang_ujian=ruang_ujian.id_ruang_ujian')
                ->join('kelas', 'jadwal_ujian.id_kelas=kelas.id_kelas')
                ->join('matkul', 'kelas.id_matkul=matkul.id_matkul')
                ->join('dosen', 'kelas.id_dosen=dosen.id_dosen')
                ->join('prodi', 'matkul.id_prodi=prodi.id_prodi')
                ->join('kehadiran_peserta', 'jadwal_ruang.id_jadwal_ruang=kehadiran_peserta.id_jadwal_ruang', 'left')
                ->join('kehadiran_pengawas', 'jadwal_ruang.id_jadwal_ruang=kehadiran_pengawas.id_jadwal_ruang', 'left')
                ->join('pengawas as pengawas1', 'pengawas1.id_pengawas=kehadiran_pengawas.pengawas_1', 'left')
                ->join('pengawas as pengawas2', 'pengawas2.id_pengawas=kehadiran_pengawas.pengawas_2', 'left')
                ->join('kejadian', 'jadwal_ruang.id_jadwal_ruang=kejadian.id_jadwal_ruang', 'left')
                ->where('jadwal_ujian.id_tahun_akademik', $id_tahun_akademik)
                ->where('kehadiran_pengawas.pengawas_1', $id_pengawas)
                ->orWhere('kehadiran_pengawas.pengawas_2', $id_pengawas)
                ->orderBy('jadwal_ujian.id_jadwal_ujian', 'ASC')
                ->orderBy('nim', 'ASC')
                ->get()
                ->getResultArray();
        } else if (count(array_intersect(user()->roles, ['Koordinator'])) > 0) {
            $id_koordinator = $this->db->table('dosen')->join('users', 'users.id=dosen.id_user')->where('id', $id_users)->Get()->getRow()->id_dosen;
            return $this->db->table('jadwal_ruang')
                ->select('jadwal_ruang.id_jadwal_ruang as id_ruang_peserta, jadwal_ruang.jumlah_peserta, jadwal_ujian.*, ruang_ujian.*, kelas.*, matkul.*, dosen.*, prodi.*, tahun_akademik.*, pengawas1.pengawas as nama_pengawas1, pengawas2.pengawas as nama_pengawas2, kehadiran_peserta.*, kejadian.*')
                ->join('jadwal_ujian', 'jadwal_ujian.id_jadwal_ujian=jadwal_ruang.id_jadwal_ujian')
                ->join('tahun_akademik', 'jadwal_ujian.id_tahun_akademik=tahun_akademik.id_tahun_akademik')
                ->join('ruang_ujian', 'jadwal_ruang.id_ruang_ujian=ruang_ujian.id_ruang_ujian')
                ->join('kelas', 'jadwal_ujian.id_kelas=kelas.id_kelas')
                ->join('matkul', 'kelas.id_matkul=matkul.id_matkul')
                ->join('dosen', 'kelas.id_dosen=dosen.id_dosen')
                ->join('prodi', 'matkul.id_prodi=prodi.id_prodi')
                ->join('kehadiran_peserta', 'jadwal_ruang.id_jadwal_ruang=kehadiran_peserta.id_jadwal_ruang', 'left')
                ->join('kehadiran_pengawas', 'jadwal_ruang.id_jadwal_ruang=kehadiran_pengawas.id_jadwal_ruang', 'left')
                ->join('pengawas as pengawas1', 'pengawas1.id_pengawas=kehadiran_pengawas.pengawas_1', 'left')
                ->join('pengawas as pengawas2', 'pengawas2.id_pengawas=kehadiran_pengawas.pengawas_2', 'left')
                ->join('kejadian', 'jadwal_ruang.id_jadwal_ruang=kejadian.id_jadwal_ruang', 'left')
                ->where('jadwal_ujian.id_tahun_akademik', $id_tahun_akademik)
                ->where('jadwal_ujian.koordinator_ujian', $id_koordinator)
                ->orderBy('jadwal_ujian.id_jadwal_ujian', 'ASC')
                ->orderBy('nim', 'ASC')
                ->get()
                ->getResultArray();
        }
    }
}
