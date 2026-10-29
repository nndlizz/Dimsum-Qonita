<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AjukanSponsorController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\CabangController;
use App\Http\Middleware\AdminAuth;

// Halaman utama
Route::get('/', function () {
    return redirect()->route('admin.dashboard');
});

// Login dan logout: tidak dimasukkan ke middleware AdminAuth
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])
    ->name('admin.login');

Route::post('/admin/login', [AdminAuthController::class, 'login'])
    ->name('admin.login.process');

Route::post('/admin/logout', [AdminAuthController::class, 'logout'])
    ->name('admin.logout');

// Semua halaman admin wajib login
Route::middleware(AdminAuth::class)->group(function () {

    // Dashboard Admin
    Route::get('/admin', function () {
        return view('admin.dashboard', [
            'jumlahCabang' => DB::table('cabangs')->count(),
            'jumlahProduk' => DB::table('produk')->count(),
            'jumlahKategori' => DB::table('kategoris')->count(),
        ]);
    })->name('admin.dashboard');

    // Kelola Produk
    Route::get('/admin/produk', [ProdukController::class, 'index'])
        ->name('admin.produk.index');

    Route::get('/admin/produk/tambah', [ProdukController::class, 'create'])
        ->name('admin.produk.create');

    Route::post('/admin/produk/simpan', [ProdukController::class, 'store'])
        ->name('admin.produk.store');

    Route::get('/admin/produk/{id_produk}/edit', [ProdukController::class, 'edit'])
        ->name('admin.produk.edit');

    Route::put('/admin/produk/{id_produk}', [ProdukController::class, 'update'])
        ->name('admin.produk.update');

    Route::delete('/admin/produk/{id_produk}', [ProdukController::class, 'destroy'])
        ->name('admin.produk.destroy');

    // Kelola Kategori
    Route::get('/admin/kategori', [KategoriController::class, 'index'])
        ->name('admin.kategori.index');

    Route::get('/admin/kategori/tambah', [KategoriController::class, 'create'])
        ->name('admin.kategori.create');

    Route::post('/admin/kategori/simpan', [KategoriController::class, 'store'])
        ->name('admin.kategori.store');

    Route::get('/admin/kategori/{id_kategori}/edit', [KategoriController::class, 'edit'])
        ->name('admin.kategori.edit');

    Route::put('/admin/kategori/{id_kategori}', [KategoriController::class, 'update'])
        ->name('admin.kategori.update');

    Route::delete('/admin/kategori/{id_kategori}', [KategoriController::class, 'destroy'])
        ->name('admin.kategori.destroy');

    // Kelola Cabang
    Route::get('/admin/cabang', [CabangController::class, 'index'])
        ->name('admin.cabang.index');

    Route::get('/admin/cabang/tambah', [CabangController::class, 'create'])
        ->name('admin.cabang.create');

    Route::post('/admin/cabang/simpan', [CabangController::class, 'store'])
        ->name('admin.cabang.store');

    Route::get('/admin/cabang/{id_cabang}/edit', [CabangController::class, 'edit'])
        ->name('admin.cabang.edit');

    Route::put('/admin/cabang/{id_cabang}', [CabangController::class, 'update'])
        ->name('admin.cabang.update');

    Route::delete('/admin/cabang/{id_cabang}', [CabangController::class, 'destroy'])
        ->name('admin.cabang.destroy');

    // Profil Admin
    Route::get('/admin/profil', [AdminProfileController::class, 'index'])
        ->name('admin.profil');

    Route::get('/admin/profil/edit', [AdminProfileController::class, 'edit'])
        ->name('admin.profil.edit');

    Route::put('/admin/profil', [AdminProfileController::class, 'update'])
        ->name('admin.profil.update');

    // Kelola Sponsor
    Route::get('/admin/kelolasponsor', [
        AjukanSponsorController::class,
        'halamanKelolaSponsor'
    ])->name('admin.kelolasponsor');

    Route::put('/admin/kelolasponsor/{id}/status', [
        AjukanSponsorController::class,
        'updateStatus'
    ])->name('admin.kelolasponsor.status');

    // Kelola Akun Petugas
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

});
