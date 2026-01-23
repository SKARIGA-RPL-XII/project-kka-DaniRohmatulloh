<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\MuridController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// ROUTE WAJIB UNTUK LARAVEL AUTH
Route::middleware('auth')->get('/dashboard', function () {
    if (Auth::user()->role === 'guru') {
        return redirect()->route('guru.dashboard');
    }

    return redirect()->route('murid.dashboard');
})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/guru/dashboard', [GuruController::class, 'dashboard'])->name('guru.dashboard');
    Route::get('/murid/dashboard', [MuridController::class, 'dashboard'])->name('murid.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

Route::post('/logout', function (Request $request) {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');
})->name('logout');

require __DIR__.'/auth.php';
