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
                'email' => 'subekti@unsoed.ac.id',
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
            ],
            [
                'email' => 'yulianto@unsoed.ac.id',
                'password_hash' => Password::hash("adminsimonji")
            ],
            [
                'email' => 'teguh@unsoed.ac.id',
                'password_hash' => Password::hash("adminsimonji")
            ],
            [
                'email' => 'maruf@unsoed.ac.id',
                'password_hash' => Password::hash("adminsimonji")
            ],
            [
                'email' => 'asjik@unsoed.ac.id',
                'password_hash' => Password::hash("adminsimonji")
            ],
            [
                'email' => 'kuswanto@unsoed.ac.id',
                'password_hash' => Password::hash("adminsimonji")
            ]
        ];

        foreach ($users_data as $data) {
            // insert semua data ke tabel
            $this->db->table('users')->insert($data);
        }
    }
}
