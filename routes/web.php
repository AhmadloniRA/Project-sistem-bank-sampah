<?php

use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\Admin\AdminNasabahController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Homepage (Public)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('layouts.index');
})->name('homepage');

/*
|--------------------------------------------------------------------------
| User Authentication Routes
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [UserAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [UserAuthController::class, 'login'])->name('user.login.submit');
    Route::get('/register', [UserAuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [UserAuthController::class, 'register'])->name('user.register.submit');
});
Route::post('/logout', [UserAuthController::class, 'logout'])->name('user.logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Admin Authentication Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
    });
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout')->middleware('auth:admin');
});

/*
|--------------------------------------------------------------------------
| Protected Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        $totalNasabah = \App\Models\User::where('role', 'user')->count();
        $nasabahBaruBulanIni = \App\Models\User::where('role', 'user')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        return view('admin.dashboard.index', compact('totalNasabah', 'nasabahBaruBulanIni'));
    })->name('dashboard');

    Route::get('/nasabah', [AdminNasabahController::class, 'index'])->name('nasabah');
    Route::put('/nasabah/{nasabah}', [AdminNasabahController::class, 'update'])->name('nasabah.update');
    Route::delete('/nasabah/{nasabah}', [AdminNasabahController::class, 'destroy'])->name('nasabah.destroy');

    Route::get('/keuangan', function () {
        return view('admin.keuangan.index');
    })->name('keuangan');
});

/*
|--------------------------------------------------------------------------
| Protected User Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('dashboard');

    // Tambahkan route user lainnya di sini
});
