<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PelangganController extends Controller
{
    public function index() { return response()->json(Pelanggan::latest()->get()); }
    public function create() { return response()->json(['message' => 'Form create pelanggan']); }
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_pelanggan' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:150', 'unique:pelanggan,email'],
            'password' => ['required', 'string', 'min:8', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[^A-Za-z0-9]/'],
            'no_telepon' => ['nullable', 'string', 'max:20'],
            'alamat' => ['nullable', 'string'],
        ]);
        $data['password'] = Hash::make($data['password']);
        return response()->json(Pelanggan::create($data), 201);
    }
    public function show(Pelanggan $pelanggan) { return response()->json($pelanggan); }
    public function edit(Pelanggan $pelanggan) { return response()->json($pelanggan); }
    public function update(Request $request, Pelanggan $pelanggan)
    {
        $data = $request->validate([
            'nama_pelanggan' => ['sometimes', 'required', 'string', 'max:100'],
            'email' => ['sometimes', 'required', 'email', 'max:150', Rule::unique('pelanggan', 'email')->ignore($pelanggan->id_pelanggan, 'id_pelanggan')],
            'password' => ['sometimes', 'required', 'string', 'min:8', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[^A-Za-z0-9]/'],
            'no_telepon' => ['nullable', 'string', 'max:20'],
            'alamat' => ['nullable', 'string'],
        ]);
        if (isset($data['password'])) $data['password'] = Hash::make($data['password']);
        $pelanggan->update($data);
        return response()->json($pelanggan);
    }
    public function destroy(Pelanggan $pelanggan) { $pelanggan->delete(); return response()->noContent(); }
}
