<?php

namespace App\Controllers;

use App\Models\RuangUjianModel;

class RuangUjian extends BaseController
{
    protected $ruang_ujianModel;
    public function __construct()
    {
        $this->ruang_ujianModel = new RuangUjianModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Ruang Ujian',
            'ruang_ujian' => $this->ruang_ujianModel->findAll()
        ];

        return view('admin/ruang_ujian/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Ruang Ujian'
        ];

        return view('admin/ruang_ujian/create', $data);
    }

    public function save()
    {
        //validasi input
        if (!$this->validate([
            'ruang_ujian' => [
                'rules' => 'required|is_unique[ruang_ujian.ruang_ujian]',
                'label' => 'Nama Ruang Ujian',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'is_unique' => '{field} sudah terdaftar.'
                ]
            ],
            'kapasitas' => [
                'rules' => 'required',
                'label' => 'Kapasitas',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        }

        try {
            $this->ruang_ujianModel->save([
                'ruang_ujian' => $this->request->getVar('ruang_ujian'),
                'kapasitas' => $this->request->getVar('kapasitas')
            ]);
            session()->setFlashdata('success', 'Data Berhasil Ditambahkan');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Data Gagal Ditambahkan');
        }

        return redirect()->to('/admin/ruang_ujian');
    }

    public function delete($id_ruang_ujian)
    {
        try {
            $this->ruang_ujianModel->delete($id_ruang_ujian);
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Data Berhasil Dihapus',
            ]);
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'Terjadi masalah dengan database saat menghapus data',
            ]);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function edit($id_ruang_ujian)
    {
        $data = [
            'title' => 'Edit Ruang Ujian',
            'ruang_ujian' => $this->ruang_ujianModel->find($id_ruang_ujian)
        ];

        return view('admin/ruang_ujian/edit', $data);
    }

    public function update($id_ruang_ujian)
    {
        //validasi input
        if (!$this->validate([
            'ruang_ujian' => [
                'rules' => 'required|is_unique[ruang_ujian.ruang_ujian,id_ruang_ujian,' . $id_ruang_ujian . ']',
                'label' => 'Nama Ruang Ujian',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'is_unique' => '{field} sudah terdaftar.'
                ]
            ],
            'kapasitas' => [
                'rules' => 'required',
                'label' => 'Kapasitas',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        }

        try {
            $this->ruang_ujianModel->save([
                'id_ruang_ujian' => $id_ruang_ujian,
                'ruang_ujian' => $this->request->getVar('ruang_ujian'),
                'kapasitas' => $this->request->getVar('kapasitas')
            ]);
            session()->setFlashdata('success', 'Data Berhasil Diubah');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Data Gagal Diubah');
        }

        return redirect()->to('/admin/ruang_ujian');
    }

    public function json($id = null)
    {
        $tanggal = $this->request->getVar('tanggal', null);
        $jam_mulai = $this->request->getVar('jam_mulai', null);
        $jam_selesai = $this->request->getVar('jam_selesai', null);
        $id_jadwal_ujian = $this->request->getVar('id_jadwal_ujian', null);
        if ($id) {
            // ruang_ujian yg belum digunakan di tanggal, jam_mulai, jam_selesai yg dipilih
            $ruang_ujian = $this->ruang_ujianModel->find($id);
        } elseif ($tanggal !== null && $jam_mulai !== null && $jam_selesai !== null && $id_jadwal_ujian !== null) {
            $ruang_ujian = $this->ruang_ujianModel->getRuanganTersediaEdit($tanggal, $jam_mulai, $jam_selesai, $id_jadwal_ujian);
        } else {
            // dd($this->request->getGet());
            if ($tanggal !== null && $jam_mulai !== null && $jam_selesai !== null) {
                // ruang_ujian berdasarkan tanggal, jam_mulai, jam_selesai
                $ruang_ujian = $this->ruang_ujianModel->getRuanganTersedia($tanggal, $jam_mulai, $jam_selesai);
            } else {
                // semua ruang_ujian
                $ruang_ujian = $this->ruang_ujianModel->findAll();
            }
        }
        return $this->response->setJSON($ruang_ujian);
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
        // dd($data);

        $db = \Config\Database::connect();

        try {
            $simpandata = [];
            $count = 0;
            foreach ($data as $x => $row) {
                if ($x != 0 && $row[0] != null) {
                    $ruang_ujian = $row[0];
                    $kapasitas = $row[1];

                    //skip ruang_ujian yang sama kaya yang di db
                    if ($this->ruang_ujianModel->where([
                        'ruang_ujian' => $ruang_ujian
                    ])->first()) {
                        continue;
                    }

                    $simpandata[] = [
                        'ruang_ujian' => $ruang_ujian,
                        'kapasitas' => $kapasitas
                    ];

                    $count++;
                }
            }

            if ($count > 0) {
                $db->table('ruang_ujian')->insertBatch($simpandata);
                session()->setFlashdata('success', 'Data Berhasil Diimport');
            } else {
                session()->setFlashdata('error', 'Tidak Ada Data yang Diimport');
            }
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Data Gagal Diimport');
        }

        return redirect()->to('/admin/ruang_ujian');
    }
}
