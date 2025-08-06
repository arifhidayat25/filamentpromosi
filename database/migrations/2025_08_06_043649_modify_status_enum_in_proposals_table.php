<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB; // <-- Gunakan ini

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Menggunakan SQL mentah untuk mengubah kolom ENUM
        DB::statement("
            ALTER TABLE proposals MODIFY COLUMN status ENUM(
                'diajukan',
                'disetujui_pembina',
                'ditolak_pembina',
                'disetujui_staff',
                'ditolak_staff',
                'Menunggu Pembayaran',
                'laporan_disubmit',
                'laporan_diverifikasi',
                'selesai'
            ) NOT NULL DEFAULT 'diajukan'
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // SQL untuk mengembalikan ke kondisi semula
        DB::statement("
            ALTER TABLE proposals MODIFY COLUMN status ENUM(
                'diajukan',
                'disetujui_pembina',
                'ditolak_pembina',
                'disetujui_staff',
                'ditolak_staff',
                'laporan_disubmit',
                'laporan_diverifikasi',
                'selesai'
            ) NOT NULL DEFAULT 'diajukan'
        ");
    }
};