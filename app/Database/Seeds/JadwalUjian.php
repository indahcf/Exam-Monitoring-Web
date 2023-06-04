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
                'tanggal'            => '2023-05-25',
                'jam_mulai'          => '07:30',
                'jam_selesai'        => '10:00'
            ]
        ];

        foreach ($jadwal_ujian_data as $data) {
            // insert semua data ke tabel
            $this->db->table('jadwal_ujian')->insert($data);
        }
    }
}
