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
                'matkul'        => 'Matematika'
            ],
            [
                'id_prodi'      => 3,
                'kode_matkul'   => 'INF191111',
                'matkul'        => 'Logika Informatika'
            ],
            [
                'id_prodi'      => 3,
                'kode_matkul'   => 'INF191112',
                'matkul'        => 'Matematika Dasar'
            ],
            [
                'id_prodi'      => 3,
                'kode_matkul'   => 'INF191113',
                'matkul'        => 'Struktur Data'
            ]
        ];

        foreach ($matkul_data as $data) {
            // insert semua data ke tabel
            $this->db->table('matkul')->insert($data);
        }
    }
}
