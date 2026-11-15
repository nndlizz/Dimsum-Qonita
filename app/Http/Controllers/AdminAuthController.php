<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    // 1. Menampilkan halaman form login
    public function showLogin()
    {
        return view('admin.login');
    }

    // 2. Memproses login satu pintu (Admin & Pelanggan)
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cek dulu apakah login sebagai Admin (tabel: admin)
        $admin = DB::table('admin')->where('email', $request->email)->first();
        if ($admin && Hash::check($request->password, $admin->password)) {
            session([
                'admin_id' => $admin->id_admin ?? $admin->id,
                'nama_admin' => $admin->nama_admin ?? $admin->nama ?? 'Admin',
            ]);
            return redirect()->route('admin.dashboard');
        }

        // Jika bukan admin, cek sebagai Pelanggan (tabel: pelanggan)
        $pelanggan = DB::table('pelanggan')->where('email', $request->email)->first();
        if ($pelanggan && Hash::check($request->password, $pelanggan->password)) {
            session([
                'pelanggan_id' => $pelanggan->id_pelanggan ?? $pelanggan->id,
                'nama_pelanggan' => $pelanggan->nama_pelanggan ?? $pelanggan->nama ?? 'Pelanggan',
            ]);

            // Arahkan kembali ke halaman sebelumnya atau ke landing page
            return redirect()->intended(route('home'));
        }

        // Jika email atau password salah
        return back()->withInput($request->only('email'))->with('error', 'Email atau password salah.');
    }

    // 3. Logout (menghapus session admin maupun pelanggan)
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('login')->with('success', 'Berhasil logout.');
    }
}