<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\Game; 
use Illuminate\Support\Facades\DB;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. MATIKAN PENGECEKAN FOREIGN KEY
        Schema::disableForeignKeyConstraints();

        // 2. KOSONGKAN TABEL
        DB::table('games')->truncate();

        // 3. NYALAKAN KEMBALI PENGECEKAN FOREIGN KEY
        Schema::enableForeignKeyConstraints();

        // 4. MASUKKAN DATA DUMMY
        Game::create([
            'name' => 'Mobile Legends',
            'slug' => 'mobile-legends',
            'thumbnail' => 'thumbnails/ml.png'
        ]);

        Game::create([
            'name' => 'PUBG Mobile',
            'slug' => 'pubg-mobile',
            'thumbnail' => 'thumbnails/pubg.png'
        ]);

        Game::create([
            'name' => 'Free Fire',
            'slug' => 'free-fire',
            'thumbnail' => 'thumbnails/ff.png'
        ]);
        
        Game::create([
            'name' => 'Pulsa Telkomsel',
            'slug' => 'pulsa-telkomsel',
            'thumbnail' => 'thumbnails/tsel.png'
        ]);
    }
}