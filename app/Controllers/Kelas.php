<?php

namespace App\Controllers;

use App\Models\DosenModel;
use App\Models\KelasModel;
use App\Models\ProdiModel;
use App\Models\MatkulModel;

class Kelas extends BaseController
{
    protected $kelasModel;
    protected $matkulModel;
    protected $dosenModel;
    protected $prodiModel;
    public function __construct()
    {
        $this->kelasModel = new KelasModel();
        $this->matkulModel = new MatkulModel();
        $this->dosenModel = new DosenModel();
        $this->prodiModel = new ProdiModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Kelas',
            'kelas' => $this->kelasModel->getKelas()
        ];

        return view('admin/kelas/index', $data);
    }

    public function create()
    {
        $data = [
            'title'     => 'Tambah Kelas',
            'prodi'     => $this->prodiModel->findAll()
        ];

        return view('admin/kelas/create', $data);
    }

    public function save()
    {
        //validasi input
        if (!$this->validate([
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
            'asal_dosen' => [
                'rules' => 'required',
                'label' => 'Asal Dosen',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'dosen' => [
                'rules' => 'required',
                'label' => 'Dosen Pengampu',
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
            'jumlah_mahasiswa' => [
                'rules' => 'required',
                'label' => 'Jumlah Mahasiswa',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        }

        //cek validasi
        if ($this->kelasModel->where([
            // 'id_prodi' => $this->request->getVar('prodi'),
            'id_matkul' => $this->request->getVar('matkul'),
            'id_dosen' => $this->request->getVar('dosen'),
            'kelas' => $this->request->getVar('kelas')
        ])->first()) {
            return redirect()->back()->with('error', 'Data sudah terdaftar.')->withInput();
        }

        try {
            $this->kelasModel->save([
                'id_matkul' => $this->request->getVar('matkul'),
                'id_dosen' => $this->request->getVar('dosen'),
                'kelas' => $this->request->getVar('kelas'),
                'jumlah_mahasiswa' => $this->request->getVar('jumlah_mahasiswa')
            ]);
            session()->setFlashdata('success', 'Data Berhasil Ditambahkan');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Data Gagal Ditambahkan');
        }

        return redirect()->to('/admin/kelas');
    }

    public function delete($id_kelas)
    {
        try {
            $this->kelasModel->delete($id_kelas);
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

    public function edit($id_kelas)
    {
        $id_dosen = $this->kelasModel->find($id_kelas)['id_dosen'];
        $id_matkul = $this->kelasModel->find($id_kelas)['id_matkul'];
        $data = [
            'title' => 'Edit Kelas',
            'kelas' => $this->kelasModel->find($id_kelas),
            'prodi' => $this->prodiModel->findAll(),
            'asal_dosen' => $this->dosenModel->find($id_dosen)['id_prodi'],
            'prodi_kelas' => $this->matkulModel->find($id_matkul)['id_prodi']
        ];

        return view('admin/kelas/edit', $data);
    }

    public function update($id_kelas)
    {
        //validasi input
        if (!$this->validate([
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
            'asal_dosen' => [
                'rules' => 'required',
                'label' => 'Asal Dosen',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'dosen' => [
                'rules' => 'required',
                'label' => 'Dosen Pengampu',
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
            'jumlah_mahasiswa' => [
                'rules' => 'required',
                'label' => 'Jumlah Mahasiswa',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        }

        //cek validasi
        if ($this->kelasModel->where([
            // 'id_prodi' => $this->request->getVar('prodi'),
            'id_matkul' => $this->request->getVar('matkul'),
            'id_dosen' => $this->request->getVar('dosen'),
            'kelas' => $this->request->getVar('kelas'),
            'id_kelas !=' => $id_kelas
        ])->first()) {
            return redirect()->back()->with('error', 'Data sudah terdaftar.')->withInput();
        }

        try {
            $this->kelasModel->save([
                'id_kelas' => $id_kelas,
                'id_matkul' => $this->request->getVar('matkul'),
                'id_dosen' => $this->request->getVar('dosen'),
                'kelas' => $this->request->getVar('kelas'),
                'jumlah_mahasiswa' => $this->request->getVar('jumlah_mahasiswa')
            ]);
            session()->setFlashdata('success', 'Data Berhasil Diubah');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Data Gagal Diubah');
        }

        return redirect()->to('/admin/kelas');
    }

    public function json($id = null)
    {
        if ($id) {
            // kelas berdasarkan id_kelas
            $kelas = $this->kelasModel->find($id);
        } else {

            $id_prodi = $this->request->getVar('id_prodi', NULL);
            if ($id_prodi !== NULL) {
                // kelas berdasarkan id_prodi
                $kelas = $this->kelasModel->getKelasByProdi($id_prodi);
            } else {
                // semua kelas 
                $kelas = $this->kelasModel->findAll();
            }
        }
        return $this->response->setJSON($kelas);
    }

    public function simpanExcel()
    {
        $file_excel = $this->request->getFile('fileexcel');
        $ext = $file_excel->getClientExtension();
        if ($ext == 'xls') {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        } else {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }
        $spreadsheet = $render->load($file_excel);

        $data = $spreadsheet->getActiveSheet()->toArray();
        foreach ($data as $x => $row) {
            if ($x == 0) {
                continue;
            }

            $Nis = $row[0];
            $NamaSiswa = $row[1];
            $Alamat = $row[2];

            $db = \Config\Database::connect();

            $cekNis = $db->table('siswa')->getWhere(['Nis' => $Nis])->getResult();

            if (count($cekNis) > 0) {
                session()->setFlashdata('message', '<b style="color:red">Data Gagal di Import NIS ada yang sama</b>');
            } else {

                $simpandata = [
                    'Nis' => $Nis, 'NamaSiswa' => $NamaSiswa, 'Alamat' => $Alamat
                ];

                $db->table('siswa')->insert($simpandata);
                session()->setFlashdata('message', 'Berhasil import excel');
            }
        }

        return redirect()->to('/siswa');
    }
}
