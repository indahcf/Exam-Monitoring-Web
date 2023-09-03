<?php

namespace App\Controllers;

use App\Models\PencetakSoalModel;
use App\Models\ProdiModel;
use App\Models\UsersModel;

class PencetakSoal extends BaseController
{
    protected $pencetak_soalModel;
    protected $prodiModel;
    protected $usersModel;
    // protected $db;

    public function __construct()
    {
        $this->pencetak_soalModel = new PencetakSoalModel();
        $this->prodiModel = new ProdiModel();
        $this->usersModel = new UsersModel();
        // $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Pencetak Soal',
            'pencetak_soal' => $this->pencetak_soalModel->getPencetakSoal()
        ];
        // dd($data['pencetak_soal']);
        return view('admin/pencetak_soal/index', $data);
    }

    public function create()
    {
        $pencetak_soal = $this->usersModel->join('pengawas', 'pengawas.id_user=users.id')->join('user_role', 'users.id=user_role.id_user')->where('user_role.id_role', 4)->get()->getResultArray();
        $data = [
            'title' => 'Tambah Pencetak Soal',
            'pencetak_soal' => $pencetak_soal,
            'prodi' => $this->prodiModel->findAll()
        ];
        // dd($data['pencetak_soal']);
        return view('admin/pencetak_soal/create', $data);
    }

    public function save()
    {
        //validasi input
        if (!$this->validate([
            'pencetak_soal' => [
                'rules' => 'required|is_unique[pencetak_soal.id_user]',
                'label' => 'Pencetak Soal',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'is_unique' => '{field} sudah terdaftar.'
                ]
            ],
            'prodi' => [
                'rules' => 'required',
                'label' => 'Program Studi',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        }

        try {
            $prodi = $this->request->getVar('prodi');
            foreach ($prodi as $p) {
                $this->pencetak_soalModel->save([
                    'id_user' => $this->request->getVar('pencetak_soal'),
                    'id_prodi' => $p
                ]);
            }

            session()->setFlashdata('success', 'Data Berhasil Ditambahkan');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Data Gagal Ditambahkan');
        }

        return redirect()->to('/admin/pencetak_soal');
    }

    public function delete($id_user)
    {
        try {
            $this->pencetak_soalModel->where('pencetak_soal.id_user', $id_user)->delete();
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

    public function edit($id_user)
    {
        $pencetak_soal = $this->pencetak_soalModel->join('users', 'users.id=pencetak_soal.id_user')->join('pengawas', 'pengawas.id_user=users.id')
            ->join('user_role', 'users.id=user_role.id_user')
            ->where('user_role.id_role', 4)
            ->where('user_role.id_user', $id_user)
            ->get()
            ->getRowArray();

        $prodi_pencetak = $this->pencetak_soalModel->where('pencetak_soal.id_user', $id_user)->findAll();

        $data = [
            'title' => 'Edit Pencetak Soal',
            'pencetak_soal' => $pencetak_soal,
            'prodi' => $this->prodiModel->findAll(),
            'prodi_pencetak' => array_column($prodi_pencetak, 'id_prodi')
        ];
        // dd($data);
        return view('admin/pencetak_soal/edit', $data);
    }

    public function update($id_user)
    {
        // dd($this->request->getPost());
        //validasi input
        if (!$this->validate([
            // 'pencetak_soal' => [
            //     'rules' => 'required|is_unique[pencetak_soal.id_user,id_pencetak_soal,' . $id_pencetak_soal . ']',
            //     'label' => 'Pencetak Soal',
            //     'errors' => [
            //         'required' => '{field} harus diisi.',
            //         'is_unique' => '{field} sudah terdaftar.'
            //     ]
            // ],
            'prodi' => [
                'rules' => 'required',
                'label' => 'Program Studi',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
        ])) {
            return redirect()->back()->withInput();
        }

        try {
            $this->pencetak_soalModel->save([
                'id_pencetak_soal' => $id_user,
                // 'id_user' => $this->request->getVar('pencetak_soal'),
                'id_prodi' => $this->request->getVar('prodi')
            ]);
            session()->setFlashdata('success', 'Data Berhasil Diubah');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Data Gagal Diubah');
        }

        return redirect()->to('/admin/pencetak_soal');
    }
}
