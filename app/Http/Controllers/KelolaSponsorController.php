<?php

namespace App\Http\Controllers;

use App\Models\KelolaSponsor;
use Illuminate\Http\Request;

class KelolaSponsorController extends Controller
{
    public function index() { return response()->json(KelolaSponsor::latest()->get()); }
    public function create() { return response()->json(['message' => 'Form create']); }
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_pengajuan' => 'required|exists:ajukan_sponsor,id_pengajuan',
            'id_admin' => 'required|exists:admin,id_admin',
            'status' => 'required|string|max:30',
            'catatan' => 'nullable|string',
            'tanggal_keputusan' => 'nullable|date',
        ]);
        return response()->json(KelolaSponsor::create($data), 201);
    }
    public function show($id) { return response()->json(KelolaSponsor::findOrFail($id)); }
    public function edit($id) { return response()->json(KelolaSponsor::findOrFail($id)); }
    public function update(Request $request, $id)
    {
        $record = KelolaSponsor::findOrFail($id);
        $data = $request->validate([
            'id_pengajuan' => 'required|exists:ajukan_sponsor,id_pengajuan',
            'id_admin' => 'required|exists:admin,id_admin',
            'status' => 'required|string|max:30',
            'catatan' => 'nullable|string',
            'tanggal_keputusan' => 'nullable|date',
        ]);
        $record->update($data);
        return response()->json($record);
    }
    public function destroy($id)
    {
        KelolaSponsor::findOrFail($id)->delete();
        return response()->noContent();
    }
}
