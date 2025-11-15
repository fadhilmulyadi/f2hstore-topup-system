<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\API\GameController;

Route::get('/', function () {
    return view('welcome');
});

