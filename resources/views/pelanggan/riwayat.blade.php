
@extends('pelanggan.layout.app')

@section('content')
<div class="container py-4">

    {{-- Header --}}
    <div class="mb-4">
        <h3 class="fw-bold mb-1" style="color:#43200f">
            Riwayat Sponsor
        </h3>
        <p class="text-muted mb-0">
            Pantau status dan detail pengajuan sponsor kamu.
        </p>
    </div>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Filter --}}
    <form method="GET" class="row g-2 mb-4">

        <div class="col-md-6">
            <input
                type="text"
                name="q"
                class="form-control"
                placeholder="Cari nama kegiatan atau penyelenggara..."
                value="{{ request('q') }}"
            >
        </div>

        <div class="col-md-4">
            <select name="status" class="form-select">
                <option value="">Semua Status</option>

                @foreach($status as $key => $label)
                    <option
                        value="{{ $key }}"
                        {{ request('status') == $key ? 'selected' : '' }}
                    >
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2">
            <button
                type="submit"
                class="btn text-white w-100"
                style="background:#850000"
            >
                <i class="bi bi-search me-1"></i>
                Cari
            </button>
        </div>

    </form>

    {{-- Tabel Riwayat --}}
    <div class="table-responsive shadow-sm rounded">
        <table class="table table-bordered table-hover align-middle mb-0">

            <thead style="background:#3b100e;color:white">
                <tr>
                    <th class="text-center" style="width:60px">No</th>
                    <th>Nama Kegiatan</th>
                    <th>Penyelenggara</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Tanggal Kegiatan</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Proposal</th>
                </tr>
            </thead>

            <tbody>
                @forelse($riwayat as $item)
                    <tr>
                        {{-- Nomor --}}
                        <td class="text-center">
                            {{ $riwayat->firstItem() + $loop->index }}
                        </td>

                        {{-- Nama Kegiatan --}}
                        <td>
                            <span class="fw-semibold">
                                {{ $item->nama_kegiatan }}
                            </span>
                        </td>

                        {{-- Penyelenggara --}}
                        <td>
                            {{ $item->nama_penyelenggara }}
                        </td>

                        {{-- Tanggal Pengajuan --}}
                        <td>
                            {{ $item->tanggal_pengajuan
                                ? \Carbon\Carbon::parse($item->tanggal_pengajuan)->format('d M Y')
                                : '-' }}
                        </td>

                        {{-- Tanggal Kegiatan --}}
                        <td>
                            {{ $item->tanggal_kegiatan
                                ? \Carbon\Carbon::parse($item->tanggal_kegiatan)->format('d M Y')
                                : '-' }}
                        </td>

                        {{-- Status --}}
                        <td class="text-center">
                            <span class="badge bg-{{ $warna[$item->status] ?? 'secondary' }}">
                                {{ $status[$item->status] ?? ucfirst($item->status) }}
                            </span>
                        </td>

                        {{-- File Proposal --}}
                        <td class="text-center">
                            @if($item->file_proposal)
                                <a
                                    href="{{ asset('storage/' . $item->file_proposal) }}"
                                    target="_blank"
                                    class="btn btn-sm btn-outline-danger"
                                    title="Lihat Proposal"
                                >
                                    <i class="bi bi-file-earmark-pdf"></i>
                                    Lihat
                                </a>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <i class="bi bi-folder2-open fs-1 text-muted d-block mb-2"></i>

                            <p class="fw-semibold mb-1">
                                Belum ada pengajuan sponsor.
                            </p>

                            <small class="text-muted">
                                Pengajuan sponsor yang kamu kirim akan muncul di sini.
                            </small>
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

    {{-- Pagination --}}
    @if($riwayat->hasPages())
        <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap gap-2">
            <small class="text-muted">
                Menampilkan {{ $riwayat->firstItem() }}–{{ $riwayat->lastItem() }}
                dari {{ $riwayat->total() }} pengajuan
            </small>

            {{ $riwayat->links() }}
        </div>
    @endif

</div>
@endsection