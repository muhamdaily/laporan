<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Muhammad Mauribi',
                'username' => 'admin',
                'email' => 'admin@example.com',
                'role' => 'admin',
                'nim' => '23060005',
                'prodi' => 'Sistem dan Teknologi Informasi',
                'email_verified_at' => now(),
                'password' => bcrypt('admin'),
            ],
            [
                'name' => 'Ilhan Awafi',
                'username' => 'ilhan',
                'email' => 'ilhan@example.com',
                'role' => 'user',
                'nim' => '23060003',
                'prodi' => 'Sistem dan Teknologi Informasi',
                'email_verified_at' => now(),
                'password' => bcrypt('ilhan'),
            ]
        ];

        foreach ($users as $user) {
            \App\Models\User::create($user);
        }
    }
}
