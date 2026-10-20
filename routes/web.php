```php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjukanSponsorController;


Route::get('/', function () {
    return redirect('/admin');
});

Route::get('/admin', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

// Route::get('/admin/kelolasponsor', function () {
//     return view('admin.kelolasponsor');
// })->name('admin.kelolasponsor');

Route::get(
    '/admin/kelolasponsor',
    [AjukanSponsorController::class, 'halamanKelolaSponsor']
)->name('admin.kelolasponsor');

Route::get('/admin/tables', function () {
    return view('admin.tables');
})->name('admin.tables');

Route::get('/admin/blankpage', function () {
    return view('admin.blankpage');
})->name('admin.blankpage');

Route::get('/admin/login', function () {
    return view('admin.login');
})->name('admin.login');