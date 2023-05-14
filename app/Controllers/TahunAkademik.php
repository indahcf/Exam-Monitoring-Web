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
            'tahun_akademik' => $this->tahun_akademikModel->getTahunAkademik()
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
            'aktif' => [
                'rules' => 'required',
                'label' => 'Aktif',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        }

        try {
            $this->tahun_akademikModel->save([
                'tahun' => $this->request->getVar('tahun'),
                'semester' => $this->request->getVar('semester'),
                'aktif' => $this->request->getVar('aktif')
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
            'tahun_akademik' => $this->tahun_akademikModel->getTahunAkademik($id_tahun_akademik)
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
            'aktif' => [
                'rules' => 'required',
                'label' => 'Aktif',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        }

        try {
            $this->tahun_akademikModel->save([
                'id_tahun_akademik' => $id_tahun_akademik,
                'tahun' => $this->request->getVar('tahun'),
                'semester' => $this->request->getVar('semester'),
                'aktif' => $this->request->getVar('aktif')
            ]);
            session()->setFlashdata('success', 'Data Berhasil Diubah');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Data Gagal Diubah');
        }

        return redirect()->to('/admin/tahun_akademik');
    }
}
