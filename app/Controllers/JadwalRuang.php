<?php

namespace App\Controllers;

use App\Models\RuangUjianModel;
use App\Models\JadwalRuangModel;
use App\Models\JadwalUjianModel;

class JadwalUjian extends BaseController
{
    protected $jadwal_ruangModel;
    protected $jadwal_ujianModel;
    protected $ruang_ujianModel;

    public function __construct()
    {
        $this->jadwal_ruangModel = new JadwalRuangModel();
        $this->jadwal_ujianModel = new JadwalUjianModel();
        $this->ruang_ujianModel = new RuangUjianModel();
    }

    public function index()
    {
        dd($data = [
            'title' => 'Data Jadwal Ruang',
            'jadwal_ruang' => $this->jadwal_ruangModel->getJadwalRuang()
        ]);

        return view('admin/jadwal_ujian/index', $data);
    }
}
