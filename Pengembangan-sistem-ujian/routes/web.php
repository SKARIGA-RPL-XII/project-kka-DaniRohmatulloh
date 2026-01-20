<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\MuridController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::middleware('auth')->group(function () {
    Route::get('/guru/dashboard', [GuruController::class, 'dashboard'])->name('guru.dashboard');
    Route::get('/murid/dashboard', [MuridController::class, 'dashboard'])->name('murid.dashboard');
});

require __DIR__.'/auth.php';
