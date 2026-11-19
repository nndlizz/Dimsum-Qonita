<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\Produk;

class PelangganProfileController extends Controller
{
    // Menampilkan profil pelanggan
    public function index()
    {
        $pelanggan = DB::table('pelanggan')
            ->where('id_pelanggan', session('pelanggan_id'))
            ->first();

        if (!$pelanggan) {
            return redirect()->route('login')
                ->with('error', 'Data pelanggan tidak ditemukan.');
        }

        $cabangs = DB::table('cabangs')->get();
        $produks = Produk::with(['kategori', 'cabangs'])->get();

        return view('pelanggan.profil', compact(
            'pelanggan',
            'cabangs',
            'produks'
        ));
    }

    // Menampilkan halaman edit profil
    public function edit()
    {
        $pelanggan = DB::table('pelanggan')
            ->where('id_pelanggan', session('pelanggan_id'))
            ->first();

        if (!$pelanggan) {
            return redirect()->route('login')
                ->with('error', 'Data pelanggan tidak ditemukan.');
        }

        return view('pelanggan.edit_profil', compact('pelanggan'));
    }

    // Menyimpan perubahan profil dan password
    public function update(Request $request)
    {
        $id = session('pelanggan_id');

        $pelanggan = DB::table('pelanggan')
            ->where('id_pelanggan', $id)
            ->first();

        if (!$pelanggan) {
            return redirect()->route('login')
                ->with('error', 'Data pelanggan tidak ditemukan.');
        }

        $validated = $request->validate([
            'nama_pelanggan' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('pelanggan', 'email')
                    ->ignore($id, 'id_pelanggan')
            ],

            'no_telepon' => ['required', 'string', 'max:20'],

            'password_lama' => [
                'nullable',
                'required_with:password_baru'
            ],

            'password_baru' => [
                'nullable',
                'min:8',
                'confirmed'
            ],
        ]);

        // Jika pelanggan ingin mengganti password
        if ($request->filled('password_baru')) {

            if (!Hash::check(
                $request->password_lama,
                $pelanggan->password
            )) {
                return back()
                    ->withErrors([
                        'password_lama' => 'Password lama tidak sesuai.'
                    ])
                    ->withInput();
            }
        }

        $dataUpdate = [
            'nama_pelanggan' => $validated['nama_pelanggan'],
            'email' => $validated['email'],
            'no_telepon' => $validated['no_telepon'],
            'updated_at' => now(),
        ];

        // Password hanya diubah jika diisi
        if ($request->filled('password_baru')) {
            $dataUpdate['password'] = Hash::make(
                $request->password_baru
            );
        }

        DB::table('pelanggan')
            ->where('id_pelanggan', $id)
            ->update($dataUpdate);

        return redirect()
            ->route('pelanggan.profil')
            ->with('success', 'Profil berhasil diperbarui.');
    }
}