<?php

namespace App\Controllers;

use App\Models\KelasModel;
use App\Models\ProdiModel;
use App\Models\MatkulModel;
use App\Models\SoalUjianModel;
use App\Models\TahunAkademikModel;
use CodeIgniter\Database\Exceptions\DatabaseException;

class SoalUjian extends BaseController
{
    protected $review_soal_ujian;
    protected $soal_kelasModel;
    protected $soal_ujianModel;
    protected $prodiModel;
    protected $kelasModel;
    protected $tahun_akademikModel;
    protected $matkulModel;
    protected $db;

    public function __construct()
    {
        // $this->soal_kelasModel = new SoalKelasModel();
        $this->review_soal_ujianModel = new ReviewSoalUjianModel();
        $this->soal_ujianModel = new SoalUjianModel();
        $this->prodiModel = new ProdiModel();
        $this->kelasModel = new KelasModel();
        $this->tahun_akademikModel = new TahunAkademikModel();
        $this->matkulModel = new MatkulModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Review Soal Ujian',
            'review_soal_ujian' => $this->review_soal_ujianModel->getReviewSoalUjian()
        ];
        //dd($data);
        return view('admin/review_soal_ujian/index', $data);
    }

    public function edit($id_soal_ujian)
    {
        $soalUjian = $this->soal_ujianModel->find($id_soal_ujian);
        $kelas = $this->kelasModel->join('matkul', 'kelas.id_matkul=matkul.id_matkul')->join('soal_kelas', 'soal_kelas.id_kelas=kelas.id_kelas')->where('soal_kelas.id_soal_ujian =', $id_soal_ujian)->findAll();
        $data = [
            'title' => 'Edit Soal Ujian',
            'soal_ujian' => $soalUjian,
            'prodi' => $this->prodiModel->findAll(),
            'tahun_akademik_aktif' => $this->tahun_akademikModel->find($soalUjian['id_tahun_akademik']),
            'prodi_matkul' => $kelas[0]['id_prodi'],
            'matkul' => $kelas[0]['id_matkul'],
            'kelas' => array_column($kelas, 'id_kelas')
        ];
        return view('admin/soal_ujian/edit', $data);
    }

    public function update($id_soal_ujian)
    {
        if (!$this->validate([
            'periode_ujian' => [
                'rules' => 'required',
                'label' => 'Periode Ujian',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'prodi' => [
                'rules' => 'required',
                'label' => 'Program Studi',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'matkul' => [
                'rules' => 'required',
                'label' => 'Mata Kuliah',
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
            'dosen' => [
                'rules' => 'required',
                'label' => 'Dosen',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'soal_ujian' => [
                'rules' => 'uploaded[soal_ujian]|max_size[soal_ujian,2048]|ext_in[soal_ujian,pdf]',
                'label' => 'Soal Ujian',
                'errors' => [
                    'uploaded' => '{field} harus diisi.',
                    'max_size' => 'Ukuran file maksimal 2 MB.',
                    'ext_in' => 'Yang Anda pilih bukan file pdf.'
                ]
            ],
            'bentuk_soal' => [
                'rules' => 'required',
                'label' => 'Bentuk Soal',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'metode' => [
                'rules' => 'required',
                'label' => 'Metode',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        }

        //validasi agar tidak ada kelas yg sama di jadwal ujian dengan tahun akademik dan semester yg sama
        // if ($this->soal_ujianModel->where([
        //     'id_kelas' => $this->request->getVar('kelas'),
        //     'id_tahun_akademik' => $this->tahun_akademikModel->getAktif()['id_tahun_akademik'],
        //     'id_soal_ujian !=' => $id_soal_ujian
        // ])->first()) {
        //     return redirect()->back()->with('error', 'Jadwal Ujian Sudah Dibuat.')->withInput();
        // }

        $namaSoalUjian = $this->request->getVar('oldFile');
        // ambil file soal ujian
        $fileSoalUjian = $this->request->getFile('soal_ujian');
        // dd($fileSoalUjian);
        // generate nama soal ujian random
        $namaSoalUjian = $fileSoalUjian->getRandomName();
        // pindahkan file ke folder soal ujian
        $fileSoalUjian->move('assets/soal_ujian/', $namaSoalUjian);
        // hapus file yang lama
        unlink('assets/soal_ujian/' . $this->request->getVar('oldFile'));

        try {
            $this->db->transException(true)->transStart();
            $this->db->table('soal_ujian')->where('id_soal_ujian', $id_soal_ujian)->update([
                'id_tahun_akademik' => $this->tahun_akademikModel->getAktif()['id_tahun_akademik'],
                'id_dosen' => $this->request->getVar('dosen'),
                'periode_ujian' => $this->request->getVar('periode_ujian'),
                'soal_ujian' => $namaSoalUjian,
                'bentuk_soal' => $this->request->getVar('bentuk_soal'),
                'metode' => $this->request->getVar('metode')
            ]);

            $kelas = $this->request->getVar('kelas');
            $soal_kelas = [];
            foreach ($kelas as $k) {
                $soal_kelas[] = [
                    'id_soal_ujian' => $id_soal_ujian,
                    'id_kelas' => $k
                ];
            }
            $this->db->table('soal_kelas')->where('id_soal_ujian', $id_soal_ujian)->delete();
            $this->db->table('soal_kelas')->insertBatch($soal_kelas);
            $this->db->transComplete();

            session()->setFlashdata('success', 'Data Berhasil Diubah');
        } catch (\Exception $e) {
            session()->setFlashdata('error', $e->getMessage());
        }

        return redirect()->to('/admin/soal_ujian');
    }
}
