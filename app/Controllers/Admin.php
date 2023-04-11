<?php

namespace App\Controllers;

class Admin extends BaseController
{
    public function user()
    {
        $data = [
            'title' => 'Data User'
        ];
        return view('admin/user/index', $data);
    }

    public function tahun_akademik()
    {
        $data = [
            'title' => 'Data Tahun Akademik'
        ];
        return view('admin/tahun_akademik/index', $data);
    }

    public function matkul()
    {
        $data = [
            'title' => 'Data Mata Kuliah'
        ];
        return view('admin/matkul/index', $data);
    }

    public function prodi()
    {
        $data = [
            'title' => 'Data Program Studi'
        ];
        return view('admin/prodi/index', $data);
    }

    public function dosen()
    {
        $data = [
            'title' => 'Data Dosen'
        ];
        return view('admin/dosen/index', $data);
    }

    public function kelas()
    {
        $data = [
            'title' => 'Data Kelas'
        ];
        return view('admin/kelas/index', $data);
    }

    public function ruang_ujian()
    {
        $data = [
            'title' => 'Data Ruang Ujian'
        ];
        return view('admin/ruang_ujian/index', $data);
    }

    public function pengawas()
    {
        $data = [
            'title' => 'Data Pengawas'
        ];
        return view('admin/pengawas/index', $data);
    }

    public function jadwal_ujian()
    {
        $data = [
            'title' => 'Data Jadwal Ujian'
        ];
        return view('admin/jadwal_ujian/index', $data);
    }

    public function soal_ujian()
    {
        $data = [
            'title' => 'Data Soal Ujian'
        ];
        return view('admin/soal_ujian/index', $data);
    }
}
