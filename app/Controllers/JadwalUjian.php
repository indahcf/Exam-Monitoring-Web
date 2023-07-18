<?php

namespace App\Controllers;

use Dompdf\Dompdf;
use App\Models\KelasModel;
use App\Models\ProdiModel;
use App\Models\MatkulModel;
use App\Models\RuangUjianModel;
use App\Models\JadwalRuangModel;
use App\Models\JadwalUjianModel;
use App\Models\TahunAkademikModel;
use CodeIgniter\Database\Exceptions\DatabaseException;

class JadwalUjian extends BaseController
{
    protected $jadwal_ruangModel;
    protected $jadwal_ujianModel;
    protected $prodiModel;
    protected $kelasModel;
    protected $tahun_akademikModel;
    protected $ruang_ujianModel;
    protected $matkulModel;
    protected $db;

    public function __construct()
    {
        $this->jadwal_ruangModel = new JadwalRuangModel();
        $this->jadwal_ujianModel = new JadwalUjianModel();
        $this->prodiModel = new ProdiModel();
        $this->kelasModel = new KelasModel();
        $this->ruang_ujianModel = new RuangUjianModel();
        $this->tahun_akademikModel = new TahunAkademikModel();
        $this->matkulModel = new MatkulModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $tahun_akademik_aktif = $this->tahun_akademikModel->getAktif()['id_tahun_akademik'];
        $jadwal_ujian_terakhir = $this->jadwal_ujianModel->orderBy('tanggal', 'DESC')->findAll()[0]['periode_ujian'];
        $periode_ujian_aktif = $jadwal_ujian_terakhir;
        $filter = $this->request->getVar('filter') ?: $tahun_akademik_aktif . "_" . $periode_ujian_aktif;
        // dd($filter);
        $id_tahun_akademik = explode("_", $filter)[0];
        $periode_ujian = explode("_", $filter)[1];
        $jadwal_ujian = $this->jadwal_ujianModel->filterJadwalUjian($id_tahun_akademik, $periode_ujian);
        $url_export = 'admin/jadwal_ujian/export?filter=' . $filter;

        $data = [
            'title' => 'Data Jadwal Ujian',
            'jadwal_ujian' => $jadwal_ujian,
            'tahun_akademik' => $this->tahun_akademikModel->findAll(),
            'url_export' => base_url($url_export),
            'filter' => $id_tahun_akademik . "_" . $periode_ujian
        ];

        return view('admin/jadwal_ujian/index', $data);
    }

    public function export()
    {
        $tahun_akademik_aktif = $this->tahun_akademikModel->getAktif()['id_tahun_akademik'];
        $jadwal_ujian_terakhir = $this->jadwal_ujianModel->orderBy('tanggal', 'DESC')->findAll()[0]['periode_ujian'];
        $periode_ujian_aktif = $jadwal_ujian_terakhir;
        $filter = $this->request->getVar('filter') ?: $tahun_akademik_aktif . "_" . $periode_ujian_aktif;
        // dd($filter);
        $id_tahun_akademik = explode("_", $filter)[0];
        $periode_ujian = explode("_", $filter)[1];
        $jadwal_ujian = $this->jadwal_ujianModel->filterJadwalUjian($id_tahun_akademik, $periode_ujian);
        $label = 'Jadwal ' . $periode_ujian . ' ' . $jadwal_ujian[0]['semester'] . ' ' . $jadwal_ujian[0]['tahun_akademik'];

        $data = [
            'jadwal_ujian' => $jadwal_ujian,
            'label' => $label
        ];

        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('admin/jadwal_ujian/export', $data));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream(str_replace("/", "-", $label), array("Attachment" => false));
    }

    public function create()
    {
        // dd($this->tahun_akademikModel->where('status', true)->first()['id_tahun_akademik']);
        $data = [
            'title'          => 'Tambah Jadwal Ujian',
            'prodi'          => $this->prodiModel->findAll(),
            'ruang_ujian'    => $this->ruang_ujianModel->findAll(),
            'tahun_akademik' => $this->tahun_akademikModel->findAll()
        ];

        return view('admin/jadwal_ujian/create', $data);
    }

    protected function ruangan_is_duplicate($ruang_ujian)
    {
        $unique_array_id = array_unique($ruang_ujian);

        if (count($ruang_ujian) == count($unique_array_id)) {
            return false;
        } else {
            return true;
        }
    }

    public function save()
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
            'kelas' => [
                'rules' => 'required',
                'label' => 'Kelas',
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
            ],
            'ruang_ujian.*' => [
                'rules' => 'required',
                'label' => 'Ruang Ujian',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        }

        //validasi agar tidak ada kelas yg sama di jadwal ujian dengan tahun akademik dan semester serta periode ujian yg sama
        if ($this->jadwal_ujianModel->where([
            'id_kelas' => $this->request->getVar('kelas'),
            'periode_ujian' => $this->request->getVar('periode_ujian'),
            'id_tahun_akademik' => $this->tahun_akademikModel->getAktif()['id_tahun_akademik']
        ])->first()) {
            return redirect()->back()->with('error', 'Jadwal Ujian Sudah Dibuat.')->withInput();
        }

        //validasi agar tidak ada ruang ujian yang sama dalam 1 jadwal ujian
        if ($this->ruangan_is_duplicate($this->request->getVar('ruang_ujian'))) {
            return redirect()->back()->with('error', 'Ruang Ujian yang Dipilih Ada yang Sama.')->withInput();
        }

        try {
            $this->db->transException(true)->transStart();
            $this->db->table('jadwal_ujian')->insert([
                'periode_ujian' => $this->request->getVar('periode_ujian'),
                'id_kelas' => $this->request->getVar('kelas'),
                'id_tahun_akademik' => $this->tahun_akademikModel->getAktif()['id_tahun_akademik'],
                'tanggal' => $this->request->getVar('tanggal'),
                'jam_mulai' => $this->request->getVar('jam_mulai'),
                'jam_selesai' => $this->request->getVar('jam_selesai')
            ]);

            $id_jadwal_ujian = $this->db->insertID();
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
            $this->db->table('jadwal_ruang')->insertBatch($jadwal_ruangan);
            $this->db->transComplete();

            session()->setFlashdata('success', 'Data Berhasil Ditambahkan');
        } catch (DatabaseException $e) {
            session()->setFlashdata('error', $e->getMessage());
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
        $jadwalUjian = $this->jadwal_ujianModel->find($id_jadwal_ujian);
        $id_kelas = $this->jadwal_ujianModel->find($id_jadwal_ujian)['id_kelas'];
        $id_matkul = $this->kelasModel->find($id_kelas)['id_matkul'];
        $ruang_ujian = $this->ruang_ujianModel->join('jadwal_ruang', 'jadwal_ruang.id_ruang_ujian=ruang_ujian.id_ruang_ujian')->where('jadwal_ruang.id_jadwal_ujian =', $id_jadwal_ujian)->findAll();
        $jumlah_peserta = $this->jadwal_ruangModel->where('id_jadwal_ujian', $id_jadwal_ujian)->findAll();
        $data = [
            'title' => 'Edit Jadwal Ujian',
            'jadwal_ujian' => $jadwalUjian,
            'prodi' => $this->prodiModel->findAll(),
            'kelas' => $this->kelasModel->find($jadwalUjian['id_kelas']),
            'ruang_ujian' => array_column($ruang_ujian, 'id_ruang_ujian'),
            'tahun_akademik_aktif' => $this->tahun_akademikModel->find($jadwalUjian['id_tahun_akademik']),
            'prodi_kelas' => $this->matkulModel->find($id_matkul)['id_prodi'],
            'dosen' => $this->kelasModel->find($id_kelas)['id_dosen'],
            'jumlah_peserta' => array_column($jumlah_peserta, 'jumlah_peserta')
        ];
        // dd($data);
        return view('admin/jadwal_ujian/edit', $data);
    }

    public function update($id_jadwal_ujian)
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

        //validasi agar tidak ada kelas yg sama di jadwal ujian dengan tahun akademik dan semester serta periode ujian yg sama
        if ($this->jadwal_ujianModel->where([
            'id_kelas' => $this->request->getVar('kelas'),
            'periode_ujian' => $this->request->getVar('periode_ujian'),
            'id_tahun_akademik' => $this->tahun_akademikModel->getAktif()['id_tahun_akademik'],
            'id_jadwal_ujian !=' => $id_jadwal_ujian
        ])->first()) {
            return redirect()->back()->with('error', 'Jadwal Ujian Sudah Dibuat.')->withInput();
        }

        //validasi agar tidak ada ruang ujian yang sama dalam 1 jadwal ujian
        if ($this->ruangan_is_duplicate($this->request->getVar('ruang_ujian'))) {
            return redirect()->back()->with('error', 'Ruang Ujian yang Dipilih Ada yang Sama.')->withInput();
        }

        try {
            $this->db->transException(true)->transStart();
            $this->db->table('jadwal_ujian')->where('id_jadwal_ujian', $id_jadwal_ujian)->update([
                'periode_ujian' => $this->request->getVar('periode_ujian'),
                'id_kelas' => $this->request->getVar('kelas'),
                'id_tahun_akademik' => $this->tahun_akademikModel->getAktif()['id_tahun_akademik'],
                'tanggal' => $this->request->getVar('tanggal'),
                'jam_mulai' => $this->request->getVar('jam_mulai'),
                'jam_selesai' => $this->request->getVar('jam_selesai')
            ]);

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
            $this->db->table('jadwal_ruang')->where('id_jadwal_ujian', $id_jadwal_ujian)->delete();
            $this->db->table('jadwal_ruang')->insertBatch($jadwal_ruangan);
            $this->db->transComplete();

            session()->setFlashdata('success', 'Data Berhasil Diubah');
        } catch (\Exception $e) {
            session()->setFlashdata('error', $e->getMessage());
        }

        return redirect()->to('/admin/jadwal_ujian');
    }

    public function simpanExcel()
    {
        $validation = \Config\Services::validation();

        if (!$this->validate([
            'periode_ujian' => [
                'rules' => 'required',
                'label' => 'Periode Ujian',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'fileexcel' => [
                'rules' => 'uploaded[fileexcel]|max_size[fileexcel,2048]|ext_in[fileexcel,xls,xlsx]',
                'label' => 'File Excel',
                'errors' => [
                    'uploaded' => '{field} harus diisi.',
                    'max_size' => 'Ukuran file maksimal 2 MB.',
                    'ext_in' => 'Yang Anda pilih bukan file excel.'
                ]
            ]
        ])) {
            $message = [
                'error' => [
                    'periode_ujian' => $validation->getError('periode_ujian'),
                    'fileexcel' => $validation->getError('fileexcel')
                ]
            ];
            return $this->response->setJSON($message);
        }

        $file_excel = $this->request->getFile('fileexcel');
        $ext = $file_excel->getClientExtension();
        if ($ext == 'xls') {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        } else {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }
        $spreadsheet = $render->load($file_excel);

        $data = $spreadsheet->getActiveSheet()->toArray();
        // dd($data);

        try {
            $count = 0;
            $jadwal_ruangan = [];
            $this->db->transException(true)->transStart();
            foreach ($data as $x => $row) {
                if ($x != 0 && $row[0] != null) {

                    //cek validasi
                    if ($this->jadwal_ujianModel->where([
                        'periode_ujian' => $this->request->getVar('periode_ujian'),
                        'id_kelas' => $row[0],
                        'id_tahun_akademik' => $row[1]
                    ])->first()) {
                        continue;
                    }

                    $jadwal_ujian = [
                        'periode_ujian' => $this->request->getVar('periode_ujian'),
                        'id_kelas' => $row[0],
                        'id_tahun_akademik' => $row[1],
                        'tanggal' => $row[2],
                        'jam_mulai' => $row[3],
                        'jam_selesai' => $row[4]
                    ];

                    $this->db->table('jadwal_ujian')->insert($jadwal_ujian);
                    $id_jadwal_ujian = $this->db->insertID();
                    $id_kelas = $row[0];
                    foreach ($data as $r) {
                        if ($r[0] == $id_kelas) {
                            $jadwal_ruangan[] = [
                                'id_jadwal_ujian' => $id_jadwal_ujian,
                                'id_ruang_ujian' => $r[5],
                                'jumlah_peserta' => $r[6]
                            ];
                        }
                    }

                    $count++;
                }
            }

            if ($count > 0) {
                //validasi agar tidak ada ruang ujian yang sama dalam 1 jadwal ujian
                $array_id_ruangan = array_column($jadwal_ruangan, 'id_ruang_ujian');
                if ($this->ruangan_is_duplicate($array_id_ruangan)) {
                    $message = [
                        'error' => [
                            'fileexcel' => ' Ruang Ujian yang Dipilih Ada yang Sama.'
                        ]
                    ];
                    return $this->response->setJSON($message);
                }
                // dd($jadwal_ujian);
                // dd($jadwal_ruangan);
                $this->db->table('jadwal_ruang')->insertBatch($jadwal_ruangan);
                $this->db->transComplete();

                session()->setFlashdata('success', 'Data Berhasil Diimport');
            } else {
                session()->setFlashdata('error', 'Tidak Ada Data yang Diimport');
            }
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Data Gagal Diimport');
        }

        return $this->response->setJSON(["success" => true]);
    }
}
