<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Cabang;
use Illuminate\Http\Request;

class ProdukController extends Controller
{

    public function index()
    {
        $produks = Produk::with(['kategori', 'cabangs'])->paginate(5);

        return view('admin.produk.index', compact('produks'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        $cabangs = Cabang::all();

        return view('admin.produk.create', compact('kategoris', 'cabangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'id_kategori' => 'required|exists:kategoris,id_kategori',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'cabang' => 'required|array|min:1',
            'cabang.*.id_cabang' => 'required|exists:cabangs,id_cabang',
            'cabang.*.harga' => 'required|numeric|min:0',
        ]);

        $gambar = null;

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('produk', 'public');
        }

        $produk = Produk::create([
            'nama_produk' => $request->nama_produk,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'gambar' => $gambar,
            'id_admin' => session('admin_id'),
            'id_kategori' => $request->id_kategori,
        ]);

        foreach ($request->cabang as $cabang) {
            $produk->cabangs()->attach($cabang['id_cabang'], [
                'harga' => $cabang['harga'],
            ]);
        }

        return redirect()
            ->route('admin.produk.create')
            ->with('success', 'Produk berhasil ditambahkan!');
    }
    public function edit($id_produk)
{
    $produk = Produk::with('cabangs')->findOrFail($id_produk);
    $kategoris = Kategori::all();
    $cabangs = Cabang::all();

    return view('admin.produk.edit', compact(
        'produk',
        'kategoris',
        'cabangs'
    ));
}


public function update(Request $request, $id_produk)
{
    $request->validate([
        'nama_produk' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
        'harga' => 'required|numeric|min:0',
        'id_kategori' => 'required|exists:kategoris,id_kategori',
        'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'cabangs' => 'required|array|min:1',
        'cabangs.*' => 'exists:cabangs,id_cabang',
    ]);

    $produk = Produk::findOrFail($id_produk);

    $data = [
        'nama_produk' => $request->nama_produk,
        'deskripsi' => $request->deskripsi,
        'harga' => $request->harga,
        'id_kategori' => $request->id_kategori,
    ];

    if ($request->hasFile('gambar')) {
        if ($produk->gambar) {
            \Illuminate\Support\Facades\Storage::disk('public')
                ->delete($produk->gambar);
        }

        $data['gambar'] = $request->file('gambar')
            ->store('produk', 'public');
    }

    $produk->update($data);
    $produk->cabangs()->sync($request->cabangs);

    return redirect()
        ->route('admin.produk.index')
        ->with('success', 'Produk berhasil diperbarui!');
}

public function destroy($id_produk)
{
    $produk = Produk::findOrFail($id_produk);

    if ($produk->gambar) {
        \Illuminate\Support\Facades\Storage::disk('public')
            ->delete($produk->gambar);
    }

    $produk->cabangs()->detach();
    $produk->delete();

    return redirect()
        ->route('admin.produk.index')
        ->with('success', 'Produk berhasil dihapus!');
}

}


