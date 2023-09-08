<?php

namespace App\Controllers;

use App\Models\TahunAkademikModel;

class TahunAkademik extends BaseController
{
    protected $tahun_akademikModel;
    public function __construct()
    {
        $this->tahun_akademikModel = new TahunAkademikModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Tahun Akademik',
            'tahun_akademik' => $this->tahun_akademikModel->findAll()
        ];

        return view('admin/tahun_akademik/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Tahun Akademik'
        ];

        return view('admin/tahun_akademik/create', $data);
    }

    public function save()
    {
        //validasi input
        if (!$this->validate([
            'tahun_akademik' => [
                'rules' => 'required',
                'label' => 'Tahun Akademik',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'semester' => [
                'rules' => 'required',
                'label' => 'Semester',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'periode_ujian' => [
                'rules' => 'required',
                'label' => 'Periode Ujian',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        }

        //cek tahun akademik, semester, periode ujian tidak boleh ada yg sama
        if ($this->tahun_akademikModel->where([
            'tahun_akademik' => $this->request->getVar('tahun_akademik'),
            'semester' => $this->request->getVar('semester'),
            'periode_ujian' => $this->request->getVar('periode_ujian')
        ])->first()) {
            return redirect()->back()->with('error', 'Data sudah terdaftar.')->withInput();
        }

        try {
            $this->tahun_akademikModel->save([
                'tahun_akademik' => $this->request->getVar('tahun_akademik'),
                'semester' => $this->request->getVar('semester'),
                'periode_ujian' => $this->request->getVar('periode_ujian')
            ]);
            session()->setFlashdata('success', 'Data Berhasil Ditambahkan');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Data Gagal Ditambahkan');
        }

        return redirect()->to('/admin/tahun_akademik');
    }

    public function delete($id_tahun_akademik)
    {
        try {
            $this->tahun_akademikModel->delete($id_tahun_akademik);
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

    public function edit($id_tahun_akademik)
    {
        $data = [
            'title' => 'Edit Program Studi',
            'tahun_akademik' => $this->tahun_akademikModel->find($id_tahun_akademik)
        ];

        return view('admin/tahun_akademik/edit', $data);
    }

    public function update($id_tahun_akademik)
    {
        //validasi input
        if (!$this->validate([
            'tahun_akademik' => [
                'rules' => 'required',
                'label' => 'Tahun Akademik',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'semester' => [
                'rules' => 'required',
                'label' => 'Semester',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'periode_ujian' => [
                'rules' => 'required',
                'label' => 'Periode Ujian',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        }

        //cek tahun akademik, semester, periode ujian tidak boleh ada yg sama
        if ($this->tahun_akademikModel->where([
            'tahun_akademik' => $this->request->getVar('tahun_akademik'),
            'semester' => $this->request->getVar('semester'),
            'periode_ujian' => $this->request->getVar('periode_ujian')
        ])->where('id_tahun_akademik !=', $id_tahun_akademik)->first()) {
            return redirect()->back()->with('error', 'Data sudah terdaftar.')->withInput();
        }

        try {
            $this->tahun_akademikModel->save([
                'id_tahun_akademik' => $id_tahun_akademik,
                'tahun_akademik' => $this->request->getVar('tahun_akademik'),
                'semester' => $this->request->getVar('semester'),
                'periode_ujian' => $this->request->getVar('periode_ujian')
            ]);
            session()->setFlashdata('success', 'Data Berhasil Diubah');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Data Gagal Diubah');
        }

        return redirect()->to('/admin/tahun_akademik');
    }

    public function update_status($id)
    {
        try {
            $this->tahun_akademikModel->setAktif($id);
            return $this->response->setJson(['success' => true, 'message' => 'Berhasil Diaktifkan!']);
        } catch (\Exception $e) {
            return $this->response->setJson(['success' => true, 'message' => $e->getMessage()]);
        }
    }
}
