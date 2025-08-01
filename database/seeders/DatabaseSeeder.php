<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $role = ['mahasiswa', 'pembina', 'staff', 'admin'];

        foreach ($role as $roleName) {
            Role::create([
                'name' => $roleName,
            ]);
        }
        // Seeder untuk 4 user dengan role berbeda
        $admin = \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@kampus.test',
            'password' => bcrypt('password'),
        ]);
        //set role admin
        $admin->assignRole('admin');
        $staff = \App\Models\User::create([
            'name' => 'Staff Promosi Kampus',
            'email' => 'staff@kampus.test',
            'password' => bcrypt('password'),
        ]);
        $staff->assignRole('staff');
        $pembina = \App\Models\User::create([
            'name' => 'Dosen Pembimbing',
            'email' => 'pembina@kampus.test',
            'password' => bcrypt('password'),
        ]);
        $pembina->assignRole('pembina');
        $mahasiswa = \App\Models\User::create([
            'name' => 'Mahasiswa',
            'email' => 'mahasiswa@kampus.test',
            'password' => bcrypt('password'),
        ]);
        $mahasiswa->assignRole('mahasiswa');
    }
}
