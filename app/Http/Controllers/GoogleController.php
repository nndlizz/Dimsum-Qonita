<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')
            ->with(['prompt' => 'select_account'])
            ->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')
                ->stateless()
                ->user();

            if (!$googleUser->getEmail()) {
                return redirect('/')
                    ->with('error', 'Email Google tidak ditemukan.');
            }

            $pelanggan = Pelanggan::where(
                'email',
                $googleUser->getEmail()
            )->first();

            if (!$pelanggan) {
                $pelanggan = Pelanggan::create([
                    'nama_pelanggan' => $googleUser->getName()
                        ?? $googleUser->getNickname()
                        ?? 'Pelanggan',
                    'email' => $googleUser->getEmail(),
                    'password' => Hash::make(Str::random(32)),
                ]);
            }

            Auth::login($pelanggan);

            $request->session()->regenerate();

            session([
                'pelanggan_id' => $pelanggan->id,
                'nama_pelanggan' => $pelanggan->nama_pelanggan, // Pastikan variabel nama ini ada dan terisi
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
