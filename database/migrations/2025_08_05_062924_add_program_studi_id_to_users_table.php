<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('program_studi_id')->nullable()->constrained('program_studis')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
    if (Schema::hasColumn('users', 'program_studi_id')) {
        $table->dropForeign(['program_studi_id']);
        $table->dropColumn('program_studi_id');
    }
});

    }
};