<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function index() { return response()->json(Notifikasi::latest()->get()); }
    public function create() { return response()->json(['message' => 'Form create']); }
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_pelanggan' => 'required|exists:pelanggan,id_pelanggan',
            'id_pengajuan' => 'nullable|exists:sponsor,id_pengajuan',
            'judul' => 'required|string|max:150',
            'pesan' => 'required|string',
            'status_baca' => 'sometimes|boolean',
        ]);
        return response()->json(Notifikasi::create($data), 201);
    }
    public function show($id) { return response()->json(Notifikasi::findOrFail($id)); }
    public function edit($id) { return response()->json(Notifikasi::findOrFail($id)); }
    public function update(Request $request, $id)
    {
        $record = Notifikasi::findOrFail($id);
        $data = $request->validate([
            'id_pelanggan' => 'required|exists:pelanggan,id_pelanggan',
            'id_pengajuan' => 'nullable|exists:sponsor,id_pengajuan',
            'judul' => 'required|string|max:150',
            'pesan' => 'required|string',
            'status_baca' => 'sometimes|boolean',
        ]);
        $record->update($data);
        return response()->json($record);
    }
    public function destroy($id)
    {
        Notifikasi::findOrFail($id)->delete();
        return response()->noContent();
    }
}
