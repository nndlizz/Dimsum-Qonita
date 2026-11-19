<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AdminProfileController extends Controller
{
    public function index()
    {
        if (!session()->has('admin_id')) {
            return redirect()->route('admin.login');
        }

        $admin = DB::table('admin')
            ->where('id_admin', session('admin_id'))
            ->first();

        if (!$admin) {
            session()->forget(['admin_id', 'admin_name']);

            return redirect()->route('admin.login');
        }

        return view('admin.profil', compact('admin'));
    }

    public function edit()
    {
        if (!session()->has('admin_id')) {
            return redirect()->route('admin.login');
        }

        $admin = DB::table('admin')
            ->where('id_admin', session('admin_id'))
            ->first();

        if (!$admin) {
            session()->forget(['admin_id', 'admin_name']);

            return redirect()->route('admin.login');
        }

        return view('admin.edit-profil', compact('admin'));
    }

    public function update(Request $request)
    {
        if (!session()->has('admin_id')) {
            return redirect()->route('admin.login');
        }

        $admin = DB::table('admin')
            ->where('id_admin', session('admin_id'))
            ->first();

        if (!$admin) {
            session()->forget(['admin_id', 'admin_name']);

            return redirect()->route('admin.login');
        }

        $validated = $request->validate([
            'nama_admin' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('admin', 'email')
                    ->ignore($admin->id_admin, 'id_admin'),
            ],
            'nomor_hp' => [
                'nullable',
                'string',
                'max:20',
            ],
            'jenis_kelamin' => [
                'nullable',
                Rule::in(['Laki-laki', 'Perempuan']),
            ],
            'alamat' => [
                'nullable',
                'string',
                'max:1000',
            ],
            'gambar' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        $pathGambarBaru = null;

        // Simpan foto baru jika admin mengunggahnya.
        if ($request->hasFile('gambar')) {
            $pathGambarBaru = $request->file('gambar')
                ->store('admin-profiles', 'public');
        }

        $dataUpdate = [
            'nama_admin' => $validated['nama_admin'],
            'email' => $validated['email'],
            'nomor_hp' => $validated['nomor_hp'] ?? null,
            'jenis_kelamin' => $validated['jenis_kelamin'] ?? null,
            'alamat' => $validated['alamat'] ?? null,
            'updated_at' => now(),
        ];

        if ($pathGambarBaru !== null) {
            $dataUpdate['gambar'] = $pathGambarBaru;
        }

        DB::table('admin')
            ->where('id_admin', $admin->id_admin)
            ->update($dataUpdate);

        // Hapus foto lama setelah foto baru berhasil disimpan ke database.
        if (
            $pathGambarBaru !== null &&
            !empty($admin->gambar) &&
            Storage::disk('public')->exists($admin->gambar)
        ) {
            Storage::disk('public')->delete($admin->gambar);
        }

        // Perbarui nama admin yang ditampilkan pada navbar.
        session([
            'admin_name' => $validated['nama_admin'],
        ]);

        return redirect()
            ->route('admin.profil')
            ->with('success', 'Profil admin berhasil diperbarui!');
    }
}
