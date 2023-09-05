<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Kelas extends Seeder
{
    public function run()
    {
        // membuat data
        $kelas_data = [
            [
                'id_matkul'         => 1,
                'id_dosen'          => 1,
                'kelas'             => 'A',
                'jumlah_mahasiswa'  => 58
            ],
            [
                'id_matkul'         => 2,
                'id_dosen'          => 2,
                'kelas'             => 'A',
                'jumlah_mahasiswa'  => 30
            ],
            [
                'id_matkul'         => 2,
                'id_dosen'          => 3,
                'kelas'             => 'B',
                'jumlah_mahasiswa'  => 20
            ],
            [
                'id_matkul'         => 3,
                'id_dosen'          => 3,
                'kelas'             => 'A',
                'jumlah_mahasiswa'  => 30
            ]
        ];

        foreach ($kelas_data as $data) {
            // insert semua data ke tabel
            $this->db->table('kelas')->insert($data);
        }
    }
}
