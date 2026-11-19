<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class AdminAuthController extends Controller
{
    // 1. Menampilkan halaman form login (2 kolom tanpa layout landing page)
    public function showLogin()
    {
        return view('admin.login');
    }

    // 2. Memproses login satu pintu (Admin & Pelanggan)
    public function login(Request $request)
    {
        $request->validate([
            'login'    => 'required|string',
            'password' => 'required|string',
        ], [
            'login.required'    => 'Username atau email wajib diisi.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);

        $inputLogin = trim($request->input('login'));
        $password   = $request->input('password');

        // 1) Cek ke tabel admin (bisa pakai email atau username jika kolomnya tersedia)
        $adminQuery = DB::table('admin')->where('email', $inputLogin);
        if (Schema::hasColumn('admin', 'username')) {
            $adminQuery->orWhere('username', $inputLogin);
        }
        $admin = $adminQuery->first();

        if ($admin && Hash::check($password, $admin->password)) {
            $request->session()->regenerate();

            session([
                'admin_id'   => $admin->id_admin ?? $admin->id,
                'nama_admin' => $admin->nama_admin ?? $admin->nama ?? 'Admin',
            ]);

            return redirect()->route('admin.dashboard');
        }

        // 2) Cek ke tabel pelanggan (prioritas username, dan fallback ke email jika kolomnya ada)
        $pelangganQuery = DB::table('pelanggan');
        if (Schema::hasColumn('pelanggan', 'username') && Schema::hasColumn('pelanggan', 'email')) {
            $pelangganQuery->where(function ($q) use ($inputLogin) {
                $q->where('username', $inputLogin)
                  ->orWhere('email', $inputLogin);
            });
        } elseif (Schema::hasColumn('pelanggan', 'username')) {
            $pelangganQuery->where('username', $inputLogin);
        } else {
            $pelangganQuery->where('email', $inputLogin);
        }

        $pelanggan = $pelangganQuery->first();

        if ($pelanggan && Hash::check($password, $pelanggan->password)) {
            $request->session()->regenerate();

            session([
                'pelanggan_id'   => $pelanggan->id_pelanggan ?? $pelanggan->id,
                'nama_pelanggan' => $pelanggan->nama_pelanggan ?? $pelanggan->nama ?? 'Pelanggan',
                'username'       => $pelanggan->username ?? null,
            ]);

            return redirect()->intended(route('home'));
        }

        return back()
            ->withInput($request->only('login'))
            ->with('error', 'Username/email atau kata sandi salah.');
    }

    // 3. Logout (menghapus session admin maupun pelanggan)
    public function logout(Request $request)
    {
        $request->session()->forget([
            'admin_id',
            'nama_admin',
            'pelanggan_id',
            'nama_pelanggan',
            'username',
        ]);

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Anda telah berhasil keluar.');
    }
}