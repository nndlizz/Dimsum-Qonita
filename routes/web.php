
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
use App\Http\Controllers\Pelanggan\PelangganAuthController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Middleware\PelangganAuth;
use App\Http\Middleware\AdminAuth;
use App\Http\Controllers\Pelanggan\PelangganProfileController;



Route::get('/admin/produk', [ProdukController::class, 'index'])
    ->name('admin.produk.index');

Route::get('/admin/produk/tambah', [ProdukController::class, 'create'])
    ->name('admin.produk.create');

Route::post('/admin/produk/simpan', [ProdukController::class, 'store'])
    ->name('admin.produk.store');

Route::get('/admin/produk/{id_produk}/edit', [ProdukController::class, 'edit'])
    ->name('admin.produk.edit');



/*
|--------------------------------------------------------------------------
| LANDING PAGE
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $cabangs = DB::table('cabangs')->get();

    $produks = \App\Models\Produk::with(['kategori', 'cabangs'])
        ->get();

    return view('pelanggan.layout.landing_page', compact('cabangs', 'produks'));
})->name('home');


/*
|--------------------------------------------------------------------------
| LOGIN & REGISTER
|--------------------------------------------------------------------------
*/

Route::get('/login', [AdminAuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AdminAuthController::class, 'login'])
    ->name('login.proses');

Route::post('/logout', [AdminAuthController::class, 'logout'])
    ->name('logout');

Route::get('/register', [PelangganAuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [PelangganAuthController::class, 'register'])
    ->name('pelanggan.register.proses');


/*
|--------------------------------------------------------------------------
| ROUTE PELANGGAN
|--------------------------------------------------------------------------
*/

Route::get('/notifikasi', [NotifikasiController::class, 'index'])
    ->middleware(PelangganAuth::class)
    ->name('pelanggan.notifikasi');
    
// (KHUSUS PELANGGAN)
Route::middleware(PelangganAuth::class)->group(function () {

    // Profil Pelanggan
    Route::get('/pelanggan/profil', [PelangganProfileController::class, 'index'])
        ->name('pelanggan.profil');

    // Edit Profil Pelanggan
    Route::get('/pelanggan/profil/edit', [PelangganProfileController::class, 'edit'])
        ->name('pelanggan.profil.edit');
    
    // Update Profil Pelanggan
    Route::put('/pelanggan/profil', [PelangganProfileController::class, 'update'])
    ->name('pelanggan.profil.update');

    Route::get('/pelanggan/ajukan-sponsor', [
        AjukanSponsorController::class,
        'create'
    ])->name('pelanggan.sponsor.create');

    Route::post('/pelanggan/ajukan-sponsor', [
        AjukanSponsorController::class,
        'store'
    ])->name('pelanggan.sponsor.store');

    Route::get('/notifikasi', [
        NotifikasiController::class,
        'index'
    ])->name('pelanggan.notifikasi');

});


/*
|--------------------------------------------------------------------------
| ROUTE ADMIN (WAJIB LOGIN)
|--------------------------------------------------------------------------
*/

Route::middleware(AdminAuth::class)->group(function () {

    // Dashboard
    Route::get('/admin', function () {
        return view('admin.dashboard', [
            'jumlahCabang' => DB::table('cabangs')->count(),
            'jumlahProduk' => DB::table('produk')->count(),
            'jumlahKategori' => DB::table('kategoris')->count(),
            'totalAdmin' => DB::table('admin')->count(),
            'sponsorDiterima' => DB::table('ajukan_sponsor')
            ->where('status', 'diterima')
            ->count(),

        'sponsorDitolak' => DB::table('ajukan_sponsor')
            ->where('status', 'ditolak')
            ->count(),

        'totalAdmin' => DB::table('admin')->count(),
        ]);
    })->name('admin.dashboard');


    // Kelola Produk
    Route::prefix('admin/produk')->name('admin.produk.')->group(function () {
        Route::get('/', [ProdukController::class, 'index'])->name('index');
        Route::get('/tambah', [ProdukController::class, 'create'])->name('create');
        Route::post('/simpan', [ProdukController::class, 'store'])->name('store');
        Route::get('/{id_produk}/edit', [ProdukController::class, 'edit'])->name('edit');
        Route::put('/{id_produk}', [ProdukController::class, 'update'])->name('update');
        Route::delete('/{id_produk}', [ProdukController::class, 'destroy'])->name('destroy');
    });


    // Kelola Kategori
    Route::prefix('admin/kategori')->name('admin.kategori.')->group(function () {
        Route::get('/', [KategoriController::class, 'index'])->name('index');
        Route::get('/tambah', [KategoriController::class, 'create'])->name('create');
        Route::post('/simpan', [KategoriController::class, 'store'])->name('store');
        Route::get('/{id_kategori}/edit', [KategoriController::class, 'edit'])->name('edit');
        Route::put('/{id_kategori}', [KategoriController::class, 'update'])->name('update');
        Route::delete('/{id_kategori}', [KategoriController::class, 'destroy'])->name('destroy');
    });


    // Kelola Cabang
    Route::prefix('admin/cabang')->name('admin.cabang.')->group(function () {
        Route::get('/', [CabangController::class, 'index'])->name('index');
        Route::get('/tambah', [CabangController::class, 'create'])->name('create');
        Route::post('/simpan', [CabangController::class, 'store'])->name('store');
        Route::get('/{id_cabang}/edit', [CabangController::class, 'edit'])->name('edit');
        Route::put('/{id_cabang}', [CabangController::class, 'update'])->name('update');
        Route::delete('/{id_cabang}', [CabangController::class, 'destroy'])->name('destroy');
    });


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


    // Riwayat Sponsor
    Route::get('/admin/riwayat_sponsor', [
        AjukanSponsorController::class,
        'halamanRiwayatSponsor'
    ])->name('admin.riwayat_sponsor');


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


    // Halaman Blank
    Route::get('/admin/blankpage', function () {
        return view('admin.blankpage');
    })->name('admin.blankpage');

});
    

// Halaman Landing Pelanggan
// Route::get('/pelanggan', function () {
//     return view('pelanggan.layout.landing_page');
// })->name('pelanggan.index');
