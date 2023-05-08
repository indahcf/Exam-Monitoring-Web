<?php

namespace App\Controllers;

use Myth\Auth\Password;
use Myth\Auth\Models\UserModel;

class Users extends BaseController
{
    protected $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data User',
            'users' => $this->userModel->getUsers()
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
            $this->userModel->save([
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
            $this->userModel->delete($id);
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
            'users' => $this->userModel->getUsers($id)
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
            $this->userModel->save([
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
