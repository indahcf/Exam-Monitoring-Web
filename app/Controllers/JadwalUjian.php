<?php

namespace App\Controllers;

use App\Models\KelasModel;
use App\Models\ProdiModel;
use App\Models\MatkulModel;
use App\Models\RuangUjianModel;
use App\Models\JadwalRuangModel;
use App\Models\JadwalUjianModel;
use App\Models\TahunAkademikModel;

class JadwalUjian extends BaseController
{
    protected $jadwal_ruangModel;
    protected $jadwal_ujianModel;
    protected $prodiModel;
    protected $kelasModel;
    protected $tahun_akademikModel;
    protected $ruang_ujianModel;
    protected $matkulModel;

    public function __construct()
    {
        $this->jadwal_ruangModel = new JadwalRuangModel();
        $this->jadwal_ujianModel = new JadwalUjianModel();
        $this->prodiModel = new ProdiModel();
        $this->kelasModel = new KelasModel();
        $this->ruang_ujianModel = new RuangUjianModel();
        $this->tahun_akademikModel = new TahunAkademikModel();
        $this->matkulModel = new MatkulModel();
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
        // dd($this->tahun_akademikModel->where('status', true)->first()['id_tahun_akademik']);
        $data = [
            'title'          => 'Tambah Jadwal Ujian',
            'prodi'          => $this->prodiModel->findAll(),
            'ruang_ujian'    => $this->ruang_ujianModel->findAll(),
            'tahun_akademik' => $this->tahun_akademikModel->findAll(),
            'kelas'          => $this->kelasModel->findAll()
        ];

        return view('admin/jadwal_ujian/create', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'kelas' => [
                'rules' => 'required',
                'label' => 'Kelas',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'ruang_ujian.*' => [
                'rules' => 'required',
                'label' => 'Ruang Ujian',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'jumlah_peserta.*' => [
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

        try {
            $this->jadwal_ujianModel->save([
                'id_kelas' => $this->request->getVar('kelas'),
                'id_tahun_akademik' => $this->tahun_akademikModel->getAktif()['id_tahun_akademik'],
                'tanggal' => $this->request->getVar('tanggal'),
                'jam_mulai' => $this->request->getVar('jam_mulai'),
                'jam_selesai' => $this->request->getVar('jam_selesai')
            ]);
            session()->setFlashdata('success', 'Data Berhasil Ditambahkan');
        } catch (\Exception $e) {
            // dd($e);
            session()->setFlashdata('error', $e->getMessage());
        }

        $id_jadwal_ujian = $this->jadwal_ujianModel->getInsertID();
        $ruang_ujian = $this->request->getVar('ruang_ujian');
        $jumlah_peserta = $this->request->getVar('jumlah_peserta');
        $jadwal_ruangan = [];
        foreach ($ruang_ujian as $i => $r) {
            $jadwal_ruangan[] = [
                'id_jadwal_ujian' => $id_jadwal_ujian,
                'id_ruang_ujian' => $r,
                'jumlah_peserta' => $jumlah_peserta[$i]
            ];
        }
        $this->jadwal_ruangModel->insertBatch($jadwal_ruangan);

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
        $jadwalUjian = $this->jadwal_ujianModel->find($id_jadwal_ujian);
        $id_kelas = $this->jadwal_ujianModel->find($id_jadwal_ujian)['id_kelas'];
        $id_matkul = $this->kelasModel->find($id_kelas)['id_matkul'];
        $data = [
            'title' => 'Edit Jadwal Ujian',
            'jadwal_ujian' => $jadwalUjian,
            'prodi' => $this->prodiModel->findAll(),
            'kelas' => $this->kelasModel->find($jadwalUjian['id_kelas']),
            'ruang_ujian' => $this->ruang_ujianModel->findAll(),
            'tahun_akademik_aktif' => $this->tahun_akademikModel->find($jadwalUjian['id_tahun_akademik']),
            'prodi_kelas' => $this->matkulModel->find($id_matkul)['id_prodi']
        ];
        return view('admin/jadwal_ujian/edit', $data);
    }

    public function update($id_jadwal_ujian)
    {
        if (!$this->validate([
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

        try {
            $this->jadwal_ujianModel->save([
                'id_jadwal_ujian' => $id_jadwal_ujian,
                'id_kelas' => $this->request->getVar('kelas'),
                'id_ruang_ujian' => $this->request->getVar('ruang_ujian'),
                'jumlah_peserta' => $this->request->getVar('jumlah_peserta'),
                'tanggal' => $this->request->getVar('tanggal'),
                'jam_mulai' => $this->request->getVar('jam_mulai'),
                'jam_selesai' => $this->request->getVar('jam_selesai')
            ]);
            session()->setFlashdata('success', 'Data Berhasil Diubah');
        } catch (\Exception $e) {
            session()->setFlashdata('error', $e->getMessage());
        }

        return redirect()->to('/admin/jadwal_ujian');
    }
}
