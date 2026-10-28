
@extends('admin.layout')

@section('title', 'Kelola Sponsor')

@section('content')
<div class="page-heading">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-2">
        <h3 class="mb-0">Kelola Sponsor</h3>

        <form action="{{ route('admin.kelolasponsor') }}" method="GET"
              class="d-flex align-items-center"
              style="max-width: 400px; width: 100%;">
            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Cari pengajuan sponsor..."
                value="{{ request('search') }}"
            >
            <button type="submit" class="btn-search btn-primary ms-2">
                <i class="bi bi-search"></i>
            </button>
        </form>
    </div>

    <p>Kelola pengajuan sponsor dari pelanggan Dimsum Qonita.</p>
</div>

<div class="page-content">

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h4>Daftar Pengajuan Sponsor</h4>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="text-center">
                        <tr>
                            <th>ID Pengajuan</th>
                            <th>ID Pelanggan</th>
                            <th>Nama Kegiatan</th>
                            <th>Penyelenggara</th>
                            <th>Tanggal Kegiatan</th>
                            <th>Lokasi</th>
                            <th>Deskripsi</th>
                            <th>File Proposal</th>
                            <th>Status</th>
                            <th>Catatan Admin</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($pengajuans as $pengajuan)
                            <tr>
                                <td>{{ $pengajuan->id_pengajuan }}</td>
                                <td>{{ $pengajuan->id_pelanggan }}</td>
                                <td>{{ $pengajuan->nama_kegiatan }}</td>
                                <td>{{ $pengajuan->nama_penyelenggara }}</td>
                                <td>
                                    {{ $pengajuan->tanggal_kegiatan?->format('d-m-Y') ?? '-' }}
                                </td>
                                <td>{{ $pengajuan->lokasi_kegiatan }}</td>
                                <td>{{ $pengajuan->deskripsi }}</td>

                                <td>
                                    @if ($pengajuan->file_proposal)
                                        <a
                                            href="{{ asset('storage/' . $pengajuan->file_proposal) }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                        >
                                            Lihat Proposal
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>

                                <td class="text-center">
                                    @php
                                        $badgeClass = match ($pengajuan->status) {
                                            'diajukan' => 'bg-info',
                                            'diproses' => 'bg-warning text-dark',
                                            'diterima' => 'bg-success',
                                            'ditolak' => 'bg-danger',
                                            'selesai' => 'bg-primary',
                                            default => 'bg-secondary',
                                        };
                                    @endphp

                                    <span class="badge {{ $badgeClass }}">
                                        {{ ucfirst($pengajuan->status) }}
                                    </span>
                                </td>

                                <td>
                                    {{ $pengajuan->catatan_admin ?: '-' }}
                                </td>

                                <td>
                                    {{ $pengajuan->tanggal_pengajuan
                                        ? \Carbon\Carbon::parse($pengajuan->tanggal_pengajuan)->format('d-m-Y H:i')
                                        : '-' }}
                                </td>

                                <td style="min-width: 280px;">
                                    <form
                                        action="{{ route('admin.kelolasponsor.status', $pengajuan->id_pengajuan) }}"
                                        method="POST"
                                    >
                                        @csrf
                                        @method('PUT')

                                        <div class="mb-2">
                                            <label
                                                for="status-{{ $pengajuan->id_pengajuan }}"
                                                class="form-label"
                                            >
                                                Ubah Status
                                            </label>

                                            <select
                                                name="status"
                                                id="status-{{ $pengajuan->id_pengajuan }}"
                                                class="form-select"
                                                required
                                            >
                                                @foreach ([
                                                    'diajukan',
                                                    'diproses',
                                                    'diterima',
                                                    'ditolak',
                                                    'selesai'
                                                ] as $status)
                                                    <option
                                                        value="{{ $status }}"
                                                        @selected($pengajuan->status === $status)
                                                    >
                                                        {{ ucfirst($status) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-2">
                                            <label
                                                for="catatan-{{ $pengajuan->id_pengajuan }}"
                                                class="form-label"
                                            >
                                                Catatan Admin
                                            </label>

                                            <textarea
                                                name="catatan_admin"
                                                id="catatan-{{ $pengajuan->id_pengajuan }}"
                                                class="form-control"
                                                rows="3"
                                                maxlength="5000"
                                                placeholder="Tulis catatan untuk pelanggan..."
                                            >{{ $pengajuan->catatan_admin }}</textarea>
                                        </div>

                                        <button
                                            type="submit"
                                            class="btn btn-primary btn-sm"
                                        >
                                            Simpan Perubahan
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="text-center">
                                    Belum ada pengajuan sponsor.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $pengajuans->links() }}
            </div>
        </div>
    </div>
</div>
@endsection