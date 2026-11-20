<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

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

        $adminQuery = DB::table('admin')->where('email', $inputLogin);
        if (Schema::hasColumn('admin', 'username')) {
            $adminQuery->orWhere('username', $inputLogin);
        }
        $admin = $adminQuery->first();

        if ($admin && Hash::check($password, $admin->password)) {
            $request->session()->regenerate();
            $request->session()->forget(['pelanggan_id', 'nama_pelanggan', 'username']);

            $namaAdmin = $admin->nama_admin ?? $admin->nama ?? 'Admin';

            session([
                'admin_id'     => $admin->id_admin ?? $admin->id,
                'nama_admin'   => $namaAdmin,
                'admin_name'   => $namaAdmin,
                'admin_gambar' => $admin->gambar ?? null,
            ]);

            return redirect()->route('admin.dashboard');
        }

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
            $request->session()->forget(['admin_id', 'nama_admin', 'admin_name', 'admin_gambar']);

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

    public function logout(Request $request)
    {
        $request->session()->forget([
            'admin_id',
            'nama_admin',
            'admin_name',
            'admin_gambar',
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