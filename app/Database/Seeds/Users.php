<?php

namespace App\Database\Seeds;

use Myth\Auth\Password;
use CodeIgniter\Database\Seeder;

class Users extends Seeder
{
    public function run()
    {
        // membuat data
        $users_data = [
            [
                'fullname' => 'Subekti',
                'email' => 'bapendik@unsoed.ac.id',
                'role' => 'Admin',
                'password_hash' => Password::hash("adminsimonji")
            ],
            [
                'fullname' => 'Yogiek Indra Kurniawan',
                'email' => 'yogiek@unsoed.ac.id',
                'role' => 'Dosen',
                'password_hash' => Password::hash("adminsimonji")
            ],
            [
                'fullname' => 'Lasmedi Afuan',
                'email' => 'lasmedi@unsoed.ac.id',
                'role' => 'Gugus Kendali Mutu',
                'password_hash' => Password::hash("adminsimonji")
            ],
            [
                'fullname' => 'Dadang Iskandar',
                'email' => 'dadang@unsoed.ac.id',
                'role' => 'Panitia',
                'password_hash' => Password::hash("adminsimonji")
            ],
            [
                'fullname' => 'Hera',
                'email' => 'hera@unsoed.ac.id',
                'role' => 'Pengawas',
                'password_hash' => Password::hash("adminsimonji")
            ],
            [
                'fullname' => 'Irham',
                'email' => 'irham@unsoed.ac.id',
                'role' => 'Koordinator',
                'password_hash' => Password::hash("adminsimonji")
            ]
        ];

        foreach ($users_data as $data) {
            // insert semua data ke tabel
            $this->db->table('users')->insert($data);
        }
    }
}
