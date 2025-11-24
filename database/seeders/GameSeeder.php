<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\Game;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. MATIKAN PENGECEKAN FOREIGN KEY (Supaya bisa truncate bersih)
        Schema::disableForeignKeyConstraints();

        // 2. KOSONGKAN TABEL (Supaya data tidak double saat di-seed ulang)
        DB::table('products')->truncate();
        DB::table('games')->truncate();

        // 3. NYALAKAN KEMBALI
        Schema::enableForeignKeyConstraints();

        // ==========================================
        // 1. MOBILE LEGENDS
        // ==========================================
        $mlbb = Game::create([
            'name' => 'Mobile Legends',
            'slug' => 'mobile-legends',
            'thumbnail' => 'thumbnails/mlbb.jpg',
        ]);

        $mlbb->products()->createMany([
            ['name' => 'Weekly Diamond Pass', 'sku' => 'ML-WDP', 'price' => 28000],
            ['name' => '86 Diamonds', 'sku' => 'ML-86', 'price' => 20000],
            ['name' => '172 Diamonds', 'sku' => 'ML-172', 'price' => 40000],
        ]);

        // ==========================================
        // 2. JOKI RANK (Sesuai UI)
        // ==========================================
        $joki = Game::create([
            'name' => 'Joki Rank Mobile Legends',
            'slug' => 'joki-rank-ml',
            'thumbnail' => 'thumbnails/joki-ml.jpg',
        ]);

        $joki->products()->createMany([
            ['name' => 'Joki Epic ke Legend (Per Bintang)', 'sku' => 'JK-EL', 'price' => 5000],
            ['name' => 'Joki Legend ke Mythic (Per Bintang)', 'sku' => 'JK-LM', 'price' => 8000],
            ['name' => 'Paket Joki Mythic Grading (10 Win)', 'sku' => 'JK-MG', 'price' => 150000],
        ]);

        // ==========================================
        // 3. JASA MABAR PUSH
        // ==========================================
        $mabar = Game::create([
            'name' => 'Jasa Mabar Push',
            'slug' => 'jasa-mabar-push',
            'thumbnail' => 'thumbnails/mabar-push.jpg',
        ]);

        $mabar->products()->createMany([
            ['name' => 'Teman Mabar (Per Jam)', 'sku' => 'MB-1H', 'price' => 15000],
            ['name' => 'Mabar Push Rank (Per Win)', 'sku' => 'MB-WIN', 'price' => 10000],
        ]);

        // ==========================================
        // 4. ROBLOX
        // ==========================================
        $roblox = Game::create([
            'name' => 'Roblox',
            'slug' => 'roblox',
            'thumbnail' => 'thumbnails/roblox.jpg',
        ]);

        $roblox->products()->createMany([
            ['name' => '80 Robux', 'sku' => 'RB-80', 'price' => 15000],
            ['name' => '400 Robux', 'sku' => 'RB-400', 'price' => 75000],
            ['name' => '800 Robux', 'sku' => 'RB-800', 'price' => 150000],
        ]);

        // ==========================================
        // 5. JASA MABAR CASUAL
        // ==========================================
        $casual = Game::create([
            'name' => 'Jasa Mabar Casual',
            'slug' => 'mabar-casual',
            'thumbnail' => 'thumbnails/mabar-casual.jpg',
        ]);

        $casual->products()->createMany([
            ['name' => 'Teman Curhat & Main (1 Jam)', 'sku' => 'CS-1H', 'price' => 20000],
            ['name' => 'Teman Mabar Santai (3 Match)', 'sku' => 'CS-3M', 'price' => 25000],
        ]);

        // ==========================================
        // 6. FREE FIRE
        // ==========================================
        $ff = Game::create([
            'name' => 'Free Fire',
            'slug' => 'free-fire',
            'thumbnail' => 'thumbnails/ff.jpg',
        ]);

        $ff->products()->createMany([
            ['name' => '140 Diamonds', 'sku' => 'FF-140', 'price' => 20000],
            ['name' => '355 Diamonds', 'sku' => 'FF-355', 'price' => 50000],
            ['name' => 'Level Up Pass', 'sku' => 'FF-LUP', 'price' => 15000],
        ]);

        // ==========================================
        // 7. PUBG MOBILE
        // ==========================================
        $pubg = Game::create([
            'name' => 'PUBG Mobile',
            'slug' => 'pubg-mobile',
            'thumbnail' => 'thumbnails/pubg.jpg',
        ]);

        $pubg->products()->createMany([
            ['name' => '60 UC', 'sku' => 'PUBG-60', 'price' => 14000],
            ['name' => '325 UC', 'sku' => 'PUBG-325', 'price' => 70000],
            ['name' => '660 UC', 'sku' => 'PUBG-660', 'price' => 140000],
        ]);

        // ==========================================
        // 8. HONOR OF KINGS
        // ==========================================
        $hok = Game::create([
            'name' => 'Honor Of Kings',
            'slug' => 'honor-of-kings',
            'thumbnail' => 'thumbnails/hok.jpg',
        ]);

        $hok->products()->createMany([
            ['name' => '80 Tokens', 'sku' => 'HOK-80', 'price' => 15000],
            ['name' => '240 Tokens', 'sku' => 'HOK-240', 'price' => 45000],
            ['name' => 'Weekly Card', 'sku' => 'HOK-WEEK', 'price' => 30000],
        ]);
    }
}