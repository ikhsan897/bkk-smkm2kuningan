<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// === DAFTAR CONTROLLER YANG DIGUNAKAN ===
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LokerController;
use App\Http\Controllers\LamaranController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\Admin\LokerCrudController;

/*
|--------------------------------------------------------------------------
| File Route Utama (Web Routes)
|--------------------------------------------------------------------------
*/

// Rute bawaan Laravel untuk otentikasi
Auth::routes();

// --- RUTE HALAMAN PUBLIK ---
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/loker', [LokerController::class, 'index'])->name('loker.index');
Route::get('/loker/{loker}', [LokerController::class, 'show'])->name('loker.show');


// --- RUTE YANG WAJIB LOGIN ---
Route::middleware('auth')->group(function () {
    Route::post('/loker/{loker}/apply', [LamaranController::class, 'store'])->name('loker.apply');
    Route::get('/profil/lamaran-saya', [ProfilController::class, 'riwayatLamaran'])->name('profil.lamaran');
});


// --- GRUP RUTE UNTUK ADMIN ---
Route::middleware(['auth', 'is.admin'])->prefix('admin')->name('admin.')->group(function () {
    
    Route::get('/dashboard', function () {
        return view('admin.dashboard'); // Pastikan Anda punya view ini
    })->name('dashboard');

    // Rute CRUD untuk Lowongan Kerja
    Route::resource('loker', LokerCrudController::class);

    // == ROUTE BARU UNTUK MELIHAT PELAMAR ==
    Route::get('/loker/{loker}/pelamar', [LokerCrudController::class, 'lihatPelamar'])->name('loker.pelamar');

    // == ROUTE BARU UNTUK UPDATE STATUS ==
    Route::patch('/lamaran/{lamaran}/update-status', [LokerCrudController::class, 'updateStatus'])->name('lamaran.updateStatus');
});
