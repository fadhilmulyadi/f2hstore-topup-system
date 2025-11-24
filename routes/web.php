<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController; // Pastikan Controller ini di-import

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

// Halaman Dashboard (Breeze default)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route Profile (Breeze default)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route Detail Game (Integrasi Database)
Route::get('/game/{slug}', [OrderController::class, 'show'])->name('order.show');

require __DIR__.'/auth.php';