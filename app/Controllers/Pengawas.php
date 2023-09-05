<?php

namespace App\Controllers;

use App\Models\PengawasModel;
use App\Models\UsersModel;
use App\Models\UserRoleModel;
use Myth\Auth\Password;

class Pengawas extends BaseController
{
    protected $pengawasModel;
    protected $usersModel;
    protected $user_role_model;
    protected $db;

    public function __construct()
    {
        $this->pengawasModel = new PengawasModel();
        $this->usersModel = new UsersModel();
        $this->user_role_model = new UserRoleModel();
        $this->db = \Config\Database::connect();
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
            ],
            'email' => [
                'rules' => 'required|is_unique[users.email]|valid_email',
                'label' => 'Email',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'is_unique' => '{field} sudah terdaftar.',
                    'valid_email' => '{field} harus valid.'
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        }

        try {
            $this->usersModel->save([
                'email' => $this->request->getVar('email'),
                'password_hash' => Password::hash("adminsimonji")
            ]);
            $id_user = $this->db->insertID();

            $this->pengawasModel->save([
                'id_user' => $id_user,
                'nip' => $this->request->getVar('nip'),
                'pengawas' => $this->request->getVar('pengawas')
            ]);

            $this->user_role_model->save([
                'id_user' => $id_user,
                'id_role' => 5
            ]);

            session()->setFlashdata('success', 'Data Berhasil Ditambahkan');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Data Gagal Ditambahkan');
        }

        return redirect()->to('/admin/pengawas_ujian');
    }

    public function delete($id_pengawas)
    {
        try {
            // Ambil ID user terkait dari data pengawas yang akan dihapus
            $pengawas = $this->pengawasModel->find($id_pengawas);
            $id_user = $pengawas['id_user']; // Ganti 'id_user' dengan nama kolom yang sesuai

            // Hapus data pengawas
            // $this->pengawasModel->delete($id_pengawas);

            // Hapus data user dengan ID yang sama
            $this->usersModel->delete($id_user); // Ganti 'userModel' dengan model pengguna yang sesuai

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

    public function edit($id_pengawas)
    {
        $pengawas = $this->pengawasModel->join('users', 'users.id=pengawas.id_user')->where('pengawas.id_pengawas', $id_pengawas)->findAll();
        $data = [
            'title' => 'Edit Pengawas',
            'pengawas' => $this->pengawasModel->find($id_pengawas),
            'email' => $pengawas[0]['email']
        ];

        return view('admin/pengawas/edit', $data);
    }

    public function update($id_pengawas)
    {
        //validasi input
        if (!$this->validate([
            'nip' => [
                'rules' => 'required|is_unique[pengawas.nip,id_pengawas,' . $id_pengawas . ']',
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

        return redirect()->to('/admin/pengawas_ujian');
    }

    public function json($id = null)
    {
        $tanggal = $this->request->getVar('tanggal', null);
        $jam_mulai = $this->request->getVar('jam_mulai', null);
        $jam_selesai = $this->request->getVar('jam_selesai', null);
        $id_jadwal_ujian = $this->request->getVar('id_jadwal_ujian', null);
        if ($id) {
            // pengawas yg belum digunakan di tanggal, jam_mulai, jam_selesai yg dipilih
            $pengawas = $this->pengawasModel->find($id);
        } elseif ($tanggal !== null && $jam_mulai !== null && $jam_selesai !== null && $id_jadwal_ujian !== null) {
            $pengawas = $this->pengawasModel->getPengawasTersediaEdit($tanggal, $jam_mulai, $jam_selesai, $id_jadwal_ujian);
        } else {
            // dd($this->request->getGet());
            if ($tanggal !== null && $jam_mulai !== null && $jam_selesai !== null) {
                // pengawas berdasarkan tanggal, jam_mulai, jam_selesai
                // dd($this->pengawasModel->getPengawasTersedia($tanggal, $jam_mulai, $jam_selesai));
                $pengawas = $this->pengawasModel->getPengawasTersedia($tanggal, $jam_mulai, $jam_selesai);
            } else {
                // semua pengawas
                $pengawas = $this->pengawasModel->findAll();
            }
        }
        return $this->response->setJSON($pengawas);
    }
}
