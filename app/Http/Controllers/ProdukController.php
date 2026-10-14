<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index() { return response()->json(Produk::latest()->get()); }
    public function create() { return response()->json(['message' => 'Form create']); }
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_produk' => 'required|string|max:150',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'gambar' => 'nullable|string|max:255',
            'id_admin' => 'required|exists:admin,id_admin',
        ]);
        return response()->json(Produk::create($data), 201);
    }
    public function show($id) { return response()->json(Produk::findOrFail($id)); }
    public function edit($id) { return response()->json(Produk::findOrFail($id)); }
    public function update(Request $request, $id)
    {
        $record = Produk::findOrFail($id);
        $data = $request->validate([
            'nama_produk' => 'required|string|max:150',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'gambar' => 'nullable|string|max:255',
            'id_admin' => 'required|exists:admin,id_admin',
        ]);
        $record->update($data);
        return response()->json($record);
    }
    public function destroy($id)
    {
        Produk::findOrFail($id)->delete();
        return response()->noContent();
    }
}
