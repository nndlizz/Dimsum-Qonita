<?php

namespace App\Http\Controllers;

use App\Models\AjukanSponsor;
use Illuminate\Http\Request;
use App\Models\Notifikasi;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AjukanSponsorController extends Controller
{
    public function index() { return response()->json(AjukanSponsor::latest()->get()); }
    public function create()
    {
        return view('pelanggan.ajukan_sponsor');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_pelanggan' => 'required|exists:pelanggan,id_pelanggan',
            'nama_kegiatan' => 'required|string|max:150',
            'nama_penyelenggara' => 'required|string|max:150',
            'tanggal_kegiatan' => 'required|date',
            'lokasi_kegiatan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'file_proposal' => 'required|mimes:pdf|max:5120',
        ]);

        $data['file_proposal'] = $request
            ->file('file_proposal')
            ->store('proposal', 'public');

        $data['status'] = 'diajukan';
        $data['tanggal_pengajuan'] = now();

        AjukanSponsor::create($data);

        return redirect()
            ->route('pelanggan.sponsor.create')
            ->with('success', 'Pengajuan sponsor berhasil dikirim!');
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
            ->whereNotIn('status', ['selesai', 'ditolak'])
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

    public function halamanRiwayatSponsor(Request $request): View
    {
        $request->validate([
            'q'      => ['nullable', 'string', 'max:100'],
            'status' => ['nullable', 'string', 'max:30'],
            'dari'   => ['nullable', 'date'],
            'sampai' => ['nullable', 'date', 'after_or_equal:dari'],
        ]);

        $query = AjukanSponsor::whereIn('status', ['selesai', 'ditolak']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($w) use ($q) {
                $w->where('nama_sponsor', 'like', "%{$q}%")
                  ->orWhere('nama_pic', 'like', "%{$q}%")
                  ->orWhere('nama_kegiatan', 'like', "%{$q}%");
            });
        }

        if ($request->filled('dari')) {
            $query->whereDate('tanggal_pengajuan', '>=', $request->dari);
        }

        if ($request->filled('sampai')) {
            $query->whereDate('tanggal_pengajuan', '<=', $request->sampai);
        }

        $riwayat = $query->orderByDesc('tanggal_pengajuan')
            ->orderByDesc('id_sponsor')
            ->paginate(15)
            ->withQueryString();

        $ringkasan = AjukanSponsor::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $totalRiwayat = $ringkasan->sum();

        $status = [
            'diajukan' => 'Diajukan',
            'diproses' => 'Diproses',
            'diterima' => 'Diterima',
            'ditolak' => 'Ditolak',
            'selesai' => 'Selesai',
        ];

        $warna = [
            'diajukan' => 'warning',
            'diproses' => 'info',
            'diterima' => 'success',
            'ditolak' => 'danger',
            'selesai' => 'secondary',
        ];

        return view('admin.riwayat_sponsor', compact(
            'riwayat',
            'ringkasan',
            'totalRiwayat',
            'status',
            'warna'
        ));
    }
}
