<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class JadwalUjian extends Seeder
{
    public function run()
    {
        // membuat data
        $jadwal_ujian_data = [
            [
                'id_kelas'           => 1,
                'id_tahun_akademik'  => 1,
                'koordinator_ujian'  => 1,
                'tanggal'            => '2023-05-25',
                'jam_mulai'          => '07:30',
                'jam_selesai'        => '10:00'
            ],
            [
                'id_kelas'           => 2,
                'id_tahun_akademik'  => 1,
                'koordinator_ujian'  => 3,
                'tanggal'            => '2023-06-19',
                'jam_mulai'          => '07:30',
                'jam_selesai'        => '10:30'
            ],
            [
                'id_kelas'           => 3,
                'id_tahun_akademik'  => 1,
                'koordinator_ujian'  => 1,
                'tanggal'            => '2023-06-20',
                'jam_mulai'          => '07:00',
                'jam_selesai'        => '09:00'
            ]
        ];

        foreach ($jadwal_ujian_data as $data) {
            // insert semua data ke tabel
            $this->db->table('jadwal_ujian')->insert($data);
        }
    }
}
