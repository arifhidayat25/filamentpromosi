<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proposal_id')->unique()->constrained('proposals')->onDelete('cascade');
            $table->decimal('amount', 12, 2)->default(0.00);
            $table->enum('status', ['menunggu_pembayaran', 'dibayar'])->default('menunggu_pembayaran');
            $table->date('payment_date')->nullable();
            $table->foreignId('processed_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
