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
                'id_user'       => 2,
                'id_prodi'      => 1,
                'nidn'          => '0016047606',
                'dosen'         => 'Irham',
            ],
            [
                'id_user'       => 3,
                'id_prodi'      => 3,
                'nidn'          => '0016047602',
                'dosen'         => 'Lasmedi Afuan'
            ],
            [
                'id_user'       => 6,
                'id_prodi'      => 3,
                'nidn'          => '0019088104',
                'dosen'         => 'Yogiek Indra Kurniawan'
            ]

        ];

        foreach ($dosen_data as $data) {
            // insert semua data ke tabel
            $this->db->table('dosen')->insert($data);
        }
    }
}
