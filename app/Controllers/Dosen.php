<?php

namespace App\Controllers;

use App\Models\DosenModel;
use App\Models\ProdiModel;

class Dosen extends BaseController
{
    protected $dosenModel;
    protected $prodiModel;
    public function __construct()
    {
        $this->dosenModel = new DosenModel();
        $this->prodiModel = new ProdiModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Mata Kuliah',
            'dosen' => $this->dosenModel->getDosen()
        ];

        return view('admin/dosen/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Mata Kuliah',
            'prodi' => $this->prodiModel->getProdi()
        ];

        return view('admin/dosen/create', $data);
    }

    public function save()
    {
        //validasi input
        if (!$this->validate([
            'nidn' => [
                'rules' => 'required|is_unique[dosen.nidn]',
                'label' => 'NIDN',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'is_unique' => '{field} sudah terdaftar.'
                ]
            ],
            'dosen' => [
                'rules' => 'required',
                'label' => 'Nama Dosen',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'prodi' => [
                'rules' => 'required',
                'label' => 'Nama Program Studi',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        }

        try {
            $this->dosenModel->save([
                'nidn' => $this->request->getVar('nidn'),
                'dosen' => $this->request->getVar('dosen'),
                'id_prodi' => $this->request->getVar('prodi')
            ]);
            session()->setFlashdata('success', 'Data Berhasil Ditambahkan');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Data Gagal Ditambahkan');
        }

        return redirect()->to('/admin/dosen');
    }

    public function delete($id_dosen)
    {
        try {
            $this->dosenModel->delete($id_dosen);
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

    public function edit($id_dosen)
    {
        $data = [
            'title' => 'Edit Program Studi',
            'dosen' => $this->dosenModel->getDosen($id_dosen),
            'prodi' => $this->prodiModel->findAll()
        ];

        return view('admin/dosen/edit', $data);
    }

    public function update($id_dosen)
    {
        //validasi input
        if (!$this->validate([
            'nidn' => [
                'rules' => 'required|is_unique[dosen.nidn]',
                'label' => 'NIDN',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'is_unique' => '{field} sudah terdaftar.'
                ]
            ],
            'dosen' => [
                'rules' => 'required',
                'label' => 'Nama Dosen',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'prodi' => [
                'rules' => 'required',
                'label' => 'Nama Program Studi',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
        ])) {
            return redirect()->back()->withInput();
        }

        try {
            $this->dosenModel->save([
                'id_dosen' => $id_dosen,
                'id_prodi' => $this->request->getVar('prodi'),
                'nidn' => $this->request->getVar('nidn'),
                'dosen' => $this->request->getVar('dosen')
            ]);
            session()->setFlashdata('success', 'Data Berhasil Diubah');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Data Gagal Diubah');
        }

        return redirect()->to('/admin/dosen');
    }
}
