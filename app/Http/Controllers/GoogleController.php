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
                $pelanggan = Pelanggan::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'nama_pelanggan' => $googleUser->getName() ?? 'Pelanggan Google',
                    'password' => bcrypt(Str::random(16)),
                ]
            );
            }

            Auth::login($pelanggan);

            $request->session()->regenerate();

            session([
                'pelanggan_id' => $pelanggan->id_pelanggan,
                'nama_pelanggan' => $pelanggan->nama_pelanggan,
                'email_pelanggan' => $pelanggan->email,
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
