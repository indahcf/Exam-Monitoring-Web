<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Pengawas extends Seeder
{
    public function run()
    {
        //membuat data
        $pengawas_data = [
            [
                'id_user' => 7,
                'nip' => '198900100200300405',
                'pengawas'  => 'Yulianto'
            ],
            [
                'id_user' => 8,
                'nip' => '198800200300400506',
                'pengawas'  => 'Teguh Narwoko, S.T.'
            ],
            [
                'id_user' => 1,
                'nip' => '198700300400500607',
                'pengawas'  => 'Subekti Afrianto, A.Md.'
            ],
            [
                'id_user' => 4,
                'nip' => '198600400500600708',
                'pengawas'  => 'Gilang Dwi Ratmana'
            ],
            [
                'id_user' => 5,
                'nip' => '198500500600700809',
                'pengawas'  => 'Hera'
            ],
            [
                'id_user' => 9,
                'nip' => '198400600700800910',
                'pengawas'  => 'Maruf Setiawan'
            ],
            [
                'id_user' => 10,
                'nip' => '198300700800901011',
                'pengawas'  => 'Asjik Setyawan, S.T'
            ],
            [
                'id_user' => 11,
                'nip' => '198200800901001112',
                'pengawas'  => 'Kuswanto'
            ]
        ];

        foreach ($pengawas_data as $data) {
            // insert semua data ke tabel
            $this->db->table('pengawas')->insert($data);
        }
    }
}
