
@extends('admin.layout')

@section('title', 'Kelola Sponsor')

@section('content')

<div class="page-heading">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-2">
        <h3 class="mb-0">Kelola Sponsor</h3>

        <form action="{{ route('admin.kelolasponsor') }}"
              method="GET"
              class="d-flex align-items-center"
              style="max-width: 400px; width: 100%;">

            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Cari pengajuan sponsor..."
                value="{{ request('search') }}"
            >

            
            <button type="submit" class="btn btn-search ms-2" aria-label="Cari">
                <svg xmlns="http://www.w3.org/2000/svg"
                    width="20" height="20"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.35-4.35"></path>
                </svg>
            </button>

        </form>
    </div>

    <p>Kelola pengajuan sponsor dari pelanggan Dimsum Qonita.</p>
</div>

<div class="page-content">
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
                            <th>Tanggal</th>
                            <th>Lokasi</th>
                            <th>Deskripsi</th>
                            <th>File</th>
                            <th>Status</th>
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
                                <td>{{ $pengajuan->tanggal_kegiatan }}</td>
                                <td>{{ $pengajuan->lokasi_kegiatan }}</td>
                                <td>{{ $pengajuan->deskripsi }}</td>

                                <td>
                                    @if ($pengajuan->file_proposal)
                                        <a href="{{ asset('storage/' . $pengajuan->file_proposal) }}"
                                        target="_blank"
                                        rel="noopener noreferrer">
                                            Lihat Proposal
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>

                                <td>{{ $pengajuan->status }}</td>
                                <td>{{ $pengajuan->tanggal_pengajuan }}</td>
                            
                                <td>
                                    @if (strtolower($pengajuan->status ?? '') === 'menunggu')
                                        <form action="{{ route('admin.kelola-sponsor.keputusan', $pengajuan->id_pengajuan) }}"
                                            method="POST"
                                            class="mb-2">
                                            @csrf
                                            <input type="hidden" name="status" value="disetujui">
                                            <button type="submit" class="btn btn-success btn-sm">
                                                ACC
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.kelola-sponsor.keputusan', $pengajuan->id_pengajuan) }}"
                                            method="POST">
                                            @csrf
                                            <input type="hidden" name="status" value="ditolak">
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                Tolak
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-muted">Sudah diproses</span>
                                    @endif
                                </td>
                            </tr>
                                @empty
                            <tr>
                                <td colspan="13" class="text-center">
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
@endsection
