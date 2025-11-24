<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Menampilkan Halaman Detail Game berdasarkan Slug
     * Contoh: /game/mobile-legends
     */
    public function show($slug)
    {
        // 1. Cari Game berdasarkan slug, sekalian ambil produknya
        $game = Game::where('slug', $slug)->with('products')->first();

        // 2. Kalau game tidak ditemukan, tampilkan error 404
        if (!$game) {
            abort(404);
        }

        // 3. Kirim data $game ke View (Tampilan)
        // PENTING: Tanya Agil, nama file blade untuk detail game-nya apa?
        // Disini saya asumsikan namanya 'pages.order.detail'
        return view('user.topup.show', [
            'game' => $game
        ]);
    }
}