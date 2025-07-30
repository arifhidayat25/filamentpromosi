<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seeder untuk 4 user dengan role berbeda
        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@kampus.test',
            'password' => bcrypt('password'),
            'role' => \App\Models\User::ROLE_ADMIN,
        ]);
        \App\Models\User::create([
            'name' => 'Staff Promosi Kampus',
            'email' => 'staff@kampus.test',
            'password' => bcrypt('password'),
            'role' => \App\Models\User::ROLE_STAFF,
        ]);
        \App\Models\User::create([
            'name' => 'Dosen Pembimbing',
            'email' => 'pembina@kampus.test',
            'password' => bcrypt('password'),
            'role' => \App\Models\User::ROLE_PEMBINA,
        ]);
        \App\Models\User::create([
            'name' => 'Mahasiswa',
            'email' => 'mahasiswa@kampus.test',
            'password' => bcrypt('password'),
            'role' => \App\Models\User::ROLE_MAHASISWA,
        ]);
    }
}
