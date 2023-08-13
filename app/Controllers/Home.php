<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard'
        ];
        // dd(user()->roles);
        // dd(count(array_intersect(user()->roles, ['Pengawas', 'Dosen'])) > 0);
        // dd(user()->roles);
        return view('dashboard/index', $data);
    }
}
