<?php

namespace App\Controllers;

use App\Models\KehadiranPengawasModel;
use App\Models\TahunAkademikModel;
use App\Models\JadwalUjianModel;
use App\Models\RuangUjianModel;
use App\Models\JadwalRuangModel;
use App\Models\JadwalPengawasModel;
use App\Models\DosenModel;
use App\Models\PengawasModel;
use CodeIgniter\Database\Exceptions\DatabaseException;

class KehadiranPengawas extends BaseController
{
    protected $tahun_akademikModel;
    protected $kehadiran_pengawasModel;
    protected $jadwal_ujianModel;
    protected $ruang_ujianModel;
    protected $jadwal_ruangModel;
    protected $jadwal_pengawas_model;
    protected $dosenModel;
    protected $pengawasModel;
    protected $db;

    public function __construct()
    {
        $this->kehadiran_pengawasModel = new KehadiranPengawasModel();
        $this->tahun_akademikModel = new TahunAkademikModel();
        $this->jadwal_ujianModel = new JadwalUjianModel();
        $this->ruang_ujianModel = new RuangUjianModel();
        $this->jadwal_ruangModel = new JadwalRuangModel();
        $this->jadwal_pengawas_model = new JadwalPengawasModel();
        $this->dosenModel = new DosenModel();
        $this->pengawasModel = new PengawasModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $tahun_akademik_aktif = $this->tahun_akademikModel->getAktif()['id_tahun_akademik'];
        $kehadiran_pengawas_terakhir = $this->jadwal_ujianModel->orderBy('tanggal', 'DESC')->findAll();

        $filter = $this->request->getVar('filter');
        $kehadiran_pengawas = [];
        if ($kehadiran_pengawas_terakhir) {
            $periode_ujian_aktif = $kehadiran_pengawas_terakhir[0]['periode_ujian'];
            $filter = $this->request->getVar('filter') ?: $tahun_akademik_aktif . "_" . $periode_ujian_aktif;
            // dd($filter);
            $id_tahun_akademik = explode("_", $filter)[0];
            $periode_ujian = explode("_", $filter)[1];
            $kehadiran_pengawas = $this->kehadiran_pengawasModel->filterKehadiranPengawas($id_tahun_akademik, $periode_ujian);
        }

        $jadwal_pengawas = $this->jadwal_pengawas_model->join('pengawas', 'jadwal_pengawas.id_pengawas=pengawas.id_pengawas')->findAll();
        // Fungsi untuk mengelompokkan array berdasarkan kolom tertentu
        function groupBy($array, $key)
        {
            return array_reduce($array, function ($result, $item) use ($key) {
                $result[$item[$key]][] = $item;
                return $result;
            }, []);
        }

        // Mengelompokkan array berdasarkan kolom id_jadwal_ruang
        $groupedPengawas = groupBy($jadwal_pengawas, 'id_jadwal_ruang');

        $data = [
            'title' => 'Data Kehadiran Pengawas',
            'kehadiran_pengawas' => $kehadiran_pengawas,
            'tahun_akademik' => $this->tahun_akademikModel->findAll(),
            'filter' => $filter,
            'groupedPengawas' => $groupedPengawas
        ];
        // dd($groupedPengawas);

        return view('admin/kehadiran_pengawas/index', $data);
    }

    public function rekap($id_jadwal_ujian, $id_jadwal_ruang)
    {
        $jadwal_ujian = $this->jadwal_ujianModel
            ->select('jadwal_ujian.*, kelas.*, matkul.*, prodi.*, dosen.*, dosen_koordinator.dosen as nama_koordinator')
            ->join('kelas', 'jadwal_ujian.id_kelas=kelas.id_kelas')
            ->join('matkul', 'kelas.id_matkul=matkul.id_matkul')
            ->join('prodi', 'matkul.id_prodi=prodi.id_prodi')
            ->join('dosen', 'kelas.id_dosen=dosen.id_dosen')
            ->join('dosen as dosen_koordinator', 'jadwal_ujian.koordinator_ujian=dosen_koordinator.id_dosen')
            ->find($id_jadwal_ujian);

        $ruang_ujian = $this->ruang_ujianModel
            ->join('jadwal_ruang', 'jadwal_ruang.id_ruang_ujian=ruang_ujian.id_ruang_ujian')
            ->where('jadwal_ruang.id_jadwal_ruang =', $id_jadwal_ruang)
            ->findAll();

        $jumlah_peserta = $this->jadwal_ruangModel->where('id_jadwal_ruang', $id_jadwal_ruang)->findAll();

        $pengawas1 = $this->jadwal_pengawas_model->where('jadwal_pengawas.id_jadwal_ruang', $id_jadwal_ruang)->where('jadwal_pengawas.jenis_pengawas =', 'Pengawas 1')->get()->getRowArray()['id_pengawas'];

        $pengawas2 = $this->jadwal_pengawas_model->where('jadwal_pengawas.id_jadwal_ruang', $id_jadwal_ruang)->where('jadwal_pengawas.jenis_pengawas =', 'Pengawas 2')->get()->getRowArray();
        $pengawas2 = $pengawas2 ? $pengawas2['id_pengawas'] : '';
        // dd($pengawas2);

        $pengawas3 = $this->dosenModel->join('kelas', 'kelas.id_dosen=dosen.id_dosen')->join('jadwal_ujian', 'jadwal_ujian.id_kelas=kelas.id_kelas')->where('jadwal_ujian.id_jadwal_ujian =', $id_jadwal_ujian)->get()->getRowArray();
        // dd($pengawas3);

        $data = [
            'title' => 'Rekap Data Kehadiran Pengawas',
            'jadwal_ujian' => $jadwal_ujian,
            'ruang_ujian' => $ruang_ujian,
            'jumlah_peserta' => array_column($jumlah_peserta, 'jumlah_peserta'),
            'pengawas' => $this->pengawasModel->findAll(),
            'pengawas1' => $pengawas1,
            'pengawas2' => $pengawas2,
            'pengawas3' => $pengawas3,
            'id_jadwal_ujian' => $id_jadwal_ujian,
            'id_jadwal_ruang' => $id_jadwal_ruang
        ];
        return view('admin/kehadiran_pengawas/rekap', $data);
    }

    public function save()
    {
        // dd($this->request->getPost());
        if (!$this->validate([
            'pengawas1' => [
                'rules' => 'required',
                'label' => 'Pengawas 1',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'pengawas3' => [
                'rules' => 'required',
                'label' => 'Pengawas 3',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        }

        //validasi agar tidak ada pengawas yang sama dalam 1 jadwal ujian
        // $pengawas1 = $this->request->getVar('pengawas1');
        // $pengawas2 = $this->request->getVar('pengawas2');
        // if ($this->pengawas_is_duplicate($pengawas1, $pengawas2)) {
        //     return redirect()->back()->with('error', 'Pengawas yang Dipilih Ada yang Sama.')->withInput();
        // }

        try {
            if (!empty($this->request->getVar('pengawas2'))) {
                $this->kehadiran_pengawasModel->save([
                    'id_jadwal_ruang' => $this->request->getVar('id_jadwal_ruang'),
                    'pengawas_1' => $this->request->getVar('pengawas1'),
                    'pengawas_2' => $this->request->getVar('pengawas2'),
                    'pengawas_3' => $this->request->getVar('pengawas3')
                ]);
            } else {
                $this->kehadiran_pengawasModel->save([
                    'id_jadwal_ruang' => $this->request->getVar('id_jadwal_ruang'),
                    'pengawas_1' => $this->request->getVar('pengawas1'),
                    'pengawas_3' => $this->request->getVar('pengawas3')
                ]);
            }

            session()->setFlashdata('success', 'Data Berhasil Ditambahkan');
        } catch (DatabaseException $e) {
            session()->setFlashdata('error', $e->getMessage());
        }

        return redirect()->to('/admin/kehadiran_pengawas');
    }
}
