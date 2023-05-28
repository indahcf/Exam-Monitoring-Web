<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TahunAkademik extends Seeder
{
    public function run()
    {
        // membuat data
        $tahun_akademik_data = [
            [
                'tahun'     => '2022/2023',
                'semester'  => 'Gasal',
                'status'     => 0,
            ],
            [
                'tahun'     => '2022/2023',
                'semester'  => 'Genap',
                'status'     => 1
            ]
        ];

        foreach ($tahun_akademik_data as $data) {
            // insert semua data ke tabel
            $this->db->table('tahun_akademik')->insert($data);
        }
    }
}
