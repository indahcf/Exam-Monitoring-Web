<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Role extends Seeder
{
    public function run()
    {
        // membuat data
        $role_data = [
            [
                'role' => 'Admin'
            ],
            [
                'role' => 'Dosen'
            ],
            [
                'role' => 'Gugus Kendali Mutu'
            ],
            [
                'role' => 'Panitia'
            ],
            [
                'role' => 'Pengawas'
            ],
            [
                'role' => 'Koordinator'
            ]
        ];

        foreach ($role_data as $data) {
            // insert semua data ke tabel
            $this->db->table('role')->insert($data);
        }
    }
}
