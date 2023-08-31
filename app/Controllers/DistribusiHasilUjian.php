<?php

namespace App\Controllers;

use App\Models\JadwalUjianModel;
use App\Models\JadwalRuangModel;
use App\Models\TahunAkademikModel;
use App\Models\KelasModel;
use CodeIgniter\Database\Exceptions\DatabaseException;

class DistribusiHasilUjian extends BaseController
{
    protected $tahun_akademikModel;
    protected $jadwal_ujianModel;
    protected $jadwal_ruangModel;
    protected $kelasModel;
    protected $db;

    public function __construct()
    {
        $this->tahun_akademikModel = new TahunAkademikModel();
        $this->jadwal_ujianModel = new JadwalUjianModel();
        $this->jadwal_ruangModel = new JadwalRuangModel();
        $this->kelasModel = new KelasModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $tahun_akademik_aktif = $this->tahun_akademikModel->getAktif()['id_tahun_akademik'];
        $distribusi_hasil_ujian_terakhir = $this->jadwal_ujianModel->orderBy('tanggal', 'DESC')->findAll();

        $filter = $this->request->getVar('filter');
        $distribusi_hasil_ujian = [];
        if ($distribusi_hasil_ujian_terakhir) {
            $periode_ujian_aktif = $distribusi_hasil_ujian_terakhir[0]['periode_ujian'];
            $filter = $this->request->getVar('filter') ?: $tahun_akademik_aktif . "_" . $periode_ujian_aktif;
            // dd($filter);
            $id_tahun_akademik = explode("_", $filter)[0];
            $periode_ujian = explode("_", $filter)[1];
            $distribusi_hasil_ujian = $this->jadwal_ruangModel->filterJadwalRuang($id_tahun_akademik, $periode_ujian);
        }

        $data = [
            'title' => 'Data Distribusi Hasil Ujian',
            'distribusi_hasil_ujian' => $distribusi_hasil_ujian,
            'tahun_akademik' => $this->tahun_akademikModel->findAll(),
            'filter' => $filter
        ];
        // dd($data['distribusi_hasil_ujian']);
        return view('admin/distribusi_hasil_ujian/index', $data);
    }

    public function edit($id_jadwal_ruang)
    {
        $distribusi_hasil_ujian = $this->jadwal_ruangModel->join('jadwal_ujian', 'jadwal_ujian.id_jadwal_ujian=jadwal_ruang.id_jadwal_ujian')->join('ruang_ujian', 'ruang_ujian.id_ruang_ujian=jadwal_ruang.id_ruang_ujian')->find($id_jadwal_ruang);
        // $kelas = $this->kelasModel->join('matkul', 'kelas.id_matkul=matkul.id_matkul')->join('prodi', 'matkul.id_prodi=prodi.id_prodi')->join('soal_kelas', 'soal_kelas.id_kelas=kelas.id_kelas')->where('soal_kelas.id_soal_ujian =', $id_soal_ujian)->findAll();
        $data = [
            'title' => 'Edit Data Distribusi Hasil Ujian',
            'distribusi_hasil_ujian' => $distribusi_hasil_ujian,
            // 'prodi' => $kelas[0]['prodi'],
            // 'kode_matkul' => $kelas[0]['kode_matkul'],
            // 'matkul' => $kelas[0]['matkul'],
            // 'kelas' => implode(", ", array_column($kelas, 'kelas'))
        ];
        return view('admin/distribusi_hasil_ujian/edit', $data);
    }
}
