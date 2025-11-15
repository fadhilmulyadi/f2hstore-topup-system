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
        // Tabel ini mencatat setiap pesanan yang dibuat user
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke user yang membeli (dari tabel 'users' bawaan Laravel)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // Relasi ke produk yang dibeli
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            
            // Data tujuan, misal: "12345678 (ZoneID: 9876)" atau "081234567890"
            $table->string('target_account'); 

            // Harga total saat transaksi dibuat
            $table->decimal('total_price', 15, 2); 
            
            // Status transaksi
            $table->enum('status', ['pending', 'processing', 'success', 'failed'])->default('pending');
            
            // Kolom ini akan diisi oleh tabel 'payments'
            $table->string('payment_token')->nullable()->unique();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};