<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Matkul extends Seeder
{
    public function run()
    {
        // membuat data
        $matkul_data = [
            [
                'id_prodi'      => 1,
                'kode_matkul'   => 'TKE191111',
                'matkul'        => 'Matematika',
                'jumlah_sks'    => 3,
                'semester'      => 'Gasal'
            ],
            [
                'id_prodi'      => 2,
                'kode_matkul'   => 'INF191111',
                'matkul'        => 'Logika Informatika',
                'jumlah_sks'    => 3,
                'semester'      => 'Gasal'
            ]
        ];

        foreach ($matkul_data as $data) {
            // insert semua data ke tabel
            $this->db->table('matkul')->insert($data);
        }
    }
}
