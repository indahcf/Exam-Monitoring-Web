<?php

namespace App\Controllers;

class TahunAkademik extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Data Tahun Akademik'
        ];
        return view('admin/tahun_akademik/index', $data);
    }
}
