<?php

namespace App\Controllers;

use Myth\Auth\Password;
use App\Models\UsersModel;

class Users extends BaseController
{
    protected $usersModel;
    public function __construct()
    {
        $this->usersModel = new UsersModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data User',
            'users' => $this->usersModel->getUsers()
        ];

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
            'users' => $this->usersModel->find($id)
        ];

        return view('admin/user/edit', $data);
    }

    public function update($id)
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
            $this->usersModel->save([
                'id' => $id,
                'fullname' => $this->request->getVar('fullname'),
                'email' => $this->request->getVar('email'),
                'role' => $this->request->getVar('role')
            ]);
            session()->setFlashdata('success', 'Data Berhasil Diubah');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Data Gagal Diubah');
        }

        return redirect()->to('/admin/user');
    }
}
