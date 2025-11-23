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
        // Tabel ini akan berisi 'kategori' game atau produk
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Misal: "Mobile Legends", "Pulsa Telkomsel"
            $table->string('slug')->unique(); // Misal: "mobile-legends", "pulsa-telkomsel"
            $table->string('thumbnail')->nullable(); // Path atau URL ke logo/gambar
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};