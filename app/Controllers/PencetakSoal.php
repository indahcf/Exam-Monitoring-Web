<?php

namespace App\Controllers;

use App\Models\PencetakSoalModel;

class PencetakSoal extends BaseController
{
    protected $pencetak_soalModel;
    // protected $db;

    public function __construct()
    {
        $this->pencetak_soalModel = new PencetakSoalModel();
        // $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Pencetak Soal',
            'pencetak_soal' => $this->pencetak_soalModel->getPencetakSoal()
        ];

        return view('admin/pencetak_soal/index', $data);
    }
}
