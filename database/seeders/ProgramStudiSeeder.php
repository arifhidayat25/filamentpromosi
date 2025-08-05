<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // <-- Penting

class ProgramStudiSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk mengisi data program studi.
     *
     * @return void
     */
    public function run(): void
    {
        // Hapus data lama jika ada, untuk menghindari duplikat
        DB::table('program_studis')->delete();

        // Masukkan data baru
        DB::table('program_studis')->insert([
            ['name' => 'S1 Informatika', 'kode' => 'IF', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'S1 Farmasi Klinis dan Komunitas', 'kode' => 'FKK', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'S1 Fisioterapi', 'kode' => 'FIS', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'S1 Kebidanan', 'kode' => 'BDN', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'S1 Keperawatan', 'kode' => 'KEP', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'S1 Kedokteran Gigi', 'kode' => 'KG', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'D4 Keperawatan Anestesiologi', 'kode' => 'ANS', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'D3 Keperawatan', 'kode' => 'D3KEP', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'D3 Farmasi', 'kode' => 'D3FAR', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'D3 Akupunktur', 'kode' => 'D3AKU', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'D3 Rekam Medis dan Informasi Kesehatan', 'kode' => 'RMIK', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}