<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class JadwalRuang extends Seeder
{
    public function run()
    {
        // membuat data
        $jadwal_ruang_data = [
            [
                'id_jadwal_ujian'    => 1,
                'id_ruang_ujian'     => 1
            ]
        ];

        foreach ($jadwal_ruang_data as $data) {
            // insert semua data ke tabel
            $this->db->table('jadwal_ruang')->insert($data);
        }
    }
}
