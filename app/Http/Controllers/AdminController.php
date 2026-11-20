<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::latest()->get();
        return view('admin.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.tambahakun');
    }

    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.edittambahakun', compact('admin'));
    }

    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);

        if (!empty($admin->gambar)) {
            $this->deleteAdminImage($admin->gambar);
        }

        $admin->delete();

        return redirect()->route('admin.akun.index')->with('success', 'Akun petugas berhasil dihapus!');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_admin'    => ['required', 'string', 'max:100'],
            'email'         => ['required', 'email', 'max:150', 'unique:admin,email'],
            'password'      => ['required', 'string', 'min:8', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[^A-Za-z0-9]/'],
            'nomor_hp'      => ['nullable', 'string', 'max:20'],
            'status'        => ['nullable', 'string', 'max:255'],
            'jenis_kelamin' => ['nullable', 'string', 'max:50'],
            'alamat'        => ['nullable', 'string'],
            'gambar'        => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ]);

        $data['password'] = Hash::make($data['password']);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('admin-profiles', 'public');
        }

        Admin::create($data);

        return redirect()->route('admin.akun.index')->with('success', 'Akun petugas berhasil ditambahkan!');
    }

    public function show(Admin $admin)
    {
        return response()->json($admin);
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $data = $request->validate([
            'nama_admin'    => ['sometimes', 'required', 'string', 'max:100'],
            'email'         => ['sometimes', 'required', 'email', 'max:150', Rule::unique('admin', 'email')->ignore($admin->id_admin, 'id_admin')],
            'password'      => ['nullable', 'string', 'min:8', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[^A-Za-z0-9]/'],
            'nomor_hp'      => ['nullable', 'string', 'max:20'],
            'status'        => ['nullable', 'string', 'max:255'],
            'jenis_kelamin' => ['nullable', 'string', 'max:50'],
            'alamat'        => ['nullable', 'string'],
            'gambar'        => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ]);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        if ($request->hasFile('gambar')) {
            $pathBaru = $request->file('gambar')->store('admin-profiles', 'public');

            if (!empty($admin->gambar) && $admin->gambar !== $pathBaru) {
                $this->deleteAdminImage($admin->gambar);
            }

            $data['gambar'] = $pathBaru;
        }

        $admin->update($data);

        $targetId = $admin->id_admin ?? $admin->id;
        if ((int) session('admin_id') === (int) $targetId) {
            $sessionUpdate = [];

            if (!empty($data['nama_admin'])) {
                $sessionUpdate['nama_admin'] = $data['nama_admin'];
                $sessionUpdate['admin_name'] = $data['nama_admin'];
            }

            if (!empty($data['gambar'])) {
                $sessionUpdate['admin_gambar'] = $data['gambar'];
            }

            if (!empty($sessionUpdate)) {
                session($sessionUpdate);
            }
        }

        return redirect()->route('admin.akun.index')->with('success', 'Akun petugas berhasil diperbarui!');
    }

    private function deleteAdminImage(string $gambar): void
    {
        if (Storage::disk('public')->exists($gambar)) {
            Storage::disk('public')->delete($gambar);
        }

        $legacyPath = public_path('uploads/admin/' . basename($gambar));
        if (file_exists($legacyPath)) {
            @unlink($legacyPath);
        }
    }
}