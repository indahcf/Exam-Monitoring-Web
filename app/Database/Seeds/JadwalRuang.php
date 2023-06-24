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
                'id_ruang_ujian'     => 1,
                'jumlah_peserta'     => 15
            ],
            [
                'id_jadwal_ujian'    => 1,
                'id_ruang_ujian'     => 2,
                'jumlah_peserta'     => 30
            ],
            [
                'id_jadwal_ujian'    => 1,
                'id_ruang_ujian'     => 4,
                'jumlah_peserta'     => 13
            ]
        ];

        foreach ($jadwal_ruang_data as $data) {
            // insert semua data ke tabel
            $this->db->table('jadwal_ruang')->insert($data);
        }
    }
}
