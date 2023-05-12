<?php

namespace App\Controllers;

use App\Models\PengawasModel;

class Pengawas extends BaseController
{
    protected $pengawasModel;
    public function __construct()
    {
        $this->pengawasModel = new PengawasModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Pengawas',
            'pengawas' => $this->pengawasModel->getPengawas()
        ];

        return view('admin/pengawas/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Pengawas'
        ];

        return view('admin/pengawas/create', $data);
    }

    public function save()
    {
        //validasi input
        if (!$this->validate([
            'nip' => [
                'rules' => 'required|is_unique[pengawas.nip]',
                'label' => 'NIP',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'is_unique' => '{field} sudah terdaftar.'
                ]
            ],
            'pengawas' => [
                'rules' => 'required',
                'label' => 'Nama Pengawas',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        }

        try {
            $this->pengawasModel->save([
                'nip' => $this->request->getVar('nip'),
                'pengawas' => $this->request->getVar('pengawas')
            ]);
            session()->setFlashdata('success', 'Data Berhasil Ditambahkan');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Data Gagal Ditambahkan');
        }

        return redirect()->to('/admin/pengawas');
    }

    public function delete($id_pengawas)
    {
        try {
            $this->pengawasModel->delete($id_pengawas);
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

    public function edit($id_pengawas)
    {
        $data = [
            'title' => 'Edit Pengawas',
            'pengawas' => $this->pengawasModel->getPengawas($id_pengawas)
        ];

        return view('admin/pengawas/edit', $data);
    }

    public function update($id_pengawas)
    {
        //validasi input
        if (!$this->validate([
            'nip' => [
                'rules' => 'required|is_unique[pengawas.nip,id_pengawas,{id_pengawas}]',
                'label' => 'NIP',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'is_unique' => '{field} sudah terdaftar.'
                ]
            ],
            'pengawas' => [
                'rules' => 'required',
                'label' => 'Nama Pengawas',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        }

        try {
            $this->pengawasModel->save([
                'id_pengawas' => $id_pengawas,
                'nip' => $this->request->getVar('nip'),
                'pengawas' => $this->request->getVar('pengawas')
            ]);
            session()->setFlashdata('success', 'Data Berhasil Diubah');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Data Gagal Diubah');
        }

        return redirect()->to('/admin/pengawas');
    }
}
