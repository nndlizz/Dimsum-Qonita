
@extends('pelanggan.layout.app')

@section('title', 'Riwayat Sponsor Saya')

@section('content')
@include('monitoring._tema')

@php
    $status = [
        'diajukan' => 'Diajukan',
        'diterima' => 'Diterima',
        'ditolak' => 'Ditolak',
    ];
@endphp

<div class="tema-qonita riwayat-container">

    {{-- Judul --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
        <div>
            <h4 class="mb-1">Riwayat Sponsor Saya</h4>
            <p class="text-muted mb-0">
                Informasi perkembangan pengajuan sponsor kamu.
            </p>
        </div>

        @if (\Illuminate\Support\Facades\Route::has('pelanggan.sponsor.create'))
            <a href="{{ route('pelanggan.sponsor.create') }}" class="btn btn-ajukan">
                + Ajukan Sponsor
            </a>
        @endif
    </div>

    {{-- Pesan sukses --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Pencarian dan Filter --}}
    <form method="GET" class="row g-2 mb-4">
        <div class="col-md-5">
            <input
                type="text"
                name="q"
                value="{{ request('q') }}"
                class="form-control"
                placeholder="Cari sponsor atau kegiatan">
        </div>

        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="">Semua status</option>
                @foreach ($status as $key => $label)
                    <option value="{{ $key }}" @selected(request('status') === $key)>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-auto">
            <button type="submit" class="btn btn-cari">Cari</button>

            @if (request()->hasAny(['q', 'status']))
                <a href="{{ url()->current() }}" class="btn btn-link">Reset</a>
            @endif
        </div>
    </form>

    {{-- Daftar Riwayat --}}
    @forelse ($riwayat as $r)

        <div class="card riwayat-item">
            <div class="card-body">

                {{-- Header Card --}}
                <div class="d-flex flex-wrap justify-content-between align-items-start gap-2 pb-4 mb-4 riwayat-header">

                    <div>
                        <h5 class="mb-1">
                            {{ $r->nama_penyelenggara }}
                        </h5>

                        <div class="text-muted small">
                            Diajukan
                            {{ $r->tanggal_pengajuan?->format('d-m-Y H:i') ?? '-' }}
                        </div>
                    </div>

                    <span class="badge status-badge status-{{ strtolower($r->status) }}">
                        {{ $status[$r->status] ?? ucfirst($r->status) }}
                    </span>

                </div>

                {{-- Informasi Pengajuan --}}
                <div class="row g-4">

                    <div class="col-md-6">
                        <div class="small text-muted mb-1">Nama Kegiatan</div>
                        <div class="fw-semibold">
                            {{ $r->nama_kegiatan ?: '-' }}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="small text-muted mb-1">Tanggal Kegiatan</div>
                        <div>
                            {{ $r->tanggal_kegiatan?->format('d-m-Y') ?? '-' }}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="small text-muted mb-1">Lokasi Kegiatan</div>
                        <div>
                            {{ $r->lokasi_kegiatan ?: '-' }}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="small text-muted mb-1">Deskripsi Kegiatan</div>
                        <div>
                            {{ $r->deskripsi ?: '-' }}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="small text-muted mb-1">Catatan Admin</div>
                        <div>
                            {{ $r->catatan_admin ?: 'Belum ada catatan.' }}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="small text-muted mb-1">File Proposal</div>

                        @if ($r->file_proposal)
                            <a href="{{ asset('storage/' . $r->file_proposal) }}"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="link-proposal">
                                <i class="bi bi-file-earmark-pdf"></i>
                                Lihat Proposal
                            </a>
                        @else
                            <span class="text-muted">
                                Tidak ada file proposal.
                            </span>
                        @endif
                    </div>

                </div>

            </div>
        </div>

    @empty

        <div class="card">
            <div class="card-body text-center text-muted py-5">
                Kamu belum pernah mengajukan sponsor.
            </div>
        </div>

    @endforelse

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $riwayat->links() }}
    </div>

</div>

<style>
    .riwayat-container {
        background-color: #fff3e4;
        padding: 30px 9%;
        min-height: 70vh;
    }

    .riwayat-container h4 {
        color: #8b0000;
        font-weight: 700;
    }

    .riwayat-item {
        border: none;
        border-left: 5px solid #8b0000;
        border-radius: 15px;
        background: #fff;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.06);
        margin-bottom: 18px;
    }

    .riwayat-item .card-body {
        padding: 24px 28px;
    }

    .riwayat-header {
        border-bottom: 1px solid #f0dfcc;
    }

    .riwayat-header h5 {
        color: #8b0000;
        font-weight: 600;
    }

    .status-badge {
        padding: 8px 15px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
    }

    .status-diajukan {
        background-color: #fff0d5;
        color: #bd7900;
    }

    .status-diterima {
        background-color: #d9f2df;
        color: #168443;
    }

    .status-ditolak {
        background-color: #f8dddd;
        color: #c62828;
    }

    .btn-ajukan {
        background: #8b0000;
        color: white;
        border-radius: 20px;
        padding: 9px 18px;
    }

    .btn-ajukan:hover {
        background: #690000;
        color: white;
    }

    .btn-cari {
        background: #8b0000;
        color: white;
    }

    .btn-cari:hover {
        background: #690000;
        color: white;
    }

    .link-proposal {
        color: #8b0000;
        text-decoration: none;
        font-weight: 600;
    }

    .link-proposal:hover {
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .riwayat-container {
            padding: 24px 5%;
        }

        .riwayat-item .card-body {
            padding: 20px;
        }
    }
</style>
@endsection
