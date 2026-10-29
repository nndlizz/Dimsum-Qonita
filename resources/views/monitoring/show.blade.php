@extends('layouts.admin')

@section('title', 'Detail Pengajuan Sponsor')

@section('content')
@include('monitoring._tema')
<div class="tema-qonita">
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">{{ $pengajuan->nama_kegiatan }}</h4>
    <span class="badge fs-6 text-bg-{{ $pengajuan->warna_status }}">{{ $pengajuan->label_status }}</span>
</div>

<div class="row g-3">
    {{-- Detail pengajuan --}}
    <div class="col-lg-7">
        <div class="card mb-3">
            <div class="card-header">Detail pengajuan</div>
            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-sm-4">Penyelenggara</dt><dd class="col-sm-8">{{ $pengajuan->nama_penyelenggara }}</dd>
                    <dt class="col-sm-4">Tanggal kegiatan</dt><dd class="col-sm-8">{{ $pengajuan->tanggal_kegiatan?->format('d-m-Y') }}</dd>
                    <dt class="col-sm-4">Lokasi</dt><dd class="col-sm-8">{{ $pengajuan->lokasi_kegiatan }}</dd>
                    <dt class="col-sm-4">Deskripsi</dt><dd class="col-sm-8">{{ $pengajuan->deskripsi }}</dd>
                    <dt class="col-sm-4">Diajukan pada</dt><dd class="col-sm-8">{{ $pengajuan->tanggal_pengajuan?->format('d-m-Y H:i') }}</dd>
                    <dt class="col-sm-4">Proposal</dt>
                    <dd class="col-sm-8">
                        @if ($pengajuan->file_proposal)
                            {{-- Sesuaikan path jika file disimpan di tempat lain --}}
                            <a href="{{ asset('storage/' . $pengajuan->file_proposal) }}" target="_blank">Lihat proposal</a>
                        @else
                            <span class="text-muted">Tidak ada file</span>
                        @endif
                    </dd>
                </dl>
            </div>
        </div>

        <div class="card">
            <div class="card-header">Pelanggan</div>
            <div class="card-body">
                @if ($pelanggan)
                    <dl class="row mb-0">
                        <dt class="col-sm-4">Nama</dt><dd class="col-sm-8">{{ $pelanggan->nama_pelanggan }}</dd>
                        <dt class="col-sm-4">Email</dt><dd class="col-sm-8">{{ $pelanggan->email }}</dd>
                        <dt class="col-sm-4">No. telepon</dt><dd class="col-sm-8">{{ $pelanggan->no_telepon ?? '-' }}</dd>
                        <dt class="col-sm-4">Alamat</dt><dd class="col-sm-8">{{ $pelanggan->alamat ?? '-' }}</dd>
                    </dl>
                @else
                    <span class="text-muted">Data pelanggan tidak ditemukan.</span>
                @endif
            </div>
        </div>
    </div>

    {{-- Ubah status + riwayat --}}
    <div class="col-lg-5">
        <div class="card mb-3">
            <div class="card-header">Ubah status</div>
            <div class="card-body">
                <form method="POST" action="{{ route('monitoring.status', $pengajuan) }}">
                    @csrf @method('PATCH')

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror">
                            @foreach (\App\Models\PengajuanSponsor::STATUS as $key => $label)
                                <option value="{{ $key }}" @selected(old('status', $pengajuan->status) === $key)>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Catatan</label>
                        <textarea name="catatan" rows="3" class="form-control"
                                  placeholder="Alasan atau keterangan keputusan">{{ old('catatan', $pengajuan->keputusan?->catatan) }}</textarea>
                    </div>

                    <button class="btn btn-primary w-100">Simpan status</button>
                </form>

                @if ($pengajuan->keputusan?->tanggal_keputusan)
                    <div class="small text-muted mt-3">
                        Keputusan: {{ $pengajuan->keputusan->tanggal_keputusan->format('d-m-Y H:i') }}
                        oleh {{ $namaAdmin[$pengajuan->keputusan->id_admin] ?? '-' }}
                    </div>
                @endif
            </div>
        </div>

        <div class="card">
            <div class="card-header">Riwayat status</div>
            <ul class="list-group list-group-flush">
                @forelse ($pengajuan->riwayat as $r)
                    <li class="list-group-item">
                        <div>
                            <span class="badge text-bg-light">{{ $r->status_sebelumnya ?? '-' }}</span>
                            &rarr;
                            <span class="badge text-bg-primary">{{ $r->status_baru }}</span>
                        </div>
                        @if ($r->catatan)
                            <div class="small mt-1">{{ $r->catatan }}</div>
                        @endif
                        <div class="small text-muted mt-1">
                            {{ $r->tanggal_perubahan?->format('d-m-Y H:i') }}
                            @if ($r->id_admin) &middot; {{ $namaAdmin[$r->id_admin] ?? 'admin' }} @endif
                        </div>
                    </li>
                @empty
                    <li class="list-group-item text-muted">Belum ada perubahan status.</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>

<a href="{{ route('monitoring.index') }}" class="btn btn-link mt-3">&larr; Kembali ke daftar</a>
</div>
@endsection
