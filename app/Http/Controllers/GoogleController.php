<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        try {
            // Ambil data akun Google
            $googleUser = Socialite::driver('google')
                ->stateless()
                ->user();

            // Pastikan email tersedia
            if (!$googleUser->getEmail()) {
                return redirect('/')
                    ->with('error', 'Email Google tidak ditemukan.');
            }

            // Cari pelanggan berdasarkan email
            $pelanggan = Pelanggan::where(
                'email',
                $googleUser->getEmail()
            )->first();

            // Jika belum terdaftar, buat akun pelanggan
            if (!$pelanggan) {
                $pelanggan = Pelanggan::create([
                    'nama_pelanggan' => $googleUser->getName()
                        ?? $googleUser->getNickname()
                        ?? 'Pelanggan',
                    'email' => $googleUser->getEmail(),
                    'password' => Hash::make(Str::random(32)),
                ]);
            }

            // Login pelanggan
            Auth::login($pelanggan);

            // Regenerasi session untuk keamanan
            $request->session()->regenerate();

            // Simpan ID sesuai primary key tabel pelanggan
            session([
                'pelanggan_id' => $pelanggan->id_pelanggan,
                'id_pelanggan' => $pelanggan->id_pelanggan,
            ]);

            return redirect('/')
                ->with('success', 'Login dengan Google berhasil!');

        } catch (\Exception $e) {
            report($e);

            return redirect('/')
                ->with('error', 'Login Google gagal: ' . $e->getMessage());
        }
    }
}