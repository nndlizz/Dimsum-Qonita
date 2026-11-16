@extends('layouts.app')

@section('content')
<div class="container py-4">

    <h3 class="fw-bold mb-4" style="color:#43200f">
        Riwayat Sponsor
    </h3>

    <form method="GET" class="row g-2 mb-4">
        <div class="col-md-5">
            <input type="text" name="search"
                class="form-control"
                placeholder="Cari sponsor atau kegiatan..."
                value="{{ request('search') }}">
        </div>

        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="">Semua Status</option>
                @foreach(['Diajukan','Diproses','Disetujui','Ditolak'] as $status)
                    <option value="{{ $status }}"
                        {{ request('status') == $status ? 'selected' : '' }}>
                        {{ $status }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2">
            <button class="btn text-white w-100"
                style="background:#850000">
                Cari
            </button>
        </div>
    </form>

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-bordered table-hover align-middle mb-0">
            <thead style="background:#3b100e;color:white">
                <tr>
                    <th>No</th>
                    <th>Nama Sponsor</th>
                    <th>Pelanggan</th>
                    <th>Kegiatan</th>
                    <th>Tanggal</th>
                    <th>Dukungan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($pengajuan as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_sponsor }}</td>
                    <td>{{ $item->user->name ?? '-' }}</td>
                    <td>{{ $item->kegiatan }}</td>
                    <td>{{ $item->tanggal_pengajuan }}</td>
                    <td>{{ $item->jenis_dukungan }}</td>

                    <td>
                        <span class="badge
                            @if($item->status == 'Disetujui') bg-success
                            @elseif($item->status == 'Ditolak') bg-danger
                            @elseif($item->status == 'Diproses') bg-warning text-dark
                            @else bg-secondary
                            @endif">
                            {{ $item->status }}
                        </span>
                    </td>

                    <td>
                        <form action="{{ route('admin.sponsor.updateStatus', $item->id) }}"
                              method="POST">
                            @csrf
                            @method('PATCH')

                            <select name="status"
                                class="form-select form-select-sm mb-2">
                                @foreach(['Diajukan','Diproses','Disetujui','Ditolak'] as $status)
                                    <option value="{{ $status }}"
                                        {{ $item->status == $status ? 'selected' : '' }}>
                                        {{ $status }}
                                    </option>
                                @endforeach
                            </select>

                            <button class="btn btn-sm text-white w-100"
                                style="background:#850000">
                                Simpan
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center py-4">
                        Belum ada pengajuan sponsor.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection