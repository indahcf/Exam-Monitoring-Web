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
                'id_prodi'           => 1,
                'id_kelas'           => 1,
                'id_dosen'           => 1,
                'id_ruang_ujian'     => 1,
                'id_tahun_akademik'  => 1,
                'jumlah_peserta'     => 18,
                'waktu_ujian'        => '2023-05-25 07:30:00'
            ]
        ];

        foreach ($jadwal_ujian_data as $data) {
            // insert semua data ke tabel
            $this->db->table('jadwal_ujian')->insert($data);
        }
    }
}
