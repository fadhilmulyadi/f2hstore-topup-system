<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Game;
use App\Models\Product;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Opsional: Reset data agar bersih saat di-seed ulang
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // Game::truncate();
        // Product::truncate();
        // DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // ==========================================
        // GAME 1: MOBILE LEGENDS
        // ==========================================
        $mlbb = Game::create([
            'name'      => 'Mobile Legends',         // Sesuai Model: name
            'slug'      => 'mobile-legends',         // Sesuai Model: slug
            'thumbnail' => 'images/hero/mlbb.jpg',  // Sesuai Model: thumbnail
        ]);

        $mlbb->products()->createMany([
            [
                'name'        => 'Weekly Diamond Pass',
                'sku'         => 'ML-WDP',          // Sesuai Model: sku
                'price'       => 27777,
                'description' => 'Mendapatkan diamond setiap hari selama 7 hari',
            ],
            [
                'name'        => '5 Diamonds',
                'sku'         => 'ML-5',
                'price'       => 1500,
                'description' => '5 Diamond (5 + 0 Bonus)',
            ],
            [
                'name'        => '86 Diamonds',
                'sku'         => 'ML-86',
                'price'       => 19500,
                'description' => '86 Diamond (78 + 8 Bonus)',
            ],
            [
                'name'        => '172 Diamonds',
                'sku'         => 'ML-172',
                'price'       => 38800,
                'description' => '172 Diamond (156 + 16 Bonus)',
            ],
        ]);

        // ==========================================
        // GAME 2: FREE FIRE
        // ==========================================
        $ff = Game::create([
            'name'      => 'Free Fire',
            'slug'      => 'free-fire',
            'thumbnail' => 'images\hero\ff.jpg',
        ]);

        $ff->products()->createMany([
            [
                'name'        => 'Level Up Pass',
                'sku'         => 'FF-LVL',
                'price'       => 15000,
                'description' => 'Naik level dapat diamond',
            ],
            [
                'name'        => '140 Diamonds',
                'sku'         => 'FF-140',
                'price'       => 20000,
                'description' => 'Top up 140 DM',
            ],
            [
                'name'        => '355 Diamonds',
                'sku'         => 'FF-355',
                'price'       => 50000,
                'description' => 'Top up 355 DM',
            ],
        ]);

        // ==========================================
        // GAME 3: GENSHIN IMPACT
        // ==========================================
        $genshin = Game::create([
            'name'      => 'Genshin Impact',
            'slug'      => 'genshin-impact',
            'thumbnail' => 'images/hero/genshin.jpg',
        ]);

        $genshin->products()->createMany([
            [
                'name'        => 'Blessing of the Welkin Moon',
                'sku'         => 'GI-WELKIN',
                'price'       => 60000,
                'description' => '300 Genesis Crystal + 90 Primogem daily',
            ],
            [
                'name'        => '60 Genesis Crystals',
                'sku'         => 'GI-60',
                'price'       => 16000,
                'description' => 'Bonus first top up double',
            ],
            [
                'name'        => '300 Genesis Crystals',
                'sku'         => 'GI-300',
                'price'       => 79000,
                'description' => 'Bonus first top up double',
            ],
        ]);
    }
}