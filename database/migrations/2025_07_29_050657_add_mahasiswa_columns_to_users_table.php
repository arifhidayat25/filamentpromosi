<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Tambahkan kolom-kolom ini setelah kolom 'role'
            $table->string('nim')->unique()->nullable()->after('role');
            $table->string('prodi')->nullable()->after('nim');
            $table->string('no_telepon')->nullable()->after('prodi');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Ini untuk jika Anda perlu membatalkan migrasi
            $table->dropColumn(['nim', 'prodi', 'no_telepon']);
        });
    }
};
