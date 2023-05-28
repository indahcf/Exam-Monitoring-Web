<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Prodi extends Seeder
{
    public function run()
    {
        // membuat data
        $prodi_data = [
            [
                'prodi' => 'Teknik Elektro'
            ],
            [
                'prodi' => 'Teknik Sipil'
            ],
            [
                'prodi' => 'Teknik Geologi'
            ],
            [
                'prodi' => 'Informatika'
            ]
        ];

        foreach ($prodi_data as $data) {
            // insert semua data ke tabel
            $this->db->table('prodi')->insert($data);
        }
    }
}
