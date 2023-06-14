<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SoalKelas extends Seeder
{
    public function run()
    {
        // membuat data
        $soal_kelas_data = [
            [
                'id_soal_ujian'    => 1,
                'id_kelas'         => 1
            ]
        ];

        foreach ($soal_kelas_data as $data) {
            // insert semua data ke tabel
            $this->db->table('soal_kelas')->insert($data);
        }
    }
}
