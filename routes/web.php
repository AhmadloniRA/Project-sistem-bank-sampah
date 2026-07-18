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

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminSetoranController;
use App\Http\Controllers\Admin\AdminGudangController;
use App\Http\Controllers\Admin\AdminPenarikanController;
use App\Http\Controllers\Admin\AdminCashflowController;
use App\Http\Controllers\Admin\AdminHargaController;
use App\Http\Controllers\User\UserDashboardController;

/*
|--------------------------------------------------------------------------
| Protected Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/nasabah', [AdminNasabahController::class, 'index'])->name('nasabah');
    Route::post('/nasabah', [AdminNasabahController::class, 'store'])->name('nasabah.store');
    Route::put('/nasabah/{nasabah}', [AdminNasabahController::class, 'update'])->name('nasabah.update');
    Route::delete('/nasabah/{nasabah}', [AdminNasabahController::class, 'destroy'])->name('nasabah.destroy');
    Route::get('/nasabah/{nasabah}/history', [AdminNasabahController::class, 'history'])->name('nasabah.history');

    Route::get('/setoran', [AdminSetoranController::class, 'index'])->name('setoran');
    Route::post('/setoran', [AdminSetoranController::class, 'store'])->name('setoran.store');

    Route::get('/gudang', [AdminGudangController::class, 'index'])->name('gudang');
    Route::post('/gudang/jual', [AdminGudangController::class, 'jual'])->name('gudang.jual');

    Route::get('/penarikan', [AdminPenarikanController::class, 'index'])->name('penarikan');
    Route::post('/penarikan', [AdminPenarikanController::class, 'store'])->name('penarikan.store');
    Route::get('/penarikan/search', [AdminPenarikanController::class, 'search'])->name('penarikan.search');

    Route::get('/cashflow', [AdminCashflowController::class, 'index'])->name('cashflow');
    Route::post('/cashflow', [AdminCashflowController::class, 'store'])->name('cashflow.store');

    Route::get('/harga', [AdminHargaController::class, 'index'])->name('harga');
    Route::put('/harga/{harga}', [AdminHargaController::class, 'update'])->name('harga.update');
});

/*
|--------------------------------------------------------------------------
| Protected User Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('/riwayat', [UserDashboardController::class, 'riwayat'])->name('riwayat');
    Route::get('/profil', [UserDashboardController::class, 'profil'])->name('profil');
});

