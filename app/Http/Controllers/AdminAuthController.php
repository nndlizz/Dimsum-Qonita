<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // 1. Cek ke tabel 'admin' terlebih dahulu
        $admin = DB::table('admin')->where('email', $request->email)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            $request->session()->regenerate();
            
            // Set session khusus admin sesuai yang dipakai di middleware AdminAuth
            session([
                'admin_id' => $admin->id_admin,
                'admin_name' => $admin->nama_admin,
            ]);

            return redirect()->intended('/admin')->with('success', 'Selamat datang, Admin!');
        }

        // 2. Cek ke tabel 'pelanggan' (diaktifkan & disesuaikan dengan kolom asli)
        $pelanggan = DB::table('pelanggan')->where('email', $request->email)->first();

        if ($pelanggan && Hash::check($request->password, $pelanggan->password)) {
            $request->session()->regenerate();
            
            // Set session khusus pelanggan sesuai middleware PelangganAuth
            session([
                'id_pelanggan' => $pelanggan->id_pelanggan,
                'pelanggan_name' => $pelanggan->nama_pelanggan,
            ]);

            return redirect()->intended(route('home'))->with('success', 'Selamat datang, ' . $pelanggan->nama_pelanggan . '!');
        }

        // 3. Jika gagal login di kedua tabel, kembalikan ke halaman login dengan pesan error
        return back()
            ->withErrors([
                'email' => 'Email atau kata sandi salah.'
            ])
            ->onlyInput('email');
    }

    public function logout(Request $request)
    {
        $request->session()->forget(['admin_id', 'admin_name', 'id_pelanggan', 'pelanggan_name']);
        
        Auth::guard('admin')->logout();
        Auth::guard('pelanggan')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Berhasil logout.');
    }
}