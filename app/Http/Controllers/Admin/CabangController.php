<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cabang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CabangController extends Controller
{
    // Menampilkan daftar cabang
    public function index()
    {
        $cabangs = Cabang::latest()->paginate(5);

        return view('admin.cabang.index', compact('cabangs'));
    }

    // Menampilkan form tambah cabang
    public function create()
    {
        return view('admin.cabang.create');
    }

    // Menyimpan cabang baru

public function store(Request $request)
{
    $request->validate([
        'nama_cabang' => 'required|string|max:255|unique:cabangs,nama_cabang',
        'alamat' => 'required|string|max:500',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ], [
        'nama_cabang.required' => 'Nama cabang wajib diisi.',
        'nama_cabang.unique' => 'Nama cabang sudah tersedia.',
        'alamat.required' => 'Alamat cabang wajib diisi.',
        'foto.image' => 'File harus berupa gambar.',
        'foto.mimes' => 'Foto harus berformat JPG, JPEG, PNG, atau WEBP.',
        'foto.max' => 'Ukuran foto maksimal 2 MB.',
    ]);

    $namaFoto = null;

    if ($request->hasFile('foto')) {
        $namaFoto = $request->file('foto')->store('foto-cabang', 'public');
    }

    Cabang::create([
        'nama_cabang' => $request->nama_cabang,
        'alamat' => $request->alamat,
        'foto' => $namaFoto,
    ]);

    return redirect()
        ->route('admin.cabang.index')
        ->with('success', 'Cabang berhasil ditambahkan!');
}


    // Menampilkan form edit cabang
    public function edit($id_cabang)
    {
        $cabang = Cabang::findOrFail($id_cabang);

        return view('admin.cabang.edit', compact('cabang'));
    }

    // Memperbarui data cabang

public function update(Request $request, $id_cabang)
{
    $cabang = Cabang::findOrFail($id_cabang);

    $request->validate([
        'nama_cabang' => 'required|string|max:255|unique:cabangs,nama_cabang,' . $id_cabang . ',id_cabang',
        'alamat' => 'required|string|max:500',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ], [
        'nama_cabang.required' => 'Nama cabang wajib diisi.',
        'nama_cabang.unique' => 'Nama cabang sudah digunakan cabang lain.',
        'alamat.required' => 'Alamat cabang wajib diisi.',
        'foto.image' => 'File harus berupa gambar.',
        'foto.mimes' => 'Foto harus berformat JPG, JPEG, PNG, atau WEBP.',
        'foto.max' => 'Ukuran foto maksimal 2 MB.',
    ]);

    $namaFoto = $cabang->foto;

    if ($request->hasFile('foto')) {
        if ($cabang->foto) {
            Storage::disk('public')->delete($cabang->foto);
        }

        $namaFoto = $request->file('foto')->store('foto-cabang', 'public');
    }

    $cabang->update([
        'nama_cabang' => $request->nama_cabang,
        'alamat' => $request->alamat,
        'foto' => $namaFoto,
    ]);

    return redirect()
        ->route('admin.cabang.index')
        ->with('success', 'Cabang berhasil diperbarui!');
}


    // Menghapus cabang

// Menghapus cabang
public function destroy($id_cabang)
{
    $cabang = Cabang::findOrFail($id_cabang);

    if ($cabang->produks()->exists()) {
        return redirect()
            ->route('admin.cabang.index')
            ->with('error', 'Cabang tidak dapat dihapus karena masih digunakan oleh produk.');
    }

    // Hapus foto dari penyimpanan jika ada
    if ($cabang->foto) {
        Storage::disk('public')->delete($cabang->foto);
    }

    // Hapus data cabang
    $cabang->delete();

    return redirect()
        ->route('admin.cabang.index')
        ->with('success', 'Cabang berhasil dihapus!');
}
}
