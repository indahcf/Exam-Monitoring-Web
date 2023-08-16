<?php

namespace App\Controllers;

use App\Models\UsersModel;
use Myth\Auth\Models\UserModel as MythModel;

class Setting extends BaseController
{
    protected $usersModel;
    protected $userModel;

    public function __construct()
    {
        $this->usersModel = new UsersModel();
        $this->userModel = new MythModel();
    }

    public function ubah_password()
    {
        $data = [
            'title' => 'Ubah Password'
        ];

        return view('setting/ubah_password', $data);
    }

    function update_password()
    {
        if (!$this->validate([
            'password_lama' => [
                'rules' => 'required',
                'label' => 'Password Lama',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],

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

        $id = user_id();
        $rowData = $this->userModel->find($id);
        $passwordUser = $rowData->password_hash;
        $request = $this->request;

        if (password_verify(base64_encode(hash('sha384', service('request')->getVar('password_lama'), true)), $passwordUser)) {
            $rowData->setPassword($request->getVar('password_baru'));
            $this->userModel->save($rowData);
            session()->setFlashdata('success', 'Password Berhasil Diubah.');
        } else {
            session()->setFlashdata('error', 'Password Yang Anda Masukan Salah!');
        }

        return redirect()->to('/');
    }
}
