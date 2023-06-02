<?php

namespace App\Controllers;

class SoalUjian extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Data Soal Ujian',
            // 'soal_ujian' => $this->soal_ujianModel->findAll()
        ];

        return view('admin/soal_ujian/index', $data);
    }
}
