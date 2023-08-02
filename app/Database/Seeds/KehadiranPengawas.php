<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KehadiranPengawas extends Seeder
{
    public function run()
    {
        // membuat data
        $kehadiran_pengawas_data = [
            [
                'id_jadwal_pengawas'    => 1,
                'pengawas_yg_bertugas'     => 1,
                'jenis_pengawas' => 'Pengawas 1'
            ],
            [
                'id_jadwal_pengawas'    => 2,
                'pengawas_yg_bertugas'     => 2,
                'jenis_pengawas' => 'Pengawas 1'
            ],
            [
                'id_jadwal_pengawas'    => 3,
                'pengawas_yg_bertugas'     => 3,
                'jenis_pengawas' => 'Pengawas 2'
            ],
            [
                'id_jadwal_pengawas'    => 4,
                'pengawas_yg_bertugas'     => 4,
                'jenis_pengawas' => 'Pengawas 1'
            ],
            [
                'id_jadwal_pengawas'    => 5,
                'pengawas_yg_bertugas'     => 5,
                'jenis_pengawas' => 'Pengawas 1'
            ],
            [
                'id_jadwal_pengawas'    => 6,
                'pengawas_yg_bertugas'     => 6,
                'jenis_pengawas' => 'Pengawas 1'
            ]
        ];

        foreach ($kehadiran_pengawas_data as $data) {
            // insert semua data ke tabel
            $this->db->table('kehadiran_pengawas')->insert($data);
        }
    }
}
