<?php

use Illuminate\Support\Facades\Route;
use App\Models\Game;
use App\Models\Product;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;       
use App\Http\Controllers\TransactionController; 
use App\Http\Controllers\Admin\TransactionController as AdminTransactionController; 
use App\Http\Controllers\Admin\GameController as AdminGameController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;

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

// // 2. DASHBOARD USER (Breeze)
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


// 3. PROFILE USER (Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==========================================
// 2. ROUTE ADMIN (Khusus Pengelola)
// ==========================================
Route::prefix('admin')        // URL jadi: website.com/admin/game
    ->name('admin.')          // Nama route jadi: admin.game.index
    ->middleware(['auth', 'admin'])    // Wajib Login
    ->group(function () {

        Route::get('/dashboard', function () {
            $totalGames = Game::count();
            $totalProducts = Product::count();

            return view('admin.dashboard', compact('totalGames', 'totalProducts'));
        })->name('dashboard');

        // CRUD Game
        // Karena pakai alias di atas, panggilnya AdminGameController
        Route::resource('game', AdminGameController::class);

        // CRUD Produk
        Route::resource('produk', AdminProductController::class);
    });

// ========================================================
// 🔥 ROUTE YANG TADI HILANG (WAJIB ADA)
// ========================================================

// 4. DETAIL GAME (Halaman pilih produk)
Route::get('/game/{slug}', [OrderController::class, 'show'])->name('order.show');

// 5. PROSES BELI (Saat klik tombol "Beli Sekarang") //hanya user yang boleh beli atau top up 
Route::post('/checkout', [TransactionController::class, 'store'])->middleware(['auth'])->name('transaction.store');

// 6. HISTORY & INVOICE
Route::get('/transactions', [TransactionController::class, 'index'])
    ->middleware(['auth'])
    ->name('transaction.index');

Route::get('/invoice/{payment_token}', [TransactionController::class, 'show'])->name('transaction.show');


// Route::view('/transaction/check', 'user.transaction.check');
Route::get('/transaction/check', [TransactionController::class, 'check'])->name('transaction.check');

// Admin bisa lihat daftar dan update status jadi success (Trigger WA)
Route::resource('transaction', AdminTransactionController::class)->only(['index', 'update']);
require __DIR__ . '/auth.php';