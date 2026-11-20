<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AdminProfileController extends Controller
{
    private function getAuthenticatedAdmin()
    {
        $adminId = session('admin_id');

        if (!$adminId) {
            return null;
        }

        return DB::table('admin')
            ->where('id_admin', $adminId)
            ->first();
    }

    private function clearAdminSession(): void
    {
        session()->forget(['admin_id', 'nama_admin', 'admin_name', 'admin_gambar']);
    }

    private function loginRedirectRoute(): string
    {
        return Route::has('login') ? 'login' : 'admin.login';
    }

    public function index()
    {
        $admin = $this->getAuthenticatedAdmin();

        if (!$admin) {
            $this->clearAdminSession();

            return redirect()->route($this->loginRedirectRoute());
        }

        return view('admin.profil', compact('admin'));
    }

    public function edit()
    {
        $admin = $this->getAuthenticatedAdmin();

        if (!$admin) {
            $this->clearAdminSession();

            return redirect()->route($this->loginRedirectRoute());
        }

        return view('admin.edit-profil', compact('admin'));
    }

    public function update(Request $request)
    {
        $admin = $this->getAuthenticatedAdmin();

        if (!$admin) {
            $this->clearAdminSession();

            return redirect()->route($this->loginRedirectRoute());
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

        if ($request->hasFile('gambar')) {
            $pathGambarBaru = $request->file('gambar')
                ->store('admin-profiles', 'public');
        }

        $dataUpdate = [
            'nama_admin'    => $validated['nama_admin'],
            'email'         => $validated['email'],
            'nomor_hp'      => $validated['nomor_hp'] ?? null,
            'jenis_kelamin' => $validated['jenis_kelamin'] ?? null,
            'alamat'        => $validated['alamat'] ?? null,
            'updated_at'    => now(),
        ];

        if ($pathGambarBaru !== null) {
            $dataUpdate['gambar'] = $pathGambarBaru;
        }

        DB::table('admin')
            ->where('id_admin', $admin->id_admin)
            ->update($dataUpdate);

        if ($pathGambarBaru !== null && !empty($admin->gambar)) {
            if (Storage::disk('public')->exists($admin->gambar)) {
                Storage::disk('public')->delete($admin->gambar);
            }

            $legacyFile = public_path('uploads/admin/' . basename($admin->gambar));
            if (file_exists($legacyFile)) {
                @unlink($legacyFile);
            }
        }

        $sessionUpdate = [
            'nama_admin' => $validated['nama_admin'],
            'admin_name' => $validated['nama_admin'],
        ];

        if ($pathGambarBaru !== null) {
            $sessionUpdate['admin_gambar'] = $pathGambarBaru;
        }

        session($sessionUpdate);

        return redirect()
            ->route('admin.profil')
            ->with('success', 'Profil admin berhasil diperbarui!');
    }
}