<?php

namespace App\Controllers;

use App\Models\MatkulModel;
use App\Models\ProdiModel;

class Matkul extends BaseController
{
    protected $matkulModel;
    public function __construct()
    {
        $this->matkulModel = new MatkulModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Mata Kuliah',
            'matkul' => $this->matkulModel->getMatkul()
        ];

        return view('admin/matkul/index', $data);
    }
}
