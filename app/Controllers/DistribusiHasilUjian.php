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
        if (count(array_intersect(user()->roles, ['Admin', 'Pendistribusi Hasil Ujian'])) > 0) {
            $tahun_akademik = $this->tahun_akademikModel->findAll();
            if (count($tahun_akademik) > 0 && $this->tahun_akademikModel->getAktif()) {
                $tahun_akademik_aktif = $this->tahun_akademikModel->getAktif()['id_tahun_akademik'];

                $filter = $this->request->getVar('filter');
                $distribusi_hasil_ujian = [];
                if ($distribusi_hasil_ujian != '') {
                    $filter = $this->request->getVar('filter') ?: $tahun_akademik_aktif;
                    // dd($filter);
                    $id_tahun_akademik = $filter;
                    $distribusi_hasil_ujian = $this->jadwal_ruangModel->filterJadwalRuang($id_tahun_akademik);
                }

                $data = [
                    'title' => 'Data Distribusi Hasil Ujian',
                    'distribusi_hasil_ujian' => $distribusi_hasil_ujian,
                    'tahun_akademik' => $this->tahun_akademikModel->findAll(),
                    'filter' => $filter
                ];

                return view('admin/distribusi_hasil_ujian/index', $data);
            } else {
                $data = [
                    'title' => 'Data Distribusi Hasil Ujian'
                ];
                return view('admin/pesan/index', $data);
            }
        } else if (count(array_intersect(user()->roles, ['Dosen'])) > 0) {
            $tahun_akademik = $this->tahun_akademikModel->findAll();
            if (count($tahun_akademik) > 0 && $this->tahun_akademikModel->getAktif()) {
                $tahun_akademik_aktif = $this->tahun_akademikModel->getAktif()['id_tahun_akademik'];

                $filter = $this->request->getVar('filter');
                $distribusi_hasil_ujian = [];
                if ($distribusi_hasil_ujian != '') {
                    $filter = $this->request->getVar('filter') ?: $tahun_akademik_aktif;
                    // dd($filter);
                    $id_tahun_akademik = $filter;
                    $distribusi_hasil_ujian = $this->jadwal_ruangModel->filterJadwalRuangDosen($id_tahun_akademik);
                }

                $data = [
                    'title' => 'Data Distribusi Hasil Ujian',
                    'distribusi_hasil_ujian' => $distribusi_hasil_ujian
                ];

                return view('admin/distribusi_hasil_ujian/index', $data);
            } else {
                $data = [
                    'title' => 'Data Distribusi Hasil Ujian'
                ];
                return view('admin/pesan/index', $data);
            }
        }
    }

    public function edit($id_jadwal_ruang)
    {
        $distribusi_hasil_ujian = $this->jadwal_ruangModel->join('jadwal_ujian', 'jadwal_ujian.id_jadwal_ujian=jadwal_ruang.id_jadwal_ujian')->join('ruang_ujian', 'ruang_ujian.id_ruang_ujian=jadwal_ruang.id_ruang_ujian')->find($id_jadwal_ruang);
        $kelas = $this->kelasModel->join('matkul', 'kelas.id_matkul=matkul.id_matkul')->join('prodi', 'matkul.id_prodi=prodi.id_prodi')->join('dosen', 'dosen.id_dosen=kelas.id_dosen')->join('jadwal_ujian', 'jadwal_ujian.id_kelas=kelas.id_kelas')->join('jadwal_ruang', 'jadwal_ruang.id_jadwal_ujian=jadwal_ujian.id_jadwal_ujian')->where('jadwal_ruang.id_jadwal_ruang =', $id_jadwal_ruang)->findAll();
        // dd($kelas);
        $data = [
            'title' => 'Edit Data Distribusi Hasil Ujian',
            'distribusi_hasil_ujian' => $distribusi_hasil_ujian,
            'prodi' => $kelas[0]['prodi'],
            'kode_matkul' => $kelas[0]['kode_matkul'],
            'matkul' => $kelas[0]['matkul'],
            'kelas' => $kelas[0]['kelas'],
            'dosen' => $kelas[0]['dosen']
        ];
        return view('admin/distribusi_hasil_ujian/edit', $data);
    }

    public function update($id_jadwal_ruang)
    {
        if (!$this->validate([
            'status_distribusi' => [
                'rules' => 'required',
                'label' => 'Status',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'penerima' => [
                'rules' => 'required',
                'label' => 'Penerima',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        }

        try {
            $this->db->table('jadwal_ruang')->where('id_jadwal_ruang', $id_jadwal_ruang)->update([
                'status_distribusi' => $this->request->getVar('status_distribusi'),
                'penerima' => $this->request->getVar('penerima')
            ]);
            session()->setFlashdata('success', 'Data Berhasil Diubah');
        } catch (\Exception $e) {
            session()->setFlashdata('error', $e->getMessage());
        }

        return redirect()->to('/admin/distribusi_hasil_ujian');
    }

    public function detail($id_jadwal_ruang)
    {
        $distribusi_hasil_ujian = $this->jadwal_ruangModel->join('jadwal_ujian', 'jadwal_ujian.id_jadwal_ujian=jadwal_ruang.id_jadwal_ujian')->join('ruang_ujian', 'ruang_ujian.id_ruang_ujian=jadwal_ruang.id_ruang_ujian')->find($id_jadwal_ruang);
        $kelas = $this->kelasModel->join('matkul', 'kelas.id_matkul=matkul.id_matkul')->join('prodi', 'matkul.id_prodi=prodi.id_prodi')->join('dosen', 'dosen.id_dosen=kelas.id_dosen')->join('jadwal_ujian', 'jadwal_ujian.id_kelas=kelas.id_kelas')->join('jadwal_ruang', 'jadwal_ruang.id_jadwal_ujian=jadwal_ujian.id_jadwal_ujian')->where('jadwal_ruang.id_jadwal_ruang =', $id_jadwal_ruang)->findAll();
        // dd($kelas);
        $data = [
            'title' => 'Detail Data Distribusi Hasil Ujian',
            'distribusi_hasil_ujian' => $distribusi_hasil_ujian,
            'prodi' => $kelas[0]['prodi'],
            'kode_matkul' => $kelas[0]['kode_matkul'],
            'matkul' => $kelas[0]['matkul'],
            'kelas' => $kelas[0]['kelas'],
            'dosen' => $kelas[0]['dosen']
        ];
        return view('admin/distribusi_hasil_ujian/detail', $data);
    }

    public function update_status_diterima($id_jadwal_ruang)
    {
        if (!$this->validate([
            'status_distribusi' => [
                'rules' => 'required',
                'label' => 'Status',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        }

        try {
            $this->db->table('jadwal_ruang')->where('id_jadwal_ruang', $id_jadwal_ruang)->update([
                'status_distribusi' => $this->request->getVar('status_distribusi')
            ]);
            session()->setFlashdata('success', 'Data Berhasil Diubah');
        } catch (\Exception $e) {
            session()->setFlashdata('error', $e->getMessage());
        }

        return redirect()->to('/admin/distribusi_hasil_ujian');
    }
}
