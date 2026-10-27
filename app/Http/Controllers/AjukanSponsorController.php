<?php

namespace App\Http\Controllers;

use App\Models\AjukanSponsor;
use Illuminate\Http\Request;
use App\Models\Notifikasi;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

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
        $pengajuans = AjukanSponsor::with('pelanggan')
            ->orderByDesc('tanggal_pengajuan')
            ->paginate(20);

        return view('admin.kelolasponsor', compact('pengajuans'));
    }

    public function updateStatus(Request $request, $id)
    {
        $data = $request->validate([
            'status' => [
                'required',
                Rule::in([
                    'diajukan',
                    'diproses',
                    'diterima',
                    'ditolak',
                    'selesai',
                ]),
            ],
            'catatan_admin' => 'nullable|string|max:5000',
        ]);

        DB::transaction(function () use ($data, $id) {
            $pengajuan = AjukanSponsor::findOrFail($id);

            $pengajuan->status = $data['status'];
            $pengajuan->catatan_admin = $data['catatan_admin'] ?? null;
            $pengajuan->save();

            $pesan = 'Status pengajuan sponsor "' .
                $pengajuan->nama_kegiatan .
                '" diperbarui menjadi: ' .
                $pengajuan->status . '.';

            if (!empty($data['catatan_admin'])) {
                $pesan .= ' Catatan admin: ' . $data['catatan_admin'];
            }

            Notifikasi::create([
                'id_pelanggan' => $pengajuan->id_pelanggan,
                'id_pengajuan' => $pengajuan->id_pengajuan,
                'judul' => 'Pembaruan Pengajuan Sponsor',
                'pesan' => $pesan,
                'status_baca' => false,
                'created_at' => now(),
            ]);
        });

        return redirect()
            ->route('admin.kelolasponsor')
            ->with('success', 'Status sponsor berhasil diperbarui.');
    }


}
