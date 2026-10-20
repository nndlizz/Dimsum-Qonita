<?php

namespace App\Http\Controllers;

use App\Models\AjukanSponsor;
use Illuminate\Http\Request;

class AjukanSponsorController extends Controller
{
    public function index() { return response()->json(AjukanSponsor::latest()->get()); }
    public function create() { return response()->json(['message' => 'Form create']); }
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_pelanggan' => 'required|exists:pelanggan,id_pelanggan',
            'nama_kegiatan' => 'required|string|max:150',
            'nama_penyelenggara' => 'required|string|max:150',
            'tanggal_kegiatan' => 'required|date',
            'lokasi_kegiatan' => 'required|string',
            'deskripsi' => 'required|string',
            'file_proposal' => 'nullable|string|max:255',
            'status' => 'sometimes|string|max:30',
            'tanggal_pengajuan' => 'sometimes|date',
        ]);
        return response()->json(AjukanSponsor::create($data), 201);
    }
    public function show($id) { return response()->json(AjukanSponsor::findOrFail($id)); }
    public function edit($id) { return response()->json(AjukanSponsor::findOrFail($id)); }
    public function update(Request $request, $id)
    {
        $record = AjukanSponsor::findOrFail($id);
        $data = $request->validate([
            'id_pelanggan' => 'required|exists:pelanggan,id_pelanggan',
            'nama_kegiatan' => 'required|string|max:150',
            'nama_penyelenggara' => 'required|string|max:150',
            'tanggal_kegiatan' => 'required|date',
            'lokasi_kegiatan' => 'required|string',
            'deskripsi' => 'required|string',
            'file_proposal' => 'nullable|string|max:255',
            'status' => 'sometimes|string|max:30',
            'tanggal_pengajuan' => 'sometimes|date',
        ]);
        $record->update($data);
        return response()->json($record);
    }
    public function destroy($id)
    {
        AjukanSponsor::findOrFail($id)->delete();
        return response()->noContent();
    }

    public function halamanKelolaSponsor()
    {
        $pengajuans = AjukanSponsor::orderByDesc('tanggal_pengajuan')
        ->paginate(20);

        return view('admin.kelolasponsor', compact('pengajuans'));
    }
}
