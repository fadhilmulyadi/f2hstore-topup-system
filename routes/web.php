<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\API\GameController;
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

require __DIR__.'/auth.php';
