<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjukanSponsorController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProfileController;

Route::get('/', function () {
    return redirect('/admin');
});

// Route Login Admin
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])
    ->name('admin.login');

Route::post('/admin/login', [AdminAuthController::class, 'login'])
    ->name('admin.login.process');

Route::post('/admin/logout', [AdminAuthController::class, 'logout'])
    ->name('admin.logout');

// Dashboard Admin
Route::get('/admin', function () {
    if (!session()->has('admin_id')) {
        return redirect()->route('admin.login');
    }

    return view('admin.dashboard');
})->name('admin.dashboard');

// Profil Admin
Route::get('/admin/profil', [AdminProfileController::class, 'index'])
    ->name('admin.profil');

Route::get('/admin/profil/edit', [AdminProfileController::class, 'edit'])
    ->name('admin.profil.edit');

Route::put('/admin/profil', [AdminProfileController::class, 'update'])
    ->name('admin.profil.update');

// Kelola Sponsor
Route::get(
    '/admin/kelolasponsor',
    [AjukanSponsorController::class, 'halamanKelolaSponsor']
)->name('admin.kelolasponsor');

Route::put(
    '/admin/kelolasponsor/{id}/status',
    [AjukanSponsorController::class, 'updateStatus']
)->name('admin.kelolasponsor.status');


// Tambah Akun Petugas
Route::prefix('admin/akun')->name('admin.akun.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/tambah', [AdminController::class, 'create'])->name('tambah');
    Route::post('/simpan', [AdminController::class, 'store'])->name('simpan');
    Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [AdminController::class, 'update'])->name('update');
    Route::delete('/hapus/{id}', [AdminController::class, 'destroy'])->name('hapus');
});

// Halaman Tabel
Route::get('/admin/tables', function () {
    return view('admin.tables');
})->name('admin.tables');

// Halaman Kosong
Route::get('/admin/blankpage', function () {
    return view('admin.blankpage');
})->name('admin.blankpage');