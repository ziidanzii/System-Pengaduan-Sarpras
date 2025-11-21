<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AduanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\Petugas\PetugasController;
use App\Http\Controllers\TemporaryItemController;

// Controller Petugas
use App\Http\Controllers\Petugas\DashboardController as PetugasDashboardController;
use App\Http\Controllers\Petugas\PengaduanController as PetugasPengaduanController;
use App\Http\Controllers\Petugas\RiwayatController as PetugasRiwayatController;

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| DASHBOARD UMUM
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'redirect.role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');

        // Temporary items
        Route::get('/temp-items', [TemporaryItemController::class, 'index'])->name('temp.items');
        Route::post('/temp-items/{id}/approve', [TemporaryItemController::class, 'approve'])->name('temp.items.approve');
        Route::post('/temp-items/{id}/reject', [TemporaryItemController::class, 'reject'])->name('temp.items.reject');
        Route::delete('/temp-items/{id}', [TemporaryItemController::class, 'destroy'])->name('temp.items.destroy');

        // Resource routes
        Route::resource('users', UserController::class);
        Route::resource('pengaduan', PengaduanController::class);
        Route::resource('items', ItemController::class);
        Route::resource('lokasi', LokasiController::class);
        Route::resource('petugas', PetugasController::class);

        // Petugas create-complete (langsung input data user + petugas)
        Route::get('petugas/create-complete', [PetugasController::class, 'createComplete'])->name('petugas.createComplete');
        Route::post('petugas/store-complete', [PetugasController::class, 'storeComplete'])->name('petugas.storeComplete');

        // Lokasi detail & item management
        Route::get('lokasi/{lokasi}/detail', [LokasiController::class, 'show'])->name('lokasi.detail');
        Route::post('lokasi/{lokasi}/add-item', [LokasiController::class, 'addItem'])->name('lokasi.add-item');
        Route::delete('lokasi/{lokasi}/remove-item/{idItem}', [LokasiController::class, 'removeItem'])->name('lokasi.remove-item');
    });

/*
|--------------------------------------------------------------------------
| PETUGAS ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'redirect.role:petugas'])
    ->prefix('petugas')
    ->name('petugas.')
    ->group(function () {
        Route::get('/dashboard', [PetugasDashboardController::class, 'index'])->name('dashboard');
        Route::get('/pengaduan', [PetugasPengaduanController::class, 'index'])->name('pengaduan.index');
        Route::get('/pengaduan/{id}', [PetugasPengaduanController::class, 'show'])->name('pengaduan.show');
        Route::post('/pengaduan/{id}/update', [PetugasPengaduanController::class, 'update'])->name('pengaduan.update');
        Route::post('/pengaduan/{id}/approve', [PetugasPengaduanController::class, 'approve'])->name('pengaduan.approve');
        Route::post('/pengaduan/{id}/reject', [PetugasPengaduanController::class, 'reject'])->name('pengaduan.reject');
        Route::get('/riwayat', [PetugasRiwayatController::class, 'index'])->name('riwayat');
    });

/*
|--------------------------------------------------------------------------
| PENGGUNA ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'redirect.role:pengguna,user'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'userDashboard'])->name('dashboard');
        Route::get('/profile', [DashboardController::class, 'userProfile'])->name('profile');
        Route::get('/profile/edit', [DashboardController::class, 'editProfile'])->name('profile.edit');
        Route::post('/profile/update', [DashboardController::class, 'updateProfile'])->name('profile.update');

        // Aduan
        Route::get('/aduan/create', [AduanController::class, 'create'])->name('aduan.create');
        Route::post('/aduan', [AduanController::class, 'store'])->name('aduan.store');
        // Mark-notified (tandai notifikasi telah dibaca)
        Route::post('/aduan/{id}/mark-notified', [AduanController::class, 'markNotified'])->name('aduan.mark-notified');
        Route::get('/aduan/history', [AduanController::class, 'history'])->name('aduan.history');

        // AJAX get items by lokasi
        Route::get('/get-items-by-lokasi', [AduanController::class, 'getItemsByLokasi'])->name('get.items.by.lokasi');
    });

/*
|--------------------------------------------------------------------------
| PETUGAS NOTIFICATION ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'redirect.role:petugas'])
    ->prefix('petugas')
    ->name('petugas.')
    ->group(function () {
        // Mark pengaduan baru sebagai notified (read)
        Route::post('/pengaduan/{id}/mark-notified-petugas', [AduanController::class, 'markNotifiedPetugas'])->name('pengaduan.mark-notified');
    });
