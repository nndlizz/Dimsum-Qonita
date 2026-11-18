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
            'nama_admin'    => ['required', 'string', 'max:255'],
            'email'         => ['required', 'email', 'max:255', Rule::unique('admin', 'email')->ignore($admin->id_admin, 'id_admin')],
            'nomor_hp'      => ['nullable', 'string', 'max:20'],
            'jenis_kelamin' => ['nullable', Rule::in(['Laki-laki', 'Perempuan'])],
            'alamat'        => ['nullable', 'string', 'max:1000'],
            'gambar'        => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $dataUpdate = [
            'nama_admin'    => $validated['nama_admin'],
            'email'         => $validated['email'],
            'nomor_hp'      => $validated['nomor_hp'] ?? null,
            'jenis_kelamin' => $validated['jenis_kelamin'] ?? null,
            'alamat'        => $validated['alamat'] ?? null,
            'updated_at'    => now(),
        ];

        // Simpan foto baru ke folder public/uploads/admin agar kompak dengan Daftar Akun
        if ($request->hasFile('gambar')) {
            // Hapus foto lama jika ada di folder uploads/admin
            if (!empty($admin->gambar) && file_exists(public_path('uploads/admin/' . $admin->gambar))) {
                @unlink(public_path('uploads/admin/' . $admin->gambar));
            }

            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            
            // Pindahkan file ke folder public/uploads/admin
            $file->move(public_path('uploads/admin'), $filename);
            
            $dataUpdate['gambar'] = $filename;
        }

        DB::table('admin')
            ->where('id_admin', $admin->id_admin)
            ->update($dataUpdate);

        // Perbarui nama admin yang ditampilkan pada navbar.
        session([
            'admin_name' => $validated['nama_admin'],
        ]);

        return redirect()
            ->route('admin.profil')
            ->with('success', 'Profil admin berhasil diperbarui!');
    }
}
