<?php

namespace App\Http\Controllers;

use App\Models\RiwayatSponsor;
use Illuminate\Http\Request;

class RiwayatSponsorController extends Controller
{
    public function index() { return response()->json(RiwayatSponsor::latest()->get()); }
    public function create() { return response()->json(['message' => 'Form create']); }
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_pengajuan' => 'required|exists:ajukan_sponsor,id_pengajuan',
            'id_admin' => 'nullable|exists:admin,id_admin',
            'status_sebelumnya' => 'nullable|string|max:30',
            'status_baru' => 'required|string|max:30',
            'catatan' => 'nullable|string',
            'tanggal_perubahan' => 'sometimes|date',
        ]);
        return response()->json(RiwayatSponsor::create($data), 201);
    }
    public function show($id) { return response()->json(RiwayatSponsor::findOrFail($id)); }
    public function edit($id) { return response()->json(RiwayatSponsor::findOrFail($id)); }
    public function update(Request $request, $id)
    {
        $record = RiwayatSponsor::findOrFail($id);
        $data = $request->validate([
            'id_pengajuan' => 'required|exists:ajukan_sponsor,id_pengajuan',
            'id_admin' => 'nullable|exists:admin,id_admin',
            'status_sebelumnya' => 'nullable|string|max:30',
            'status_baru' => 'required|string|max:30',
            'catatan' => 'nullable|string',
            'tanggal_perubahan' => 'sometimes|date',
        ]);
        $record->update($data);
        return response()->json($record);
    }
    public function destroy($id)
    {
        RiwayatSponsor::findOrFail($id)->delete();
        return response()->noContent();
    }
}
