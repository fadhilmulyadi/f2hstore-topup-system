<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\API\GameController;
use App\Http\Controllers\API\OrderController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('user.topup.index');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/transaction/check', function () {
    return view('user.transaction.check');
})->name('transaction.check');

// Route::get('/topup/diamond', function () {
//     return view('user.topup.diamond');
// })->name('topup.diamond');

Route::get('/game/{slug}', [GameController::class, 'show'])->name('game.show');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route untuk halaman detail game (misal: f2hstore.test/game/mobile-legends)
Route::get('/game/{slug}', [OrderController::class, 'show'])->name('order.show');

require __DIR__.'/auth.php';