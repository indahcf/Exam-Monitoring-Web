<?php

namespace App\Controllers;

use App\Models\DosenModel;
use App\Models\ProdiModel;
use App\Models\UsersModel;
use App\Models\UserRoleModel;
use Myth\Auth\Password;

class Dosen extends BaseController
{
    protected $dosenModel;
    protected $prodiModel;
    protected $usersModel;
    protected $user_role_model;
    protected $db;

    public function __construct()
    {
        $this->dosenModel = new DosenModel();
        $this->prodiModel = new ProdiModel();
        $this->usersModel = new UsersModel();
        $this->user_role_model = new UserRoleModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Dosen',
            'dosen' => $this->dosenModel->getDosen()
        ];

        return view('admin/dosen/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Dosen',
            'prodi' => $this->prodiModel->findAll()
        ];

        return view('admin/dosen/create', $data);
    }

    public function save()
    {
        //validasi input
        if (!$this->validate([
            'nidn' => [
                'rules' => 'required|is_unique[dosen.nidn]',
                'label' => 'NIDN',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'is_unique' => '{field} sudah terdaftar.'
                ]
            ],
            'dosen' => [
                'rules' => 'required',
                'label' => 'Nama Dosen',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'prodi' => [
                'rules' => 'required',
                'label' => 'Program Studi',
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

            $this->dosenModel->save([
                'id_user' => $id_user,
                'nidn' => $this->request->getVar('nidn'),
                'dosen' => $this->request->getVar('dosen'),
                'id_prodi' => $this->request->getVar('prodi')
            ]);

            $this->user_role_model->save([
                'id_user' => $id_user,
                'id_role' => 2
            ]);

            session()->setFlashdata('success', 'Data Berhasil Ditambahkan');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Data Gagal Ditambahkan');
        }

        return redirect()->to('/admin/dosen');
    }

    public function delete($id_dosen)
    {
        try {
            $this->dosenModel->delete($id_dosen);
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

    public function edit($id_dosen)
    {
        $data = [
            'title' => 'Edit Dosen',
            'dosen' => $this->dosenModel->find($id_dosen),
            'prodi' => $this->prodiModel->findAll()
        ];

        return view('admin/dosen/edit', $data);
    }

    public function update($id_dosen)
    {
        //validasi input
        if (!$this->validate([
            'nidn' => [
                'rules' => 'required|is_unique[dosen.nidn,id_dosen,' . $id_dosen . ']',
                'label' => 'NIDN',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'is_unique' => '{field} sudah terdaftar.'
                ]
            ],
            'dosen' => [
                'rules' => 'required',
                'label' => 'Nama Dosen',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
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
            $this->dosenModel->save([
                'id_dosen' => $id_dosen,
                'id_prodi' => $this->request->getVar('prodi'),
                'nidn' => $this->request->getVar('nidn'),
                'dosen' => $this->request->getVar('dosen')
            ]);
            session()->setFlashdata('success', 'Data Berhasil Diubah');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Data Gagal Diubah');
        }

        return redirect()->to('/admin/dosen');
    }

    public function json($id = null)
    {
        if ($id) {
            // dosen berdasarkan id_dosen
            $dosen = $this->dosenModel->find($id);
        } else {

            $id_prodi = $this->request->getVar('id_prodi', null);
            $id_kelas = $this->request->getVar('id_kelas', null);
            $id_matkul = $this->request->getVar('id_matkul', NULL);
            if ($id_prodi != null) {
                // dosen berdasarkan id_prodi
                $dosen = $this->dosenModel->where('id_prodi', $id_prodi)->findAll();
            } else if ($id_kelas != null) {
                // dosen berdasarkan id_kelas
                $dosen = $this->dosenModel->getDosenByKelas($id_kelas);
            } else if ($id_matkul != null) {
                // dosen berdasarkan id_matkul
                $dosen = $this->dosenModel->getDosenByMatkul($id_matkul);
            } else {
                // semua dosen 
                $dosen = $this->dosenModel->findAll();
            }
        }
        return $this->response->setJSON($dosen);
    }

    public function simpanExcel()
    {
        $validation = \Config\Services::validation();

        if (!$this->validate([
            'fileexcel' => [
                'rules' => 'uploaded[fileexcel]|max_size[fileexcel,2048]|ext_in[fileexcel,xls,xlsx]',
                'label' => 'File Excel',
                'errors' => [
                    'uploaded' => '{field} harus diisi.',
                    'max_size' => 'Ukuran file maksimal 2 MB.',
                    'ext_in' => 'Yang Anda pilih bukan file excel.'
                ]
            ]
        ])) {
            $message = [
                'error' => [
                    'fileexcel' => $validation->getError('fileexcel')
                ]
            ];
            return $this->response->setJSON($message);
        }

        $file_excel = $this->request->getFile('fileexcel');
        $ext = $file_excel->getClientExtension();
        if ($ext == 'xls') {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        } else {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }
        $spreadsheet = $render->load($file_excel);

        $data = $spreadsheet->getActiveSheet()->toArray();
        // dd($data);

        $db = \Config\Database::connect();

        try {
            $simpandata = [];
            $count = 0;
            foreach ($data as $x => $row) {
                if ($x != 0 && $row[0] != null) {
                    $id_prodi = $row[0];
                    $nidn = $row[1];
                    $dosen = $row[2];

                    //cek file excel kalo nidn nya ada yg sama kaya db + nidn baru
                    if ($this->dosenModel->where([
                        'nidn' => $nidn
                    ])->first()) {
                        continue;
                    }

                    $simpandata[] = [
                        'id_prodi' => $id_prodi,
                        'nidn' => $nidn,
                        'dosen' => $dosen
                    ];

                    $count++;
                }
            }

            if ($count > 0) {
                $db->table('dosen')->insertBatch($simpandata);
                session()->setFlashdata('success', 'Data Berhasil Diimport');
            } else {
                session()->setFlashdata('error', 'Tidak Ada Data yang Diimport');
            }
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Data Gagal Diimport');
        }

        return $this->response->setJSON(["success" => true]);
    }
}
