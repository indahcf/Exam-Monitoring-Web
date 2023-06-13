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
                'tahun_akademik'    => '2022/2023',
                'semester'          => 'Gasal',
                'status'            => 1
            ],
            [
                'tahun_akademik'    => '2022/2023',
                'semester'          => 'Genap'
            ]
        ];

        foreach ($tahun_akademik_data as $data) {
            // insert semua data ke tabel
            $this->db->table('tahun_akademik')->insert($data);
        }
    }
}
