<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;       // Controller Detail Game
use App\Http\Controllers\TransactionController; // Controller Logic Beli (YANG TADI HILANG)

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. HALAMAN HOME
Route::get('/', function () {
    // Ambil data game dari database untuk ditampilkan di Home
    $games = \App\Models\Game::take(8)->get();
    // Sesuaikan dengan nama folder view Agil
    return view('user.topup.index', compact('games'));
});

// 2. DASHBOARD USER (Breeze)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 3. PROFILE USER (Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ========================================================
// 🔥 ROUTE YANG TADI HILANG (WAJIB ADA)
// ========================================================

// 4. DETAIL GAME (Halaman pilih produk)
Route::get('/game/{slug}', [OrderController::class, 'show'])->name('order.show');

// 5. PROSES BELI (Saat klik tombol "Beli Sekarang")
Route::post('/checkout', [TransactionController::class, 'store'])->name('transaction.store');

// 6. HISTORY & INVOICE
Route::get('/transactions', [TransactionController::class, 'index'])
    ->middleware(['auth'])
    ->name('transaction.index');

Route::get('/invoice/{payment_token}', [TransactionController::class, 'show'])->name('transaction.show');


require __DIR__ . '/auth.php';