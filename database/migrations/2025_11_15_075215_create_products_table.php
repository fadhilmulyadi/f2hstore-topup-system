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
        // Tabel ini berisi item spesifik yang dijual, 
        // misal: 100 Diamond, 50k Pulsa
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke tabel 'games' (sebagai kategori)
            $table->foreignId('game_id')->constrained('games')->onDelete('cascade');
            
            $table->string('name'); // Misal: "100 Diamonds", "Pulsa 50rb"
            $table->string('sku')->unique()->nullable(); // Kode unik produk
            $table->decimal('price', 15, 2); // Harga (15 digit total, 2 di belakang koma)
            $table->string('description')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};