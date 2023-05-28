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
            'tahun' => [
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
            'status' => [
                'rules' => 'required',
                'label' => 'Status',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        }

        //cek tahun dan semester
        if ($this->tahun_akademikModel->where([
            'tahun' => $this->request->getVar('tahun'),
            'semester' => $this->request->getVar('semester')
        ])->first()) {
            return redirect()->back()->with('error', 'Data sudah terdaftar.')->withInput();
        }

        try {
            $this->tahun_akademikModel->save([
                'tahun' => $this->request->getVar('tahun'),
                'semester' => $this->request->getVar('semester'),
                'status' => $this->request->getVar('status')
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
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Data Gagal Dihapus',
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
            'tahun' => [
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
            'status' => [
                'rules' => 'required',
                'label' => 'Status',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        }

        //cek tahun dan semester
        if ($this->tahun_akademikModel->where([
            'tahun' => $this->request->getVar('tahun'),
            'semester' => $this->request->getVar('semester')
        ])->where('id_tahun_akademik !=', $id_tahun_akademik)->first()) {
            return redirect()->back()->with('error', 'Data sudah terdaftar.')->withInput();
        }

        try {
            $this->tahun_akademikModel->save([
                'id_tahun_akademik' => $id_tahun_akademik,
                'tahun' => $this->request->getVar('tahun'),
                'semester' => $this->request->getVar('semester'),
                'status' => $this->request->getVar('status')
            ]);
            session()->setFlashdata('success', 'Data Berhasil Diubah');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Data Gagal Diubah');
        }

        return redirect()->to('/admin/tahun_akademik');
    }
}
