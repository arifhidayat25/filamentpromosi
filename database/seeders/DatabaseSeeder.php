<?php

namespace Database\Seeders;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat Roles terlebih dahulu
        $this->command->info('Membuat Roles...');
        $roles = ['mahasiswa', 'pembina', 'staff', 'admin'];
        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }
        $this->command->info('-> Roles berhasil dibuat.');

        // 2. Panggil Seeder untuk data Akademik (Prodi & Pembina)
        $this->call(AkademikSeeder::class);

        // 3. Buat User contoh untuk Admin, Staff, dan Mahasiswa
        $this->command->info('Membuat user contoh (Admin, Staff, Mahasiswa)...');
        
        $admin = User::firstOrCreate(
            ['email' => 'admin@kampus.test'],
            ['name' => 'Admin', 'password' => bcrypt('password')]
        );
        $admin->assignRole('admin');

        $staff = User::firstOrCreate(
            ['email' => 'staff@kampus.test'],
            ['name' => 'Staff Promosi Kampus', 'password' => bcrypt('password')]
        );
        $staff->assignRole('staff');

        // Ambil prodi pertama (Informatika) sebagai contoh untuk mahasiswa
        $prodiInformatikaId = \App\Models\ProgramStudi::where('kode', 'IF')->value('id');

        $mahasiswa = User::firstOrCreate(
            ['email' => 'mahasiswa@kampus.test'],
            [
                'name' => 'Mahasiswa Contoh',
                'password' => bcrypt('password'),
                'program_studi_id' => $prodiInformatikaId
            ]
        );
        $mahasiswa->assignRole('mahasiswa');

        $this->command->info('-> User contoh berhasil dibuat.');

        // 4. (SOLUSI MENU HILANG) Berikan semua hak akses ke Admin
        $this->command->info('Memberikan semua hak akses ke Admin...');
        $adminRole = Role::where('name', 'admin')->first();
        if ($adminRole) {
            // Generate permissions jika belum ada
            $this->command->call('shield:generate', ['--all' => true]);
            // Berikan semua permission ke admin
            $adminRole->givePermissionTo(Permission::all());
            $this->command->info('-> Hak akses untuk Admin berhasil diatur.');
        }

        $this->command->line('');
        $this->command->info('===================================================');
        $this->command->info('DATABASE SEEDING SELESAI!');
        $this->command->info('===================================================');
    }
}