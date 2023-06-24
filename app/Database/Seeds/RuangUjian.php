<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RuangUjian extends Seeder
{
    public function run()
    {
        //membuat data
        $ruang_ujian_data = [
            [
                'ruang_ujian' => 'A.101',
                'kapasitas'   => 15
            ],
            [
                'ruang_ujian' => 'A.201',
                'kapasitas'   => 30
            ],
            [
                'ruang_ujian' => 'A.202',
                'kapasitas'   => 12
            ],
            [
                'ruang_ujian' => 'C.203',
                'kapasitas'   => 20
            ],
            [
                'ruang_ujian' => 'E.101',
                'kapasitas'   => 25
            ],
            [
                'ruang_ujian' => 'E.102',
                'kapasitas'   => 45
            ]
        ];

        foreach ($ruang_ujian_data as $data) {
            // insert semua data ke tabel
            $this->db->table('ruang_ujian')->insert($data);
        }
    }
}
