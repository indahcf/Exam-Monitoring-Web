<?php

namespace App\Controllers;

use App\Models\DosenModel;
use App\Models\KelasModel;
use App\Models\ProdiModel;
use App\Models\RuangUjianModel;
use App\Models\JadwalUjianModel;
use App\Models\TahunAkademikModel;

class JadwalUjian extends BaseController
{
    protected $jadwal_ujianModel;
    protected $prodiModel;
    protected $kelasModel;
    protected $dosenModel;
    protected $ruang_ujianModel;
    protected $tahun_akademikModel;
    public function __construct()
    {
        $this->jadwal_ujianModel = new JadwalUjianModel();
        $this->prodiModel = new ProdiModel();
        $this->kelasModel = new KelasModel();
        $this->dosenModel = new DosenModel();
        $this->ruang_ujianModel = new RuangUjianModel();
        $this->tahun_akademikModel = new TahunAkademikModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Jadwal Ujian',
            'jadwal_ujian' => $this->jadwal_ujianModel->getJadwalUjian()
        ];

        return view('admin/jadwal_ujian/index', $data);
    }

    public function create()
    {
        $data = [
            'title'         => 'Tambah Jadwal Ujian',
            'prodi'         => $this->prodiModel->getProdi(),
            'ruang_ujian'   => $this->ruang_ujianModel->getRuangUjian(),
            'tahun_akademik'   => $this->tahun_akademikModel->getTahunAkademik()
        ];

        return view('admin/jadwal_ujian/create', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'prodi' => [
                'rules' => 'required',
                'label' => 'Program Studi',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'kelas' => [
                'rules' => 'required',
                'label' => 'Kelas',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'ruang_ujian' => [
                'rules' => 'required',
                'label' => 'Ruang Ujian',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'tahun_akademik' => [
                'rules' => 'required',
                'label' => 'Tahun Akademik',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'jumlah_peserta' => [
                'rules' => 'required',
                'label' => 'Jumlah Peserta',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'tanggal' => [
                'rules' => 'required',
                'label' => 'Tanggal',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'jam_mulai' => [
                'rules' => 'required',
                'label' => 'Jam Mulai',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'jam_selesai' => [
                'rules' => 'required',
                'label' => 'Jam Selesai',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        }

        //cek validasi
        // if ($this->kelasModel->where([
        //     'id_prodi' => $this->request->getVar('prodi'),
        //     'id_matkul' => $this->request->getVar('matkul'),
        //     'id_dosen' => $this->request->getVar('dosen'),
        //     'kelas' => $this->request->getVar('kelas')
        // ])->first()) {
        //     return redirect()->back()->with('error', 'Data sudah terdaftar.')->withInput();
        // }

        // dd([
        //     'id_prodi' => $this->request->getVar('prodi'),
        //     'id_kelas' => $this->request->getVar('kelas'),
        //     'id_ruang_ujian' => $this->request->getVar('ruang_ujian'),
        //     'jumlah_peserta' => $this->request->getVar('jumlah_peserta'),
        //     'tanggal' => $this->request->getVar('tanggal'),
        //     'jam_mulai' => $this->request->getVar('jam_mulai'),
        //     'jam_selesai' => $this->request->getVar('jam_selesai')
        // ]);

        try {
            $this->kelasModel->save([
                'id_prodi' => $this->request->getVar('prodi'),
                'id_kelas' => $this->request->getVar('kelas'),
                'id_ruang_ujian' => $this->request->getVar('ruang_ujian'),
                'id_tahun_akademik' => $this->request->getVar('tahun_akademik'),
                'jumlah_peserta' => $this->request->getVar('jumlah_peserta'),
                'tanggal' => $this->request->getVar('tanggal'),
                'jam_mulai' => $this->request->getVar('jam_mulai'),
                'jam_selesai' => $this->request->getVar('jam_selesai')
            ]);
            session()->setFlashdata('success', 'Data Berhasil Ditambahkan');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Data Gagal Ditambahkan');
        }

        return redirect()->to('/admin/jadwal_ujian');
    }

    public function delete($id_jadwal_ujian)
    {
        try {
            $this->jadwal_ujianModel->delete($id_jadwal_ujian);
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Data Berhasil Dihapus',
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Data Gagal Dihapus',
            ]);
        }
    }

    public function edit($id_jadwal_ujian)
    {
        $id_dosen = $this->jadwal_ujianModel->find($id_jadwal_ujian)['id_dosen'];
        $data = [
            'title' => 'Edit Jadwal Ujian',
            'jadwal_ujian' => $this->jadwal_ujianModel->find($id_jadwal_ujian),
            'prodi' => $this->prodiModel->findAll(),
            'ruang_ujian' => $this->ruang_ujianModel->findAll(),
            'kelas' => $this->dosenModel->find($id_dosen)['id_prodi']
        ];

        return view('admin/jadwal_ujian/edit', $data);
    }

    public function update($id_jadwal_ujian)
    {
        if (!$this->validate([
            'prodi' => [
                'rules' => 'required',
                'label' => 'Program Studi',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'kelas' => [
                'rules' => 'required',
                'label' => 'Kelas',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'ruang_ujian' => [
                'rules' => 'required',
                'label' => 'Ruang Ujian',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'jumlah_peserta' => [
                'rules' => 'required',
                'label' => 'Jumlah Peserta',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'waktu_ujian' => [
                'rules' => 'required',
                'label' => 'Waktu Ujian',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        }

        //cek validasi
        // if ($this->kelasModel->where([
        //     'id_prodi' => $this->request->getVar('prodi'),
        //     'id_matkul' => $this->request->getVar('matkul'),
        //     'id_dosen' => $this->request->getVar('dosen'),
        //     'kelas' => $this->request->getVar('kelas'),
        //     'id_kelas !=' => $id_kelas
        // ])->first()) {
        //     return redirect()->back()->with('error', 'Data sudah terdaftar.')->withInput();
        // }

        try {
            $this->jadwal_ujianModel->save([
                'id_jadwal_ujian' => $id_jadwal_ujian,
                'id_prodi' => $this->request->getVar('prodi'),
                'id_kelas' => $this->request->getVar('kelas'),
                'id_ruang_ujian' => $this->request->getVar('ruang_ujian'),
                'jumlah_peserta' => $this->request->getVar('jumlah_peserta'),
                'tanggal' => $this->request->getVar('tanggal'),
                'jam_mulai' => $this->request->getVar('jam_mulai'),
                'jam_selesai' => $this->request->getVar('jam_selesai')
            ]);
            session()->setFlashdata('success', 'Data Berhasil Diubah');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Data Gagal Diubah');
        }

        return redirect()->to('/admin/jadwal_ujian');
    }

    public function kelas($id_prodi)
    {
        $kelas = $this->kelasModel->allKelas($id_prodi);
        return $this->response->setJSON($kelas);
    }

    public function dosen($id_kelas)
    {
        $dosen = $this->jadwal_ujianModel->allDosen($id_kelas);
        return $this->response->setJSON($dosen);
    }
}
