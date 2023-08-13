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
                'email' => 'bapendik@unsoed.ac.id',
                'password_hash' => Password::hash("adminsimonji")
            ],
            [
                'email' => 'yogiek@unsoed.ac.id',
                'password_hash' => Password::hash("adminsimonji")
            ],
            [
                'email' => 'lasmedi@unsoed.ac.id',
                'password_hash' => Password::hash("adminsimonji")
            ],
            [
                'email' => 'gilang@unsoed.ac.id',
                'password_hash' => Password::hash("adminsimonji")
            ],
            [
                'email' => 'hera@unsoed.ac.id',
                'password_hash' => Password::hash("adminsimonji")
            ],
            [
                'email' => 'irham@unsoed.ac.id',
                'password_hash' => Password::hash("adminsimonji")
            ]
        ];

        foreach ($users_data as $data) {
            // insert semua data ke tabel
            $this->db->table('users')->insert($data);
        }
    }
}
