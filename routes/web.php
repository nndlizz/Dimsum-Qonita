<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjukanSponsorController;
use App\Http\Controllers\AdminAuthController;

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

// Kelola Sponsor
Route::get(
    '/admin/kelolasponsor',
    [AjukanSponsorController::class, 'halamanKelolaSponsor']
)->name('admin.kelolasponsor');

// Halaman Tabel
Route::get('/admin/tables', function () {
    return view('admin.tables');
})->name('admin.tables');

// Halaman Kosong
Route::get('/admin/blankpage', function () {
    return view('admin.blankpage');
})->name('admin.blankpage');