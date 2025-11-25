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
    // 1. Ambil data game dari database
    // orderBy('created_at', 'desc') -> Agar game yang baru diinput muncul paling atas/depan
    // where('status', 1) -> Opsional: Jika ingin menampilkan yang statusnya aktif saja
    
    $games = Game::orderBy('created_at', 'asc')->get(); 

    // 2. Kirim data $games ke view
    // Ganti 'welcome' dengan nama file blade halaman depan kamu (misal: 'home' atau 'index')
    return view('user.topup.index', compact('games')); 
});

// // 2. DASHBOARD USER (Breeze)
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('admin')        // URL awalan: /admin/...
    ->name('admin.')          // Nama route awalan: admin....
    ->middleware(['auth', 'admin']) // Middleware cek login & role admin
    ->group(function () {

        // 1. Dashboard
        Route::get('/dashboard', function () {
            $totalGames = Game::count();
            $totalProducts = Product::count();

            return view('admin.dashboard', compact('totalGames', 'totalProducts'));
        })->name('dashboard');

        // 2. CRUD Game (admin.game.index, admin.game.store, dll)
        Route::resource('game', AdminGameController::class);

        // 3. CRUD Produk (admin.produk.index, admin.produk.store, dll)
        Route::resource('produk', AdminProductController::class);

        // 4. UPDATE TRANSAKSI (Ini yang sebelumnya kurang)
        // URL: /admin/transaksi/update/{id}
        // Nama Route: admin.transaksi.update
        // Method: POST (Sesuai form di blade Anda)
        Route::post('/transaksi/update/{id}', [TransactionController::class, 'update'])
            ->name('transaction.update');

        // 4. TRANSAKSI
        // a. Route untuk Melihat Daftar Transaksi (Mengatasi Not Found)
        // Pastikan di AdminController ada function bernama 'index' atau sesuaikan namanya
        Route::get('/transaksi', [AdminTransactionController::class, 'index'])
            ->name('transaksi.index');

        // b. Route untuk Update Status Transaksi
        Route::post('/transaksi/update/{id}', [AdminTransactionController::class, 'update'])
            ->name('transaksi.update');
            
    });

     

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