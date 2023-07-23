<?php

namespace App\Controllers;

use App\Models\KelasModel;
use App\Models\ProdiModel;
use App\Models\MatkulModel;
use App\Models\SoalUjianModel;
use CodeIgniter\HTTP\Response;
use App\Models\TahunAkademikModel;
use CodeIgniter\Database\Exceptions\DatabaseException;

class ReviewSoalUjian extends BaseController
{
    protected $soal_ujianModel;
    protected $prodiModel;
    protected $kelasModel;
    protected $tahun_akademikModel;
    protected $matkulModel;
    protected $db;

    public function __construct()
    {
        $this->soal_ujianModel = new SoalUjianModel();
        $this->prodiModel = new ProdiModel();
        $this->kelasModel = new KelasModel();
        $this->tahun_akademikModel = new TahunAkademikModel();
        $this->matkulModel = new MatkulModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $tahun_akademik_aktif = $this->tahun_akademikModel->getAktif()['id_tahun_akademik'];
        $review_soal_ujian_terakhir = $this->soal_ujianModel->orderBy('created_at', 'DESC')->findAll();

        $filter = $this->request->getVar('filter');
        $review_soal_ujian = [];
        if ($review_soal_ujian_terakhir) {
            $periode_ujian_aktif = $review_soal_ujian_terakhir[0]['periode_ujian'];
            $filter = $this->request->getVar('filter') ?: $tahun_akademik_aktif . "_" . $periode_ujian_aktif;
            // dd($filter);
            $id_tahun_akademik = explode("_", $filter)[0];
            $periode_ujian = explode("_", $filter)[1];
            $review_soal_ujian = $this->soal_ujianModel->filterSoalUjian($id_tahun_akademik, $periode_ujian);
        }

        $data = [
            'title' => 'Data Review Soal Ujian',
            'review_soal_ujian' => $review_soal_ujian,
            'tahun_akademik' => $this->tahun_akademikModel->findAll(),
            'filter' => $filter
        ];
        // dd($data);
        return view('admin/review_soal_ujian/index', $data);
    }

    public function lihat_soal($soal_ujian)
    {
        if (isset($_POST['lihat_soal'])) {
            $this->response->setHeader('Content-Type', 'application/pdf');
            readfile('./assets/soal_ujian/' . $soal_ujian);
        }
    }

    // function cetak_soal($id_soal_ujian)
    // {
    //     $data = $this->soal_ujianModel->find($id_soal_ujian);
    //     return $this->response->download('./assets/soal_ujian/' . $data['soal_ujian'], null);
    // }

    function cetak_soal($id_soal_ujian)
    {
        $soal = $this->soal_ujianModel->find($id_soal_ujian);
        $download = $this->response->download('./assets/soal_ujian/' . $soal['soal_ujian'], null);

        if ($download) {
            $data = ['status_soal' => 'Dicetak'];
            $this->soal_ujianModel->update($id_soal_ujian, $data);
        }
        return $download;
    }

    // public function lihat_soal($review_soal_ujian)
    // {
    //     // open the local file
    //     $filepath = "./assets/soal_ujian/" . $review_soal_ujian;
    //     if (isset($_POST['lihat_soal']) && file_exists($filepath)) {
    //         // header("Content-Transfer-Encoding: binary");
    //         $this->response->setHeader('Content-Type', 'application/pdf');
    //         readfile($filepath);
    //     } else {
    //         echo "File not found.";
    //     }
    // }

    public function edit($id_soal_ujian)
    {
        $reviewSoalUjian = $this->soal_ujianModel->join('dosen', 'soal_ujian.id_dosen=dosen.id_dosen')->find($id_soal_ujian);
        $kelas = $this->kelasModel->join('matkul', 'kelas.id_matkul=matkul.id_matkul')->join('prodi', 'matkul.id_prodi=prodi.id_prodi')->join('soal_kelas', 'soal_kelas.id_kelas=kelas.id_kelas')->where('soal_kelas.id_soal_ujian =', $id_soal_ujian)->findAll();
        $data = [
            'title' => 'Tambah Review Soal Ujian',
            'review_soal_ujian' => $reviewSoalUjian,
            'prodi' => $this->prodiModel->findAll(),
            'tahun_akademik_aktif' => $this->tahun_akademikModel->find($reviewSoalUjian['id_tahun_akademik']),
            'prodi_matkul' => $kelas[0]['prodi'],
            'kode_matkul' => $kelas[0]['kode_matkul'],
            'matkul' => $kelas[0]['matkul'],
            // 'kelas' => array_column($kelas, 'kelas'),
            'kelas' => implode(", ", array_column($kelas, 'kelas'))
        ];
        return view('admin/review_soal_ujian/edit', $data);
    }

    public function update($id_soal_ujian)
    {
        // dd($this->request->getPost());
        if (!$this->validate([
            'durasi_pengerjaan' => [
                'rules' => 'required',
                'label' => 'Durasi Pengerjaan',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'sifat_ujian' => [
                'rules' => 'required',
                'label' => 'Sifat Ujian',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'petunjuk' => [
                'rules' => 'required',
                'label' => 'Petunjuk',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'sub_cpmk' => [
                'rules' => 'required',
                'label' => 'Sub CPMK',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'durasi_sks' => [
                'rules' => 'required',
                'label' => 'Durasi SKS',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'pertanyaan' => [
                'rules' => 'required',
                'label' => 'Pertanyaan',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'skor' => [
                'rules' => 'required',
                'label' => 'Skor',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'gambar' => [
                'rules' => 'required',
                'label' => 'Gambar',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'catatan' => [
                'rules' => 'required',
                'label' => 'Catatan',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'saran' => [
                'rules' => 'required',
                'label' => 'Saran',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'status_soal' => [
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
            $this->db->table('soal_ujian')->where('id_soal_ujian', $id_soal_ujian)->update([
                // 'id_tahun_akademik' => $this->tahun_akademikModel->getAktif()['id_tahun_akademik'],
                // 'periode_ujian' => $this->request->getVar('periode_ujian'),
                'durasi_pengerjaan' => $this->request->getVar('durasi_pengerjaan'),
                'sifat_ujian' => $this->request->getVar('sifat_ujian'),
                'petunjuk' => $this->request->getVar('petunjuk'),
                'sub_cpmk' => $this->request->getVar('sub_cpmk'),
                'durasi_sks' => $this->request->getVar('durasi_sks'),
                'pertanyaan' => $this->request->getVar('pertanyaan'),
                'skor' => $this->request->getVar('skor'),
                'gambar' => $this->request->getVar('gambar'),
                'catatan' => $this->request->getVar('catatan'),
                'saran' => $this->request->getVar('saran'),
                'status_soal' => $this->request->getVar('status_soal')
            ]);
            session()->setFlashdata('success', 'Data Berhasil Diubah');
        } catch (\Exception $e) {
            session()->setFlashdata('error', $e->getMessage());
        }

        return redirect()->to('/admin/review_soal_ujian');
    }
}
