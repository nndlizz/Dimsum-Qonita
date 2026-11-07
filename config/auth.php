<?php

use App\Models\User;

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],

        // Tambahkan guard pelanggan di sini
        'pelanggan' => [
            'driver' => 'session',
            'provider' => 'pelanggans',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => env('AUTH_MODEL', App\Models\User::class),
        ],

        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class, // Sesuai model admin kamu
        ],

        // Tambahkan provider pelanggan di sini
        'pelanggans' => [
            'driver' => 'eloquent',
            'model' => App\Models\Pelanggan::class, // Pastikan Model Pelanggan ada
        ],
    ]];