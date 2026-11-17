<?php

namespace App\Http\Controllers;

use App\Models\AjukanSponsor;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AjukanSponsorController extends Controller
{
    public function index()
    {
        return response()->json(AjukanSponsor::latest()->get());
    }

    // Form Ajukan Sponsor Pelanggan
    public function create()
    {
        return view('pelanggan.ajukan_sponsor');
    }

    // Simpan Pengajuan Sponsor
    public function store(Request $request)
    {
        $idPelanggan = session('pelanggan_id')
            ?? session('id_pelanggan');

        if (!$idPelanggan) {
            return redirect()->route('login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        $data = $request->validate([
            'nama_kegiatan' => 'required|string|max:150',
            'nama_penyelenggara' => 'required|string|max:150',
            'tanggal_kegiatan' => 'required|date',
            'lokasi_kegiatan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'file_proposal' => 'required|mimes:pdf|max:5120',
        ]);

        $data['id_pelanggan'] = $idPelanggan;
        $data['file_proposal'] = $request->file('file_proposal')
            ->store('proposal', 'public');
        $data['status'] = 'diajukan';
        $data['tanggal_pengajuan'] = now();

        // Simpan pengajuan sponsor
        $pengajuan = AjukanSponsor::create($data);

        // Buat notifikasi untuk pelanggan
        Notifikasi::create([
            'id_pelanggan' => $idPelanggan,
            'id_pengajuan' => $pengajuan->id_pengajuan,
            'judul' => 'Pengajuan Sponsor Berhasil',
            'pesan' => 'Pengajuan sponsor untuk kegiatan "'
                . $pengajuan->nama_kegiatan
                . '" berhasil dikirim dan sedang menunggu pemeriksaan admin.',
            'status_baca' => false,
            'created_at' => now(),
        ]);

        return redirect()
            ->route('pelanggan.riwayat')
            ->with('success', 'Pengajuan sponsor berhasil dikirim!');
    }

    public function show($id)
    {
        return response()->json(AjukanSponsor::findOrFail($id));
    }

    public function edit($id)
    {
        return response()->json(AjukanSponsor::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $record = AjukanSponsor::findOrFail($id);

        $data = $request->validate([
            'id_pelanggan' => 'required|exists:pelanggans,id_pelanggan',
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

    // Kelola Sponsor Admin
    public function halamanKelolaSponsor()
    {
        $pengajuans = AjukanSponsor::with('pelanggan')
            ->whereNotIn('status', ['selesai', 'ditolak'])
            ->orderByDesc('tanggal_pengajuan')
            ->paginate(20);

        return view('admin.kelolasponsor', compact('pengajuans'));
    }

    // Update Status Sponsor Admin
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

    // Riwayat Sponsor Admin
    public function halamanRiwayatSponsor(Request $request): View
    {
        $request->validate([
            'q' => ['nullable', 'string', 'max:100'],
            'status' => ['nullable', Rule::in(['selesai', 'ditolak'])],
            'dari' => ['nullable', 'date'],
            'sampai' => ['nullable', 'date', 'after_or_equal:dari'],
        ]);

        $query = AjukanSponsor::whereIn('status', ['selesai', 'ditolak']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('q')) {
            $q = $request->q;

            $query->where(function ($w) use ($q) {
                $w->where('nama_penyelenggara', 'like', "%{$q}%")
                    ->orWhere('nama_kegiatan', 'like', "%{$q}%");
            });
        }

        if ($request->filled('dari')) {
            $query->whereDate('tanggal_pengajuan', '>=', $request->dari);
        }

        if ($request->filled('sampai')) {
            $query->whereDate('tanggal_pengajuan', '<=', $request->sampai);
        }

        $riwayat = $query
            ->orderByDesc('tanggal_pengajuan')
            ->orderByDesc('id_pengajuan')
            ->paginate(15)
            ->withQueryString();

        $ringkasan = AjukanSponsor::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $totalRiwayat = $ringkasan->only(['selesai', 'ditolak'])->sum();

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

    // Riwayat Sponsor Pelanggan
    public function riwayat(Request $request)
    {
        $idPelanggan = session('pelanggan_id') ?? session('id_pelanggan');

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

        $riwayat = AjukanSponsor::where('id_pelanggan', $idPelanggan)
            ->when($request->filled('q'), function ($query) use ($request) {
                $q = $request->q;

                $query->where(function ($sub) use ($q) {
                    $sub->where('nama_kegiatan', 'like', "%{$q}%")
                        ->orWhere('nama_penyelenggara', 'like', "%{$q}%");
                });
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->orderByDesc('tanggal_pengajuan')
            ->paginate(10)
            ->withQueryString();

        return view('pelanggan.riwayat', compact(
            'riwayat',
            'status',
            'warna'
        ));
    }
}