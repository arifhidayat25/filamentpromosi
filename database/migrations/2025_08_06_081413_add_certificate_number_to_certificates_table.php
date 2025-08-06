<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('certificates', function (Blueprint $table) {
            // Menambahkan kolom untuk nomor sertifikat setelah 'file_path'
            $table->string('certificate_number')->after('file_path')->unique()->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('certificates', function (Blueprint $table) {
            $table->dropColumn('certificate_number');
        });
    }
};