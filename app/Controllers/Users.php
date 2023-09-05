<?php

namespace App\Controllers;

use Myth\Auth\Password;
use App\Models\UsersModel;
use App\Models\UserRoleModel;
use App\Models\RoleModel;
use App\Models\PencetakSoalModel;

class Users extends BaseController
{
    protected $usersModel;
    protected $user_role_model;
    protected $role_model;
    protected $pencetak_soalModel;

    public function __construct()
    {
        $this->usersModel = new UsersModel();
        $this->user_role_model = new UserRoleModel();
        $this->role_model = new RoleModel();
        $this->pencetak_soalModel = new PencetakSoalModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data User',
            'users' => $this->usersModel->getUser()
        ];
        // dd(user()->roles);
        return view('admin/user/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah User'
        ];

        return view('admin/user/create', $data);
    }

    public function save()
    {
        //validasi input
        if (!$this->validate([
            'fullname' => [
                'rules' => 'required',
                'label' => 'Nama User',
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
            ],
            'password'     => [
                'rules' => 'required',
                'label' => 'Password',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'pass_confirm'     => [
                'rules' => 'required|matches[password]',
                'label' => 'Repeat Password',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'matches' => '{field} harus sama'
                ]
            ],
            'role' => [
                'rules' => 'required',
                'label' => 'Role',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        }

        try {
            $password = $this->request->getVar('password');
            $this->usersModel->save([
                'fullname' => $this->request->getVar('fullname'),
                'email' => $this->request->getVar('email'),
                'role' => $this->request->getVar('role'),
                'password_hash' => Password::hash($password)
            ]);
            session()->setFlashdata('success', 'Data Berhasil Ditambahkan');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Data Gagal Ditambahkan');
        }

        return redirect()->to('/admin/user');
    }

    public function delete($id)
    {
        try {
            $this->usersModel->delete($id);
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

    public function edit($id)
    {
        $data = [
            'title' => 'Edit User',
            'users' => $this->usersModel->join('user_role', 'user_role.id_user=users.id')->where('id', $id)->get()->getRowArray(),
            'data_role' => $this->role_model->findAll(),
            'role'  => $this->user_role_model->getIdRoleByUserId($id)
        ];
        // dd($data['users']);
        return view('admin/user/edit', $data);
    }

    public function update($id)
    {
        //validasi input
        if (!$this->validate([
            'role' => [
                'rules' => 'required',
                'label' => 'Role',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        }

        try {
            // Langkah 1: Buat variabel untuk menyimpan peran lama
            $oldRoles = $this->user_role_model->where('id_user', $id)->findAll();
            $ambilRole = array_column($oldRoles, 'id_role');

            // Langkah 2: Perbarui data pengguna
            $this->user_role_model->where('id_user', $id)->delete();

            $roles = $this->request->getVar('role');
            foreach ($roles as $r) {
                $this->user_role_model->insert([
                    'id_user' => $id,
                    'id_role' => $r
                ]);
            }

            // Langkah 3: Periksa apakah peran lama memiliki peran "pencetak soal"
            $oldHasPencetakSoal = in_array(4, $ambilRole);

            // Langkah 4: Periksa apakah peran baru memiliki peran "pencetak soal"
            $newHasPencetakSoal = in_array(4, $roles);

            // Langkah 5: Jika peran lama memiliki "pencetak soal" dan peran baru tidak, hapus data pencetak soal
            if ($oldHasPencetakSoal && !$newHasPencetakSoal) {
                // Hapus data pencetak soal
                $this->pencetak_soalModel->where('id_user', $id)->delete();
            }

            session()->setFlashdata('success', 'Data Berhasil Diubah');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Data Gagal Diubah');
        }

        return redirect()->to('/admin/user');
    }

    public function ubah_password($id)
    {
        $data = [
            'title' => 'Ubah Password User',
            'users' => $this->usersModel->find($id)
        ];

        return view('admin/user/ubah_password', $data);
    }

    function update_password($id)
    {
        if (!$this->validate([
            'password_baru' => [
                'rules' => 'required',
                'label' => 'Password Baru',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'konfirmasi_password_baru' => [
                'rules' => 'required|matches[password_baru]',
                'label' => 'Konfirmasi Password Baru',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'matches' => '{field} harus sama dengan password baru'
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        }

        $request = $this->request;

        $this->usersModel->save([
            'id' => $id,
            'password_hash' => Password::hash($request->getVar('password_baru'))
        ]);
        session()->setFlashdata('success', 'Password Berhasil Diubah.');

        return redirect()->to('/admin/user');
    }
}
