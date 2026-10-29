@extends('layouts.admin')

@section('title', 'Monitoring Sponsor')

@section('content')
@include('monitoring._tema')
<div class="tema-qonita">
<h4 class="mb-3">Monitoring Sponsor</h4>

{{-- Isi konten (8 kartu) --}}
@php
    $kartu = [
        ['Sponsor diterima', $isi['diterima']],
        ['Sponsor ditolak', $isi['ditolak']],
        ['Total admin', $isi['total_admin']],
        ['Jumlah cabang', $isi['jumlah_cabang']],
        ['Jumlah produk', $isi['jumlah_produk']],
        ['Jumlah kategori', $isi['jumlah_kategori']],
    ];
    $resto = $isi['lokasi_resto'];
    $restoText = ($resto && $resto->count())
        ? $resto->first() . ($resto->count() > 1 ? ' (+' . ($resto->count() - 1) . ' lainnya)' : '')
        : null;
@endphp
<div class="row g-2 mb-3 ringkasan">
    @foreach ($kartu as [$label, $nilai])
        <div class="col-6 col-lg-4">
            <div class="card text-center h-100">
                <div class="card-body py-3">
                    <div class="fs-3 fw-bold text-dark">{{ $nilai ?? '-' }}</div>
                    <div class="small text-muted">{{ $label }}</div>
                </div>
            </div>
        </div>
    @endforeach
    <div class="col-12 col-lg-6">
        <div class="card h-100">
            <div class="card-body py-3">
                <div class="small text-muted">Lokasi utama</div>
                <div class="fw-semibold">{{ $isi['lokasi_utama'] ?? '-' }}</div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-6">
        <div class="card h-100">
            <div class="card-body py-3">
                <div class="small text-muted">Lokasi resto</div>
                <div class="fw-semibold">{{ $restoText ?? '-' }}</div>
            </div>
        </div>
    </div>
</div>

{{-- Filter cepat per status --}}
<ul class="nav nav-pills mb-3 gap-1">
    <li class="nav-item">
        <a class="nav-link {{ request('status') ? '' : 'active' }}"
           href="{{ route('monitoring.index', request()->only('q')) }}">Semua</a>
    </li>
    @foreach (\App\Models\PengajuanSponsor::STATUS as $key => $label)
        <li class="nav-item">
            <a class="nav-link {{ request('status') === $key ? 'active' : '' }}"
               href="{{ route('monitoring.index', array_merge(request()->only('q'), ['status' => $key])) }}">
                {{ $label }} ({{ $ringkasan[$key] ?? 0 }})
            </a>
        </li>
    @endforeach
</ul>

{{-- Cari & filter --}}
<form method="GET" class="row g-2 mb-3">
    <div class="col-md-5">
        <div class="input-group">
            <span class="input-group-text">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/></svg>
            </span>
            <input type="text" name="q" value="{{ request('q') }}" class="form-control"
                   placeholder="Cari kegiatan, penyelenggara, atau pelanggan">
        </div>
    </div>
    <div class="col-md-3">
        <select name="status" class="form-select">
            <option value="">Semua status</option>
            @foreach (\App\Models\PengajuanSponsor::STATUS as $key => $label)
                <option value="{{ $key }}" @selected(request('status') === $key)>{{ $label }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-auto">
        <button class="btn btn-dark">Cari</button>
        @if (request()->hasAny(['q', 'status']))
            <a href="{{ route('monitoring.index') }}" class="btn btn-link">Reset</a>
        @endif
    </div>
</form>

{{-- Tabel --}}
<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Kegiatan</th>
                    <th>Pelanggan</th>
                    <th>Tanggal kegiatan</th>
                    <th>Diajukan</th>
                    <th>Status</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pengajuan as $p)
                    <tr>
                        <td>
                            <a href="{{ route('monitoring.show', $p) }}" class="fw-semibold text-decoration-none">
                                {{ $p->nama_kegiatan }}
                            </a>
                            <div class="small text-muted">{{ $p->nama_penyelenggara }}</div>
                        </td>
                        <td>{{ $p->nama_pelanggan }}</td>
                        <td>{{ $p->tanggal_kegiatan?->format('d-m-Y') }}</td>
                        <td>{{ $p->tanggal_pengajuan?->format('d-m-Y') }}</td>
                        <td><span class="badge text-bg-{{ $p->warna_status }}">{{ $p->label_status }}</span></td>
                        <td class="text-end">
                            <a href="{{ route('monitoring.show', $p) }}" class="btn btn-sm btn-outline-primary">Detail</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center text-muted py-4">Belum ada pengajuan sponsor.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">{{ $pengajuan->links() }}</div>
</div>
@endsection
