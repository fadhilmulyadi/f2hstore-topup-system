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
        // Tabel ini untuk detail pembayaran, 
        // bisa dihubungkan ke Midtrans/Tripay atau manual
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke transaksi induknya
            // Kita pakai foreignId('transaction_id')
            $table->foreignId('transaction_id')->constrained('transactions')->onDelete('cascade');
            
            // Metode pembayaran yang dipilih (misal: "BCA", "GOPAY")
            $table->string('method');
            
            // Jumlah yang harus dibayar
            $table->decimal('amount', 15, 2);
            
            // Status pembayaran
            $table->enum('status', ['paid', 'unpaid'])->default('unpaid');
            
            // Token/kode unik dari payment gateway (jika pakai)
            $table->string('gateway_token')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};