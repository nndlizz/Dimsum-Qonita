<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

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
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:pelanggan,email',
            'no_hp' => 'required|string|max:20',
            'password' => [
                'required',
                'string',
                Password::min(8)
                    ->mixedCase() // Wajib huruf besar (kapital) & huruf kecil
                    ->numbers()   // Wajib ada angka
                    ->symbols(),  // Wajib ada simbol/tanda baca
            ],
        ], [
            // Custom pesan error dalam Bahasa Indonesia
            'nama.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah terdaftar, silakan gunakan email lain atau langsung login.',
            'no_hp.required' => 'Nomor WhatsApp / HP wajib diisi.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal harus 8 karakter.',
            'password.mixed' => 'Password harus mengandung minimal satu huruf kapital dan satu huruf kecil.',
            'password.numbers' => 'Password harus mengandung minimal satu angka.',
            'password.symbols' => 'Password harus mengandung minimal satu simbol/tanda baca (seperti !, @, #, $).',
        ]);

        DB::table('pelanggan')->insert([
            'nama_pelanggan' => $request->nama,
            'email' => $request->email,
            'no_telepon' => $request->no_hp,
            'password' => Hash::make($request->password),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}