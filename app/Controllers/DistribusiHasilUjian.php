<?php

namespace App\Controllers;

use App\Models\JadwalUjianModel;
use App\Models\JadwalRuangModel;
use App\Models\TahunAkademikModel;
use CodeIgniter\Database\Exceptions\DatabaseException;

class DistribusiHasilUjian extends BaseController
{
    protected $tahun_akademikModel;
    protected $jadwal_ujianModel;
    protected $jadwal_ruangModel;
    protected $db;

    public function __construct()
    {
        $this->tahun_akademikModel = new TahunAkademikModel();
        $this->jadwal_ujianModel = new JadwalUjianModel();
        $this->jadwal_ruangModel = new JadwalRuangModel();
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

    public function update_status($id)
    {
        // Mendapatkan status distribusi sebelum diupdate
        $oldStatus = $this->db->table('jadwal_ruang')
            ->where('id_jadwal_ruang', $id)
            ->get()
            ->getRow('status_distribusi');

        // Cek apakah status distribusi adalah "belum"
        if ($oldStatus === 'Belum') {
            // Jika status distribusi adalah "belum", ubah menjadi "sudah"
            $newStatus = 'Sudah';
        } else {
            // Jika status distribusi adalah "sudah", ubah menjadi "belum"
            $newStatus = 'Belum';
        }

        try {
            $this->db->table('jadwal_ruang')
                ->where('id_jadwal_ruang', $id)
                ->update(['status_distribusi' => $newStatus]);
            return $this->response->setJson(['success' => true, 'message' => 'Status Berhasil Diubah!']);
        } catch (\Exception $e) {
            return $this->response->setJson(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
