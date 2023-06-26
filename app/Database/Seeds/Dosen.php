<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Dosen extends Seeder
{
    public function run()
    {
        // membuat data
        $dosen_data = [
            [
                'id_prodi'      => 1,
                'nidn'          => '0016047606',
                'dosen'         => 'Widhiatmoko Herry Purnomo'
            ],
            [
                'id_prodi'      => 3,
                'nidn'          => '0016047602',
                'dosen'         => 'Bangun Wijayanto'
            ],
            [
                'id_prodi'      => 3,
                'nidn'          => '0019088104',
                'dosen'         => 'Nofiyati'
            ]

        ];

        foreach ($dosen_data as $data) {
            // insert semua data ke tabel
            $this->db->table('dosen')->insert($data);
        }
    }
}
