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
        ]);

        // 1. Cek ke tabel 'admin' (menggunakan pengecekan manual yang sesuai dengan struktur database asli)
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

        // 2. Cek ke tabel 'pelanggan' (jika nanti sudah ada, bisa dilewati dulu atau disesuaikan)
        // $pelanggan = DB::table('pelanggans')->where('email', $request->email)->first();
        // if ($pelanggan && Hash::check($request->password, $pelanggan->password)) {
        //     $request->session()->regenerate();
        //     session([
        //         'pelanggan_id' => $pelanggan->id,
        //         'pelanggan_name' => $pelanggan->nama,
        //     ]);
        //     return redirect()->intended('/pelanggan/dashboard');
        // }

        // 3. Jika gagal / password salah
        return back()
            ->withErrors([
                'login' => 'Email atau kata sandi salah.'
            ])
            ->onlyInput('email');
    }

    public function logout(Request $request)
    {
        // Hapus session admin & pelanggan
        $request->session()->forget(['admin_id', 'admin_name', 'pelanggan_id', 'pelanggan_name']);
        
        Auth::guard('admin')->logout();
        Auth::guard('pelanggan')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Berhasil logout.');
    }
}