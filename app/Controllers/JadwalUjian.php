<?php

namespace App\Controllers;

use Dompdf\Dompdf;
use App\Models\KelasModel;
use App\Models\ProdiModel;
use App\Models\MatkulModel;
use App\Models\PengawasModel;
use App\Models\RuangUjianModel;
use App\Models\JadwalRuangModel;
use App\Models\JadwalUjianModel;
use App\Models\TahunAkademikModel;
use App\Models\DosenModel;
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
    protected $pengawasModel;
    protected $dosenModel;
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
        $this->pengawasModel = new PengawasModel();
        $this->dosenModel = new DosenModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $tahun_akademik_aktif = $this->tahun_akademikModel->getAktif()['id_tahun_akademik'];
        $jadwal_ujian_terakhir = $this->jadwal_ujianModel->orderBy('tanggal', 'DESC')->findAll();

        $filter = $this->request->getVar('filter');
        $jadwal_ujian = [];
        $url_export = 'admin/jadwal_ujian/export';
        if ($jadwal_ujian_terakhir) {
            $periode_ujian_aktif = $jadwal_ujian_terakhir[0]['periode_ujian'];
            $filter = $this->request->getVar('filter') ?: $tahun_akademik_aktif . "_" . $periode_ujian_aktif;
            // dd($filter);
            $id_tahun_akademik = explode("_", $filter)[0];
            $periode_ujian = explode("_", $filter)[1];
            $jadwal_ujian = $this->jadwal_ujianModel->filterJadwalUjian($id_tahun_akademik, $periode_ujian);
            $url_export = 'admin/jadwal_ujian/export?filter=' . $filter;
        }

        $data = [
            'title' => 'Data Jadwal Ujian',
            'jadwal_ujian' => $jadwal_ujian,
            'tahun_akademik' => $this->tahun_akademikModel->findAll(),
            'url_export' => base_url($url_export),
            'filter' => $filter
        ];
        // dd($data);

        return view('admin/jadwal_ujian/index', $data);
    }

    public function export()
    {
        $tahun_akademik_aktif = $this->tahun_akademikModel->getAktif()['id_tahun_akademik'];
        $jadwal_ujian_terakhir = $this->jadwal_ujianModel->orderBy('tanggal', 'DESC')->findAll();

        $filter = $this->request->getVar('filter');
        $jadwal_ujian = [];
        if ($jadwal_ujian_terakhir) {
            $periode_ujian_aktif = $jadwal_ujian_terakhir[0]['periode_ujian'];
            $filter = $this->request->getVar('filter') ?: $tahun_akademik_aktif . "_" . $periode_ujian_aktif;
            // dd($filter);
            $id_tahun_akademik = explode("_", $filter)[0];
            $periode_ujian = explode("_", $filter)[1];
            $jadwal_ujian = $this->jadwal_ujianModel->filterJadwalUjian($id_tahun_akademik, $periode_ujian);
            $label = 'Jadwal ' . $periode_ujian . ' ' . $jadwal_ujian[0]['semester'] . ' Tahun Akademik ' . $jadwal_ujian[0]['tahun_akademik'];
        }

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

        $koordinator_ujian = [];
        $dosen = $this->dosenModel->findAll();
        foreach ($dosen as $i => $d) {
            $prodi = $this->prodiModel->where('id_prodi =', $d['id_prodi'])->first();
            if ($prodi['prodi'] != 'Non Teknik') {
                $koordinator_ujian[$i] = $d;
            }
        }

        $data = [
            'title'                 => 'Tambah Jadwal Ujian',
            'prodi'                 => $this->prodiModel->findAll(),
            'koordinator_ujian'     => $koordinator_ujian
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

    protected function pengawas_is_duplicate($pengawas1, $pengawas2)
    {
        $merged_pengawas = array_merge($pengawas1, $pengawas2);

        $hapus_string_kosong = array_diff($merged_pengawas, array(""));
        // dd($hapus_string_kosong);
        $unique_array_id = array_unique($hapus_string_kosong);
        // dd($unique_array_id);

        if (count($hapus_string_kosong) == count($unique_array_id)) {
            return false;
        } else {
            return true;
        }
    }

    public function save()
    {
        // dd($this->request->getPost());
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
            'koordinator_ujian' => [
                'rules' => 'required',
                'label' => 'Koordinator Ujian',
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
            'pengawas1.*' => [
                'rules' => 'required',
                'label' => 'Pengawas 1',
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

        //validasi agar tidak ada pengawas yang sama dalam 1 jadwal ujian
        $pengawas1 = $this->request->getVar('pengawas1');
        $pengawas2 = $this->request->getVar('pengawas2');
        if ($this->pengawas_is_duplicate($pengawas1, $pengawas2)) {
            return redirect()->back()->with('error', 'Pengawas yang Dipilih Ada yang Sama.')->withInput();
        }

        try {
            $this->db->transException(true)->transStart();
            $this->db->table('jadwal_ujian')->insert([
                'periode_ujian' => $this->request->getVar('periode_ujian'),
                'id_kelas' => $this->request->getVar('kelas'),
                'id_tahun_akademik' => $this->tahun_akademikModel->getAktif()['id_tahun_akademik'],
                'tanggal' => $this->request->getVar('tanggal'),
                'jam_mulai' => $this->request->getVar('jam_mulai'),
                'jam_selesai' => $this->request->getVar('jam_selesai'),
                'koordinator_ujian' => $this->request->getVar('koordinator_ujian')
            ]);

            $id_jadwal_ujian = $this->db->insertID();
            $ruang_ujian = $this->request->getVar('ruang_ujian');
            $jumlah_peserta = $this->request->getVar('jumlah_peserta');
            $pengawas1 = $this->request->getVar('pengawas1');
            $pengawas2 = $this->request->getVar('pengawas2');
            foreach ($ruang_ujian as $i => $r) {
                $this->db->table('jadwal_ruang')->insert([
                    'id_jadwal_ujian' => $id_jadwal_ujian,
                    'id_ruang_ujian' => $r,
                    'jumlah_peserta' => $jumlah_peserta[$i]
                ]);
                $id_jadwal_ruang = $this->db->insertID();
                $this->db->table('jadwal_pengawas')->insert([
                    'id_jadwal_ruang' => $id_jadwal_ruang,
                    'id_pengawas' => $pengawas1[$i],
                    'jenis_pengawas' => 'Pengawas 1'
                ]);
                if (!empty($pengawas2[$i])) {
                    $this->db->table('jadwal_pengawas')->insert([
                        'id_jadwal_ruang' => $id_jadwal_ruang,
                        'id_pengawas' => $pengawas2[$i],
                        'jenis_pengawas' => 'Pengawas 2'
                    ]);
                }
            };

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
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => $e->getMessage()
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
        $data_pengawas = $this->pengawasModel->join('jadwal_pengawas', 'jadwal_pengawas.id_pengawas=pengawas.id_pengawas')->join('jadwal_ruang', 'jadwal_ruang.id_jadwal_ruang=jadwal_pengawas.id_jadwal_ruang')->where('jadwal_ruang.id_jadwal_ujian =', $id_jadwal_ujian)->orderBy('id_ruang_ujian', 'ASC')->findAll();

        $pengawas = array();

        foreach ($data_pengawas as $row) {
            $id_ruang_ujian = $row['id_ruang_ujian'];
            $id_pengawas = $row['id_pengawas'];
            $jenis_pengawas = $row['jenis_pengawas'];

            if (!isset($pengawas[$id_ruang_ujian])) {
                $pengawas[$id_ruang_ujian] = array();
            }

            $pengawas[$id_ruang_ujian][$jenis_pengawas] = $id_pengawas;
        }

        $koordinator_ujian = [];
        $dosen = $this->dosenModel->findAll();
        foreach ($dosen as $i => $d) {
            $prodi = $this->prodiModel->where('id_prodi =', $d['id_prodi'])->first();
            if ($prodi['prodi'] != 'Non Teknik') {
                $koordinator_ujian[$i] = $d;
            }
        }

        $data = [
            'title' => 'Edit Jadwal Ujian',
            'jadwal_ujian' => $jadwalUjian,
            'prodi' => $this->prodiModel->findAll(),
            'ruang_ujian' => array_column($ruang_ujian, 'id_ruang_ujian'),
            'tahun_akademik_aktif' => $this->tahun_akademikModel->find($jadwalUjian['id_tahun_akademik']),
            'prodi_kelas' => $this->matkulModel->find($id_matkul)['id_prodi'],
            'dosen' => $this->kelasModel->find($id_kelas)['id_dosen'],
            'jumlah_peserta' => array_column($jumlah_peserta, 'jumlah_peserta'),
            'pengawas' => $pengawas,
            'koordinator_ujian' => $koordinator_ujian
        ];

        // dd($data['pengawas']);
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
            'koordinator_ujian' => [
                'rules' => 'required',
                'label' => 'Koordinator Ujian',
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
            'pengawas1.*' => [
                'rules' => 'required',
                'label' => 'Pengawas 1',
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
                'tanggal' => $this->request->getVar('tanggal'),
                'jam_mulai' => $this->request->getVar('jam_mulai'),
                'jam_selesai' => $this->request->getVar('jam_selesai'),
                'koordinator_ujian' => $this->request->getVar('koordinator_ujian')
            ]);

            $ruang_ujian = $this->request->getVar('ruang_ujian');
            $jumlah_peserta = $this->request->getVar('jumlah_peserta');
            $pengawas1 = $this->request->getVar('pengawas1');
            $pengawas2 = $this->request->getVar('pengawas2');
            $this->db->table('jadwal_ruang')->where('id_jadwal_ujian', $id_jadwal_ujian)->delete();
            foreach ($ruang_ujian as $i => $r) {
                $this->db->table('jadwal_ruang')->insert([
                    'id_jadwal_ujian' => $id_jadwal_ujian,
                    'id_ruang_ujian' => $r,
                    'jumlah_peserta' => $jumlah_peserta[$i]
                ]);
                $id_jadwal_ruang = $this->db->insertID();
                $this->db->table('jadwal_pengawas')->insert([
                    'id_jadwal_ruang' => $id_jadwal_ruang,
                    'id_pengawas' => $pengawas1[$i],
                    'jenis_pengawas' => 'Pengawas 1'
                ]);
                if (!empty($pengawas2[$i])) {
                    $this->db->table('jadwal_pengawas')->insert([
                        'id_jadwal_ruang' => $id_jadwal_ruang,
                        'id_pengawas' => $pengawas2[$i],
                        'jenis_pengawas' => 'Pengawas 2'
                    ]);
                }
            };
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
                        // 'id_kelas' => $row[0],
                        'id_tahun_akademik' => $this->tahun_akademikModel->getAktif()['id_tahun_akademik']
                    ])->first()) {
                        continue;
                    }

                    $dosen = [
                        'dosen' => $row[6]
                    ];

                    $result_dosen = $this->db->table('dosen')->where($dosen)->get()->getRow();

                    if (count($result_dosen) == 0) {
                        $this->db->table('dosen')->insert($dosen);
                        $id_dosen = $this->db->insertID();
                    }

                    $id_dosen = $this->db->table('dosen')->select('*')->where($dosen)->get()->getRow()->id_dosen;

                    $prodi = [
                        'prodi' => $row[5]
                    ];

                    $result_prodi = $this->db->table('prodi')->where($prodi)->get()->getRow();

                    if (count($result_prodi) == 0) {
                        $this->db->table('prodi')->insert($prodi);
                        $id_prodi = $this->db->insertID();
                    }

                    $id_prodi = $this->db->table('prodi')->select('*')->where($prodi)->get()->getRow()->id_prodi;

                    $matkul = [
                        'kode_matkul' => $row[3],
                        'matkul' => $row[4]
                    ];

                    $result_matkul = $this->db->table('matkul')->where($matkul)->get()->getRow();

                    if (count($result_matkul) == 0) {
                        $_matkul = [
                            'id_prodi' => $id_prodi,
                            'matkul'  => $matkul,
                        ];
                        $this->db->table('matkul')->insert($_matkul);
                        $id_matkul = $this->db->insertID();
                    }

                    $id_matkul = $this->db->table('matkul')->select('*')->where($matkul)->get()->getRow()->id_matkul;

                    $kelas = [
                        'kelas' => $row[7]
                    ];

                    $result_kelas = $this->db->table('kelas')->where($kelas)->get()->getRow();

                    if (count($result_kelas) == 0) {
                        $_kelas = [
                            'id_matkul' => $id_matkul,
                            'id_dosen' => $id_dosen,
                            'kelas'  => $kelas,
                        ];
                        $this->db->table('kelas')->insert($_kelas);
                    }

                    $id_kelas = $this->db->table('kelas')->select('*')->where($kelas)->get()->getRow()->id_kelas;

                    $result_jadwal_ujian = $this->db->table('jadwal_ujian')->where(['kelas' => $id_kelas])->get()->getRow();
                    // jadwal ujian
                    $jam = explode("-", $row[3]);
                    $jadwal_ujian = [
                        'id_tahun_akademik' => $this->tahun_akademikModel->getAktif()['id_tahun_akademik'],
                        'periode_ujian' => $this->request->getVar('periode_ujian'),
                        'tanggal' => $row[1],
                        'jam_mulai' => $jam[0],
                        'jam_selesai' => $jam[1],
                        'kode_matkul' => $id_matkul,
                        'matkul' => $id_matkul,
                        'prodi' => $id_prodi,
                        'dosen' => $id_dosen,
                        'kelas' => $id_kelas
                    ];

                    if (count($result_jadwal_ujian) == 0) {
                        $this->db->table('jadwal_ujian')->insert($jadwal_ujian);
                        $id_jadwal_ujian = $this->db->insertID();
                        $tanggal = $row[1];
                        foreach ($data as $r) {
                            if ($r[1] == $tanggal) {
                                $ruang_ujian = [
                                    'ruang_ujian' => $row[8]
                                ];

                                $result_ruang_ujian = $this->db->table('ruang_ujian')->where($ruang_ujian)->get()->getRow();

                                if (count($result_ruang_ujian) == 0) {
                                    // insert ruang_ujian
                                    $this->db->table('ruang_ujian')->insert($ruang_ujian);
                                }

                                $id_ruang_ujian = $this->db->table('ruang_ujian')->select('*')->where($ruang_ujian)->get()->getRow()->id_ruang_ujian;
                                $result_jadwal_ruang = $this->db->table('jadwal_ruang')->where(['ruang_ujian' => $id_ruang_ujian])->get()->getRow();
                                $jadwal_ruangan[] = [
                                    'id_jadwal_ujian' => $id_jadwal_ujian,
                                    'ruang_ujian' => $id_ruang_ujian,
                                    'jumlah_peserta' => $r[9]
                                ];
                            }
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
                if (count($result_jadwal_ruang) == 0) {
                    $this->db->table('jadwal_ruang')->insertBatch($jadwal_ruangan);
                    $this->db->transComplete();
                }

                session()->setFlashdata('success', 'Data Berhasil Diimport');
            } else {
                session()->setFlashdata('error', 'Tidak Ada Data yang Diimport');
            }
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Data Gagal Diimport');
        }

        return $this->response->setJSON(["success" => true]);
    }

    public function kehadiran_pengawas($id_jadwal_ujian)
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
            ->where('jadwal_ruang.id_jadwal_ujian =', $id_jadwal_ujian)
            ->findAll();

        $jumlah_peserta = $this->jadwal_ruangModel->where('id_jadwal_ujian', $id_jadwal_ujian)->findAll();

        $data_pengawas = $this->pengawasModel->join('jadwal_pengawas', 'jadwal_pengawas.id_pengawas=pengawas.id_pengawas')->join('jadwal_ruang', 'jadwal_ruang.id_jadwal_ruang=jadwal_pengawas.id_jadwal_ruang')->where('jadwal_ruang.id_jadwal_ujian =', $id_jadwal_ujian)->orderBy('id_ruang_ujian', 'ASC')->findAll();

        $pengawas = array();

        foreach ($data_pengawas as $row) {
            $id_ruang_ujian = $row['id_ruang_ujian'];
            $id_pengawas = $row['id_pengawas'];
            $jenis_pengawas = $row['jenis_pengawas'];

            if (!isset($pengawas[$id_ruang_ujian])) {
                $pengawas[$id_ruang_ujian] = array();
            }

            $pengawas[$id_ruang_ujian][$jenis_pengawas] = $id_pengawas;
        }

        $data = [
            'title' => 'Edit Data Kehadiran Pengawas',
            'jadwal_ujian' => $jadwal_ujian,
            'ruang_ujian' => $ruang_ujian,
            'jumlah_peserta' => array_column($jumlah_peserta, 'jumlah_peserta'),
            'pengawas' => $pengawas
        ];
        return view('admin/jadwal_ujian/kehadiran_pengawas', $data);
    }
}
