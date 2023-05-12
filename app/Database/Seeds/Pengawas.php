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
                'nip' => '198903132015042004',
                'pengawas'  => 'Nur Chasanah'
            ]
        ];

        foreach ($pengawas_data as $data) {
            // insert semua data ke tabel
            $this->db->table('pengawas')->insert($data);
        }
    }
}
