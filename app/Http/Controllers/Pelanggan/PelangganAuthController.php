<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PelangganAuthController extends Controller
{
    // Menampilkan form register pelanggan
    public function showRegister()
    {
        return view('pelanggan.register'); // Sesuaikan dengan nama view register kamu nanti
    }

    // Memproses data pendaftaran pelanggan baru
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:pelanggan', // pastikan nama tabel sesuai
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Simpan ke database tabel pelanggan
        DB::table('pelanggan')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}