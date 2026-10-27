<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

        $admin = DB::table('admin')
            ->where('email', $request->email)
            ->first();

        // Bypass sementara pengecekan password untuk pengujian
        if (!$admin) {
            return back()
                ->withErrors(['login' => 'Email tidak ditemukan.'])
                ->onlyInput('email');
        }

        $request->session()->regenerate();

        session([
            'admin_id' => $admin->id_admin,
            'admin_name' => $admin->nama_admin,
        ]);
      

        return redirect('/admin');
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}
