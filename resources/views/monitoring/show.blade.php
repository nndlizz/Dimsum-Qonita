@extends('layouts.admin')

@section('title', 'Riwayat Sponsor')

@section('content')
@include('monitoring._tema')
@php
    $status = \App\Models\Sponsor::STATUS;
    $warna  = \App\Models\Sponsor::WARNA;
@endphp
<div class="tema-qonita">

<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
    <h4 class="mb-0">Riwayat Sponsor</h4>
    <a href="{{ route('monitoring.index') }}" class="btn btn-outline-primary btn-sm">&larr; Kembali ke Monitoring</a>
</div>

{{-- Ringkasan --}}
<div class="row g-2 mb-3 ringkasan">
    <div class="col-6 col-md">
        <div class="card text-center h-100">
            <div class="card-body py-3">
                <div class="fs-3 fw-bold text-dark">{{ $totalRiwayat }}</div>
                <div class="small text-muted">Total pengajuan</div>
            </div>
        </div>
    </div>
    @foreach ($status as $key => $label)
        <div class="col-6 col-md">
            <div class="card text-center h-100">
                <div class="card-body py-3">
                    <div class="fs-3 fw-bold text-dark">{{ $ringkasan[$key] ?? 0 }}</div>
                    <div class="small text-muted">{{ $label }}</div>
                </div>
            </div>
        </div>
    @endforeach
</div>

{{-- Cari & filter --}}
<form method="GET" class="row g-2 mb-3 align-items-end">
    <div class="col-lg-4">
        <div class="input-group">
            <span class="input-group-text">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/></svg>
            </span>
            <input type="text" name="q" value="{{ request('q') }}" class="form-control"
                   placeholder="Cari sponsor / PIC / kegiatan">
        </div>
    </div>
    <div class="col-6 col-lg-2">
        <label class="form-label small mb-1">Status</label>
        <select name="status" class="form-select">
            <option value="">Semua status</option>
            @foreach ($status as $key => $label)
                <option value="{{ $key }}" @selected(request('status') === $key)>{{ $label }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-6 col-lg-2">
        <label class="form-label small mb-1">Diajukan dari</label>
        <input type="date" name="dari" value="{{ request('dari') }}"
               class="form-control @error('dari') is-invalid @enderror">
    </div>
    <div class="col-6 col-lg-2">
        <label class="form-label small mb-1">Sampai tanggal</label>
        <input type="date" name="sampai" value="{{ request('sampai') }}"
               class="form-control @error('sampai') is-invalid @enderror">
        @error('sampai') <div class="invalid-feedback">Tanggal akhir tidak boleh sebelum tanggal awal.</div> @enderror
    </div>
    <div class="col-6 col-lg-auto">
        <button class="btn btn-dark">Terapkan</button>
        @if (request()->hasAny(['q', 'status', 'dari', 'sampai']))
            <a href="{{ route('riwayat.index') }}" class="btn btn-link">Reset</a>
        @endif
    </div>
</form>

{{-- Tabel --}}
<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>Tanggal diajukan</th>
                    <th>Sponsor</th>
                    <th>Kegiatan</th>
                    <th>Dukungan</th>
                    <th>Status terakhir</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($riwayat as $r)
                    <tr>
                        <td class="text-nowrap">{{ $r->tanggal_pengajuan?->format('d-m-Y') ?? '-' }}</td>
                        <td>
                            <span class="fw-semibold">{{ $r->nama_sponsor }}</span>
                            <div class="small text-muted">{{ $r->nama_pic }}</div>
                        </td>
                        <td>{{ $r->nama_kegiatan ?: '-' }}</td>
                        <td>
                            {{ $r->bentuk_dukungan ?: '-' }}
                            @if ($r->nominal)
                                <div class="small text-muted">Rp {{ number_format($r->nominal, 0, ',', '.') }}</div>
                            @endif
                        </td>
                        <td>
                            <span class="badge text-bg-{{ $warna[$r->status] ?? 'secondary' }}">
                                {{ $status[$r->status] ?? $r->status }}
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('monitoring.show', $r) }}" class="btn btn-outline-primary btn-sm">Detail</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center text-muted py-4">Belum ada sponsor yang pernah diajukan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">{{ $riwayat->links() }}</div>
</div>
@endsection
