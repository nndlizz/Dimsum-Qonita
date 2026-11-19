<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PelangganAuthController extends Controller
{
    public function index()
    {
        $pelangganId = session('pelanggan_id');

        $notifikasis = \App\Models\Notifikasi::where('id_pelanggan', $pelangganId)
            ->latest()
            ->get();

        return view('pelanggan.layout.landing_page', compact('notifikasis'));
    }

    public function showRegister()
    {
        return view('pelanggan.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|min:4|max:50|alpha_dash|unique:pelanggan,username',
            'password' => [
                'required',
                'string',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
            ],
        ], [
            'nama.required' => 'Nama lengkap wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.min' => 'Username minimal 4 karakter.',
            'username.max' => 'Username maksimal 50 karakter.',
            'username.alpha_dash' => 'Username hanya boleh berisi huruf, angka, tanda hubung (-), atau underscore (_).',
            'username.unique' => 'Username ini sudah digunakan, silakan pilih username lain.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal harus 8 karakter.',
            'password.mixed' => 'Password harus mengandung minimal satu huruf kapital dan satu huruf kecil.',
            'password.numbers' => 'Password harus mengandung minimal satu angka.',
            'password.symbols' => 'Password harus mengandung minimal satu simbol/tanda baca (seperti !, @, #, $).',
        ]);

        DB::table('pelanggan')->insert([
            'nama_pelanggan' => $request->nama,
            'username' => $request->username,
            'email' => null,
            'no_telepon' => null,
            'password' => Hash::make($request->password),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login menggunakan username dan password yang baru dibuat.');
    }
}