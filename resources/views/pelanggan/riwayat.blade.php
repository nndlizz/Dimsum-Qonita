@extends('pelanggan.layout.app') {{-- Sesuaikan dengan layout pelanggan kamu --}}

@section('title', 'Riwayat Sponsor Saya')

@section('content')
<div class="container py-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
        <h4 class="mb-0 fw-bold">Riwayat Pengajuan Sponsor</h4>
        <a href="{{ route('pelanggan.sponsor.create') }}" class="btn btn-danger rounded-pill px-3">
            <i class="fas fa-handshake me-1"></i> Ajukan Sponsor Baru
        </a>
    </div>

    @if (session('success')) 
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div> 
    @endif

    {{-- Form Pencarian & Filter --}}
    <form method="GET" class="row g-2 mb-4">
        <div class="col-md-5">
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="fas fa-search text-muted"></i></span>
                <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Cari kegiatan atau penyelenggara...">
            </div>
        </div>
        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="">Semua Status</option>
                @foreach ($status as $key => $label)
                    <option value="{{ $key }}" @selected(request('status') === $key)>{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-dark">Cari</button>
            @if (request()->hasAny(['q', 'status', 'dari', 'sampai']))
                <a href="{{ url()->current() }}" class="btn btn-link text-decoration-none text-muted">Reset</a>
            @endif
        </div>
    </form>

    {{-- Daftar Riwayat --}}
    @forelse ($riwayat as $r)
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body">
                <div class="d-flex flex-wrap justify-content-between align-items-start gap-2 mb-2">
                    <div>
                        <h5 class="mb-1 fw-bold text-dark">{{ $r->nama_kegiatan }}</h5>
                        <div class="text-muted small">
                            <i class="far fa-calendar-alt me-1"></i> Diajukan: {{ \Carbon\Carbon::parse($r->tanggal_pengajuan)->format('d M Y, H:i') }}
                            &middot; <i class="far fa-user me-1"></i> Penyelenggara: <strong>{{ $r->nama_penyelenggara }}</strong>
                        </div>
                    </div>
                    {{-- Badge Status --}}
                    <span class="badge bg-{{ $warna[$r->status] ?? 'secondary' }} fs-6 px-3 py-2 text-capitalize">
                        {{ $status[$r->status] ?? $r->status }}
                    </span>
                </div>

                <hr class="text-muted opacity-25">

                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="small text-muted">📅 Tanggal Pelaksanaan</div>
                        <div class="fw-semibold">{{ \Carbon\Carbon::parse($r->tanggal_kegiatan)->format('d M Y') }}</div>
                    </div>
                    <div class="col-md-4">
                        <div class="small text-muted">📍 Lokasi Kegiatan</div>
                        <div class="fw-semibold">{{ $r->lokasi_kegiatan }}</div>
                    </div>
                    <div class="col-md-4">
                        <div class="small text-muted">📄 Proposal</div>
                        <div>
                            @if($r->file_proposal)
                                <a href="{{ asset('storage/' . $r->file_proposal) }}" target="_blank" class="btn btn-sm btn-outline-success">
                                    <i class="fas fa-file-pdf me-1"></i> Lihat Proposal
                                </a>
                            @else
                                <span class="text-muted italic">Tidak ada file</span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Deskripsi / Catatan Admin jika ada --}}
                @if($r->catatan_admin)
                    <div class="mt-3 p-3 bg-light rounded border-start border-4 border-danger">
                        <div class="small fw-bold text-danger mb-1"><i class="fas fa-info-circle me-1"></i> Catatan Admin:</div>
                        <p class="mb-0 text-muted small">{{ $r->catatan_admin }}</p>
                    </div>
                @endif
            </div>
        </div>
    @empty
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center text-muted py-5">
                <i class="fas fa-folder-open fa-3x mb-3 text-secondary opacity-50"></i>
                <p class="mb-0">Belum ada riwayat pengajuan sponsor ditemukan.</p>
            </div>
        </div>
    @endforelse

    {{-- Pagination --}}
    <div class="mt-4 d-flex justify-content-center">
        {{ $riwayat->links() }}
    </div>
</div>
@endsection