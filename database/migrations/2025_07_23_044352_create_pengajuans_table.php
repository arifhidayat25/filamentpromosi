<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('school_id');
            $table->enum('status', [
                'diajukan',
                'disetujui_pembina',
                'ditolak_pembina',
                'disetujui_staf',
                'ditolak_staf',
                'laporan_disubmit',
                'laporan_diverifikasi',
                'selesai',
            ])->default('diajukan');
            $table->date('proposed_date')->nullable();
            $table->text('notes')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};
