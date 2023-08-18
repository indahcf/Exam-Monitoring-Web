<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PencetakSoal extends Seeder
{
    public function run()
    {
        //membuat data
        $pencetak_soal_data = [
            [
                'id_user' => 4,
                'id_prodi'  => 3
            ]
        ];

        foreach ($pencetak_soal_data as $data) {
            // insert semua data ke tabel
            $this->db->table('pencetak_soal')->insert($data);
        }
    }
}
