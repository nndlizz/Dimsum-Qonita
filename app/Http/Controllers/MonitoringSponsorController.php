<?php

namespace App\Http\Controllers;

use App\Models\KeputusanSponsor;
use App\Models\PengajuanSponsor;
use App\Models\RiwayatPengajuan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class MonitoringSponsorController extends Controller
{
    /** Daftar pengajuan + ringkasan per status */
    public function index(Request $request): View
    {
        $query = PengajuanSponsor::query()
            ->join('pelanggan', 'pelanggan.id_pelanggan', '=', 'ajukan_sponsor.id_pelanggan')
            ->select('ajukan_sponsor.*', 'pelanggan.nama_pelanggan');

        if ($request->filled('status')) {
            $query->where('ajukan_sponsor.status', $request->status);
        }

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($w) use ($q) {
                $w->where('ajukan_sponsor.nama_kegiatan', 'like', "%{$q}%")
                  ->orWhere('ajukan_sponsor.nama_penyelenggara', 'like', "%{$q}%")
                  ->orWhere('pelanggan.nama_pelanggan', 'like', "%{$q}%");
            });
        }

        $pengajuan = $query->orderByDesc('ajukan_sponsor.tanggal_pengajuan')
            ->paginate(10)
            ->withQueryString();

        $ringkasan = PengajuanSponsor::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $isi = $this->isiKonten();

        return view('monitoring.index', compact('pengajuan', 'ringkasan', 'isi'));
    }

    /**
     * 8 isi konten untuk kartu di atas halaman.
     * Tiap angka diambil terpisah dan dibungkus try/catch: kalau tabelnya belum ada
     * (atau kolomnya beda), nilainya null dan kartu menampilkan "-" tanpa membuat halaman error.
     */
    private function isiKonten(): array
    {
        $coba = function (callable $f) {
            try {
                return $f();
            } catch (\Throwable $e) {
                return null;
            }
        };

        $lokasiResto = $coba(fn () => DB::table('cabang')->where('jenis', 'resto')->pluck('alamat'));

        return [
            'diterima'      => $coba(fn () => PengajuanSponsor::where('status', 'disetujui')->count()),
            'ditolak'       => $coba(fn () => PengajuanSponsor::where('status', 'ditolak')->count()),
            'total_admin'   => $coba(fn () => DB::table('admin')->count()),
            'jumlah_cabang' => $coba(fn () => DB::table('cabang')->count()),
            'jumlah_produk' => $coba(fn () => DB::table('produk')->count()),
            'jumlah_kategori' => $coba(fn () => DB::table('kategori')->count()),
            'lokasi_utama'  => $coba(fn () => DB::table('cabang')->where('jenis', 'utama')->value('alamat')),
            'lokasi_resto'  => $lokasiResto,
        ];
    }

    /** Detail pengajuan + keputusan + riwayat perubahan status */
    public function show(PengajuanSponsor $pengajuan): View
    {
        $pengajuan->load(['keputusan', 'riwayat']);

        $pelanggan = DB::table('pelanggan')
            ->where('id_pelanggan', $pengajuan->id_pelanggan)
            ->first();

        // id_admin => nama_admin, untuk menampilkan siapa yang mengubah status
        $namaAdmin = DB::table('admin')->pluck('nama_admin', 'id_admin');

        return view('monitoring.show', compact('pengajuan', 'pelanggan', 'namaAdmin'));
    }

    /**
     * Ubah status pengajuan. Sekaligus:
     *  - memperbarui ajukan_sponsor.status
     *  - menyimpan keputusan di kelola_sponsor (satu baris per pengajuan)
     *  - mencatat perubahan di riwayat_sponsor
     */
    public function updateStatus(Request $request, PengajuanSponsor $pengajuan): RedirectResponse
    {
        $data = $request->validate([
            'status'  => ['required', Rule::in(array_keys(PengajuanSponsor::STATUS))],
            'catatan' => ['nullable', 'string'],
        ]);

        $adminId = $this->adminId();
        if (! $adminId) {
            return back()->with('error', 'Admin yang sedang login tidak terbaca. Cek method adminId() di controller ini.');
        }

        $statusLama = $pengajuan->status;

        if ($statusLama === $data['status'] && empty($data['catatan'])) {
            return back()->with('error', 'Tidak ada perubahan.');
        }

        DB::transaction(function () use ($pengajuan, $data, $adminId, $statusLama) {
            $pengajuan->update(['status' => $data['status']]);

            KeputusanSponsor::updateOrCreate(
                ['id_pengajuan' => $pengajuan->id_pengajuan],
                [
                    'id_admin'          => $adminId,
                    'status'            => $data['status'],
                    'catatan'           => $data['catatan'] ?? null,
                    'tanggal_keputusan' => in_array($data['status'], ['disetujui', 'ditolak'], true) ? now() : null,
                ]
            );

            RiwayatPengajuan::create([
                'id_pengajuan'      => $pengajuan->id_pengajuan,
                'id_admin'          => $adminId,
                'status_sebelumnya' => $statusLama,
                'status_baru'       => $data['status'],
                'catatan'           => $data['catatan'] ?? null,
            ]);
        });

        return back()->with('success', 'Status diubah menjadi: ' . PengajuanSponsor::STATUS[$data['status']]);
    }

    /**
     * ID admin yang sedang login (kolom id_admin di tabel `admin`).
     * Sesuaikan dengan cara login buatan temanmu:
     *  - guard bernama 'admin'  -> sudah ditangani di bawah
     *  - login manual lewat session -> pakai session('id_admin')
     */
    private function adminId(): ?int
    {
        try {
            $id = Auth::guard('admin')->id();
        } catch (\InvalidArgumentException $e) {
            $id = null; // guard 'admin' belum didefinisikan
        }

        if ($id) {
            return (int) $id;
        }

        return session('id_admin') ? (int) session('id_admin') : null;
    }
}
