<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserRole extends Seeder
{
    public function run()
    {
        // membuat data
        $user_role_data = [
            [
                'id_user' => 1,
                'id_role' => 1
            ],
            [
                'id_user' => 1,
                'id_role' => 5
            ],
            [
                'id_user' => 2,
                'id_role' => 2
            ],
            [
                'id_user' => 2,
                'id_role' => 6
            ],
            [
                'id_user' => 3,
                'id_role' => 2
            ],
            [
                'id_user' => 3,
                'id_role' => 3
            ],
            [
                'id_user' => 4,
                'id_role' => 4
            ],
            [
                'id_user' => 4,
                'id_role' => 5
            ],
            [
                'id_user' => 5,
                'id_role' => 5
            ],
            [
                'id_user' => 6,
                'id_role' => 2
            ],
            [
                'id_user' => 7,
                'id_role' => 5
            ],
            [
                'id_user' => 8,
                'id_role' => 5
            ],
            [
                'id_user' => 9,
                'id_role' => 5
            ],
            [
                'id_user' => 10,
                'id_role' => 5
            ],
            [
                'id_user' => 11,
                'id_role' => 5
            ]
        ];

        foreach ($user_role_data as $data) {
            // insert semua data ke tabel
            $this->db->table('user_role')->insert($data);
        }
    }
}
