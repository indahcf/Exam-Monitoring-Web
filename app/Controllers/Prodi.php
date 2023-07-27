<?php

namespace App\Controllers;

use App\Models\ProdiModel;

class Prodi extends BaseController
{
    protected $prodiModel;
    public function __construct()
    {
        $this->prodiModel = new ProdiModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Program Studi',
            'prodi' => $this->prodiModel->findAll()
        ];

        return view('admin/prodi/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Program Studi'
        ];

        return view('admin/prodi/create', $data);
    }

    public function save()
    {
        //validasi input
        if (!$this->validate([
            'prodi' => [
                'rules' => 'required|is_unique[prodi.prodi]',
                'label' => 'Nama Program Studi',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'is_unique' => '{field} sudah terdaftar.'
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        }

        try {
            $this->prodiModel->save([
                'prodi' => $this->request->getVar('prodi')
            ]);
            session()->setFlashdata('success', 'Data Berhasil Ditambahkan');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Data Gagal Ditambahkan');
        }

        return redirect()->to('/admin/prodi');
    }

    public function delete($id_prodi)
    {
        try {
            $this->prodiModel->delete($id_prodi);
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

    public function edit($id_prodi)
    {
        $data = [
            'title' => 'Edit Program Studi',
            'prodi' => $this->prodiModel->find($id_prodi)
        ];

        return view('admin/prodi/edit', $data);
    }

    public function update($id_prodi)
    {
        //validasi input
        if (!$this->validate([
            'prodi' => [
                'rules' => 'required|is_unique[prodi.prodi,id_prodi,' . $id_prodi . ']',
                'label' => 'Nama Program Studi',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'is_unique' => '{field} sudah terdaftar.'
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        }

        try {
            $this->prodiModel->save([
                'id_prodi' => $id_prodi,
                'prodi' => $this->request->getVar('prodi')
            ]);
            session()->setFlashdata('success', 'Data Berhasil Diubah');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Data Gagal Diubah');
        }

        return redirect()->to('/admin/prodi');
    }
}
