
@extends('admin.layout')

@section('title', 'Riwayat Sponsor')

@section('content')

{{-- Ringkasan --}}
<div class="row g-2 mb-3 ringkasan">
    <div class="col-6 col-md">
        <div class="card text-center h-100">
            <div class="card-body py-3">
                <div class="fs-3 fw-bold text-dark">{{ $totalRiwayat }}</div>
                <div class="text-muted small">Total Riwayat</div>
            </div>
        </div>
    </div>

    <div class="col-6 col-md">
        <div class="card text-center h-100">
            <div class="card-body py-3">
                <div class="fs-3 fw-bold text-success">{{ $ringkasan['selesai'] ?? 0 }}</div>
                <div class="text-muted small">Selesai</div>
            </div>
        </div>
    </div>

    <div class="col-6 col-md">
        <div class="card text-center h-100">
            <div class="card-body py-3">
                <div class="fs-3 fw-bold text-danger">{{ $ringkasan['ditolak'] ?? 0 }}</div>
                <div class="text-muted small">Ditolak</div>
            </div>
        </div>
    </div>
</div>

{{-- Filter --}}
<div class="card mb-3">
    <div class="card-body">
        <form action="{{ route('admin.riwayat_sponsor') }}" method="GET">
            <div class="row g-2 align-items-end">

                <div class="col-md-4">
                    <label class="form-label">Cari Sponsor</label>
                    <input type="text"
                           name="q"
                           class="form-control"
                           placeholder="Nama penyelenggara / kegiatan"
                           value="{{ request('q') }}">
                </div>

                <div class="col-md-2">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="">Semua</option>
                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label">Dari Tanggal</label>
                    <input type="date" name="dari" class="form-control" value="{{ request('dari') }}">
                </div>

                <div class="col-md-2">
                    <label class="form-label">Sampai Tanggal</label>
                    <input type="date" name="sampai" class="form-control" value="{{ request('sampai') }}">
                </div>

                <div class="col-md-2 d-flex gap-2">
                    <button type="submit" class="btn btn-godimsum w-100">
                        <i class="fas fa-search"></i> Cari
                    </button>

                    <a href="{{ route('admin.riwayat_sponsor') }}" class="btn btn-secondary">
                        <i class="fas fa-sync-alt"></i>
                    </a>
                </div>

            </div>
        </form>
    </div>
</div>

{{-- Tabel Riwayat --}}
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">
            <i class="fas fa-history me-2"></i>
            Riwayat Sponsor
        </h5>
    </div>

    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center">

                <thead class="table-light">
                    <tr>
                        <th width="60">No</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Penyelenggara</th>
                        <th>Nama Kegiatan</th>
                        <th>Lokasi</th>
                        <th>Status Terakhir</th>
                        <th width="100">Detail</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($riwayat as $r)
                        <tr>
                            <td>{{ $riwayat->firstItem() + $loop->index }}</td>

                            <td>
                                {{ \Carbon\Carbon::parse($r->tanggal_pengajuan)->format('d/m/Y') }}
                            </td>

                            <td>{{ $r->nama_penyelenggara }}</td>

                            <td>{{ $r->nama_kegiatan }}</td>

                            <td>{{ $r->lokasi_kegiatan }}</td>

                            <td>
                                @if ($r->status == 'selesai')
                                    <span class="badge bg-success">Selesai</span>
                                @elseif ($r->status == 'ditolak')
                                    <span class="badge bg-danger">Ditolak</span>
                                @else
                                    <span class="badge bg-secondary">{{ ucfirst($r->status) }}</span>
                                @endif
                            </td>

                            <td>
                                <button type="button"
                                        class="btn btn-godimsum btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#detailSponsor{{ $r->id_pengajuan }}">
                                    <i class="fas fa-eye me-1"></i> Detail
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-4">
                                <i class="fas fa-folder-open fa-2x text-muted mb-2"></i>
                                <p class="mb-0">Belum ada riwayat sponsor.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $riwayat->links('pagination::bootstrap-5') }}
        </div>

    </div>
</div>

{{-- Modal Detail --}}
@foreach ($riwayat as $r)
    <div class="modal fade"
         id="detailSponsor{{ $r->id_pengajuan }}"
         tabindex="-1"
         aria-hidden="true">

        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-file-alt me-2"></i>
                        Detail Riwayat Sponsor
                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <table class="table table-bordered text-center align-middle">
                        <tr>
                            <th>Penyelenggara</th>
                            <td>{{ $r->nama_penyelenggara }}</td>
                        </tr>

                        <tr>
                            <th>Nama Kegiatan</th>
                            <td>{{ $r->nama_kegiatan }}</td>
                        </tr>

                        <tr>
                            <th>Tanggal Kegiatan</th>
                            <td>{{ \Carbon\Carbon::parse($r->tanggal_kegiatan)->format('d/m/Y') }}</td>
                        </tr>

                        <tr>
                            <th>Tanggal Pengajuan</th>
                            <td>{{ \Carbon\Carbon::parse($r->tanggal_pengajuan)->format('d/m/Y') }}</td>
                        </tr>

                        <tr>
                            <th>Lokasi Kegiatan</th>
                            <td>{{ $r->lokasi_kegiatan }}</td>
                        </tr>

                        <tr>
                            <th>Deskripsi</th>
                            <td>{{ $r->deskripsi }}</td>
                        </tr>

                        <tr>
                            <th>Status</th>
                            <td>
                                @if ($r->status == 'selesai')
                                    <span class="badge bg-success">Selesai</span>
                                @else
                                    <span class="badge bg-danger">Ditolak</span>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <th>Catatan Admin</th>
                            <td>{{ $r->catatan_admin ?: '-' }}</td>
                        </tr>

                        <tr>
                            <th>File Proposal</th>
                            <td>
                                @if ($r->file_proposal)
                                    <a href="{{ asset('storage/'.$r->file_proposal) }}"
                                       target="_blank"
                                       class="btn btn-godimsum btn-sm">
                                        <i class="fas fa-file-pdf me-1"></i> Lihat Proposal
                                    </a>
                                @else
                                    <span class="text-muted">Tidak ada file proposal</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Tutup
                    </button>
                </div>

            </div>
        </div>
    </div>
@endforeach

@endsection