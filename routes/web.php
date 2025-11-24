<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController; // Pastikan Controller ini di-import
use App\Http\Controllers\GameController; // Controller Public/User
use App\Http\Controllers\Admin\GameController as AdminGameController; // Controller Admin (Kasih alias biar gak error)
use App\Http\Controllers\Admin\ProductController as AdminProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman Home (Index)
Route::get('/', function () {
    // 1. AMBIL DATA DARI DATABASE (Ini yang tadi hilang)
    // Kita ambil 8 game pertama untuk ditampilkan
    $games = \App\Models\Game::take(8)->get(); 
    
    // 2. KIRIM KE VIEW YANG SESUAI ERROR LOG
    // Error kamu bilang filenya di: resources/views/user/topup/index.blade.php
    // Jadi nama view-nya adalah: 'user.topup.index'
    return view('user.topup.index', compact('games')); 
});

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect('/');
})->middleware(['auth', 'verified'])->name('dashboard');

// ==========================================
// 2. ROUTE ADMIN (Khusus Pengelola)
// ==========================================
Route::prefix('admin')        // URL jadi: website.com/admin/game
    ->name('admin.')          // Nama route jadi: admin.game.index
    ->middleware(['auth', 'admin'])    // Wajib Login
    ->group(function () {
        
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        // CRUD Game
        // Karena pakai alias di atas, panggilnya AdminGameController
        Route::resource('game', AdminGameController::class);
        
        // CRUD Produk
        Route::resource('produk', AdminProductController::class);
    });

// Route Profile (Breeze default)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route Detail Game (Integrasi Database)
Route::get('/game/{slug}', [OrderController::class, 'show'])->name('order.show');
Route::resource('/game', GameController::class);
Route::resource('/produk', ProdukController::class);

require __DIR__.'/auth.php';