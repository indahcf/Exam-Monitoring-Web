<?php

namespace App\Controllers;

use App\Models\MatkulModel;
use App\Models\ProdiModel;

class Matkul extends BaseController
{
    protected $matkulModel;
    protected $prodiModel;
    public function __construct()
    {
        $this->matkulModel = new MatkulModel();
        $this->prodiModel = new ProdiModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Mata Kuliah',
            'matkul' => $this->matkulModel->getMatkul()
        ];

        return view('admin/matkul/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Mata Kuliah',
            'prodi' => $this->prodiModel->findAll()
        ];

        return view('admin/matkul/create', $data);
    }

    public function save()
    {
        //validasi input
        if (!$this->validate([
            'kode_matkul' => [
                'rules' => 'required',
                'label' => 'Kode Mata Kuliah',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'matkul' => [
                'rules' => 'required',
                'label' => 'Nama Mata Kuliah',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'jumlah_sks' => [
                'rules' => 'required',
                'label' => 'Jumlah SKS',
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

        //cek matkul dan prodi
        if ($this->matkulModel->where([
            'matkul' => $this->request->getVar('matkul'),
            'id_prodi' => $this->request->getVar('prodi')
        ])->first()) {
            return redirect()->back()->with('error', 'Data sudah terdaftar.')->withInput();
        }

        try {
            $this->matkulModel->save([
                'kode_matkul' => $this->request->getVar('kode_matkul'),
                'matkul' => $this->request->getVar('matkul'),
                'jumlah_sks' => $this->request->getVar('jumlah_sks'),
                'semester' => $this->request->getVar('semester'),
                'id_prodi' => $this->request->getVar('prodi')
            ]);
            session()->setFlashdata('success', 'Data Berhasil Ditambahkan');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Data Gagal Ditambahkan');
        }

        return redirect()->to('/admin/matkul');
    }

    public function delete($id_matkul)
    {
        try {
            $this->matkulModel->delete($id_matkul);
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

    public function edit($id_matkul)
    {
        $data = [
            'title' => 'Edit Mata Kuliah',
            'matkul' => $this->matkulModel->find($id_matkul),
            'prodi' => $this->prodiModel->findAll()
        ];

        return view('admin/matkul/edit', $data);
    }

    public function update($id_matkul)
    {
        //validasi input
        if (!$this->validate([
            'kode_matkul' => [
                'rules' => 'required',
                'label' => 'Kode Mata Kuliah',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'matkul' => [
                'rules' => 'required',
                'label' => 'Nama Mata Kuliah',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'jumlah_sks' => [
                'rules' => 'required',
                'label' => 'Jumlah SKS',
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

        //cek matkul dan prodi
        if ($this->matkulModel->where([
            'matkul' => $this->request->getVar('matkul'),
            'id_prodi' => $this->request->getVar('prodi'),
            'id_matkul !=' => $id_matkul
        ])->first()) {
            return redirect()->back()->with('error', 'Data sudah terdaftar.')->withInput();
        }

        try {
            $this->matkulModel->save([
                'id_matkul' => $id_matkul,
                'id_prodi' => $this->request->getVar('prodi'),
                'kode_matkul' => $this->request->getVar('kode_matkul'),
                'matkul' => $this->request->getVar('matkul'),
                'jumlah_sks' => $this->request->getVar('jumlah_sks'),
                'semester' => $this->request->getVar('semester')
            ]);
            session()->setFlashdata('success', 'Data Berhasil Diubah');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Data Gagal Diubah');
        }

        return redirect()->to('/admin/matkul');
    }


    public function json($id = null)
    {
        if ($id) {
            // matkul berdasarkan id_matkul
            $matkul = $this->matkulModel->find($id);
        } else {
            $id_prodi = $this->request->getVar('id_prodi', null);
            if ($id_prodi !== null) {
                // matkul berdasarkan id_prodi
                $matkul = $this->matkulModel->where('id_prodi', $id_prodi)->findAll();
            } else {
                // semua matkul 
                $matkul = $this->matkulModel->findAll();
            }
        }
        return $this->response->setJSON($matkul);
    }
}
