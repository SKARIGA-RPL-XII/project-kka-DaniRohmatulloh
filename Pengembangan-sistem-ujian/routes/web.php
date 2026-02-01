<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UjianController;
use App\Http\Controllers\HasilController;
use App\Http\Controllers\MuridController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/examp', function () {
    return view('examp');
})->name('examp');

Route::get('/ujian', function () {
    return view('examp');
});

// AUTH ROUTES
require __DIR__.'/auth.php';

// Route untuk halaman web
Route::middleware(['auth'])->group(function () {
    // ROUTE UTAMA DASHBOARD - Redirect berdasarkan role
    Route::get('/dashboard', function () {
        $user = Auth::user();
        
        if ($user->role === 'guru') {
            return redirect('/guru/dashboard');
        } elseif ($user->role === 'murid') {
            return redirect('/murid/dashboard');
        }
        
        return view('dashboard');
    })->name('dashboard');

    // ROUTE GURU
    Route::get('/guru/dashboard', function () {
        return view('guru.dashboard');
    })->name('guru.dashboard');
    
    Route::get('/guru/soal', function () {
        return view('guru.soal');
    })->name('guru.soal');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Murid routes
Route::middleware(['auth', 'role:murid'])->prefix('murid')->group(function () {
    Route::get('/dashboard', [MuridController::class, 'index'])->name('murid.dashboard');
    Route::get('/ujian', [UjianController::class, 'index'])->name('murid.ujian');
    Route::get('/ujian/{id}/mulai', [UjianController::class, 'mulai'])->name('murid.ujian.mulai');
    Route::post('/ujian/{id}/submit', [UjianController::class, 'submit'])->name('murid.ujian.submit');
    Route::get('/riwayat', [HasilController::class, 'index'])->name('murid.riwayat');
    Route::get('/hasil/{ujian_id}', [HasilController::class, 'show'])->name('murid.hasil');
    Route::get('/hasil/detail/{id}', [HasilController::class, 'detail'])->name('murid.hasil.detail');
});

// API Routes untuk Soal
Route::prefix('api')->group(function () {
    Route::get('/subjects', [SoalController::class, 'getSubjects']);
    Route::post('/subjects', [SoalController::class, 'addSubject']);
    Route::get('/soal', [SoalController::class, 'index']);
    Route::post('/soal', [SoalController::class, 'store']);
    Route::post('/soal/batch', [SoalController::class, 'storeBatch']);
    Route::get('/soal/{id}', [SoalController::class, 'show']);
    Route::delete('/soal/{id}', [SoalController::class, 'destroy']);
});