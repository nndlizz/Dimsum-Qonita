<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    // Menampilkan notifikasi pelanggan
   public function index()
{
    $idPelanggan = session('pelanggan_id')
        ?? session('id_pelanggan')
        ?? Auth::guard('pelanggan')->id();

    if (!$idPelanggan) {
        return redirect('/')
            ->with('error', 'Silakan login terlebih dahulu.');
    }

    // Tandai semua notifikasi pelanggan sebagai sudah dibaca
    Notifikasi::where('id_pelanggan', $idPelanggan)
        ->where('status_baca', false)
        ->update(['status_baca' => true]);

    // Ambil notifikasi beserta status pengajuan sponsor
    $notifikasi = Notifikasi::with('pengajuan')
        ->where('id_pelanggan', $idPelanggan)
        ->orderByDesc('created_at')
        ->get();

    return view('pelanggan.notifikasi', compact('notifikasi'));
}

    public function create()
    {
        return response()->json(['message' => 'Form create']);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_pelanggan' => 'required|exists:pelanggan,id_pelanggan',
            'id_pengajuan' => 'nullable|exists:sponsors,id_pengajuan',
            'judul' => 'required|string|max:150',
            'pesan' => 'required|string',
            'status_baca' => 'sometimes|boolean',
        ]);

        return response()->json(Notifikasi::create($data), 201);
    }

    public function show($id)
    {
        $record = Notifikasi::with('pengajuan')
            ->where('id_pelanggan', Auth::guard('pelanggan')->id())
            ->findOrFail($id);

        return response()->json($record);
    }

    public function edit($id)
    {
        return $this->show($id);
    }

    public function update(Request $request, $id)
    {
        $record = Notifikasi::where(
            'id_pelanggan',
            Auth::guard('pelanggan')->id()
        )->findOrFail($id);

        $data = $request->validate([
            'id_pengajuan' => 'nullable|exists:sponsors,id_pengajuan',
            'judul' => 'required|string|max:150',
            'pesan' => 'required|string',
            'status_baca' => 'sometimes|boolean',
        ]);

        $record->update($data);

        return response()->json($record);
    }

    public function destroy($id)
    {
        $record = Notifikasi::where(
            'id_pelanggan',
            Auth::guard('pelanggan')->id()
        )->findOrFail($id);

        $record->delete();

        return response()->noContent();
    }
}
