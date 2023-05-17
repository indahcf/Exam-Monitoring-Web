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
            'matkul'    => $this->matkulModel->getMatkul(),
            'dosen'     => $this->dosenModel->getDosen(),
            'prodi'     => $this->prodiModel->getProdi()
        ];

        return view('admin/kelas/create', $data);
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
        } elseif ($this->matkulModel->where([
            'matkul' => $this->request->getVar('matkul'),
            'kode_matkul !=' => $this->request->getVar('kode_matkul')
        ])->first()) {
            return redirect()->back()->with('error', 'Kode mata kuliah berbeda dengan kode mata kuliah yang sudah ditambahkan.')->withInput();
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
            'matkul' => $this->matkulModel->getMatkul($id_matkul),
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
            ],
        ])) {
            return redirect()->back()->withInput();
        }

        //cek matkul dan prodi
        if ($this->matkulModel->where([
            'matkul' => $this->request->getVar('matkul'),
            'id_prodi' => $this->request->getVar('prodi')
        ])->first()) {
            return redirect()->back()->with('error', 'Data sudah terdaftar.')->withInput();
        } elseif ($this->matkulModel->where([
            'matkul' => $this->request->getVar('matkul'),
            'kode_matkul !=' => $this->request->getVar('kode_matkul')
        ])->first()) {
            return redirect()->back()->with('error', 'Kode mata kuliah berbeda dengan kode mata kuliah yang sudah ditambahkan.')->withInput();
        }

        // //cek matkul dan prodi
        // if ($this->matkulModel->where([
        //     'matkul' => $this->request->getVar('matkul'),
        //     'id_prodi' => $this->request->getVar('prodi'),
        //     'id_matkul !=' => $id_matkul
        // ])->first()) {
        //     return redirect()->back()->with('error', 'Data sudah terdaftar.')->withInput();
        // }

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
}
