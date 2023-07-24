<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class JadwalPengawas extends Seeder
{
    public function run()
    {
        // membuat data
        $jadwal_pengawas_data = [
            [
                'id_jadwal_ruang'    => 1,
                'id_pengawas'     => 1
            ],
            [
                'id_jadwal_ruang'    => 2,
                'id_pengawas'     => 2
            ],
            [
                'id_jadwal_ruang'    => 2,
                'id_pengawas'     => 3
            ],
            [
                'id_jadwal_ruang'    => 3,
                'id_pengawas'     => 4
            ],
            [
                'id_jadwal_ruang'    => 4,
                'id_pengawas'     => 5
            ],
            [
                'id_jadwal_ruang'    => 5,
                'id_pengawas'     => 6
            ],
            [
                'id_jadwal_ruang'    => 6,
                'id_pengawas'     => 7
            ],
            [
                'id_jadwal_ruang'    => 7,
                'id_pengawas'     => 8
            ]
        ];

        foreach ($jadwal_pengawas_data as $data) {
            // insert semua data ke tabel
            $this->db->table('jadwal_pengawas')->insert($data);
        }
    }
}
