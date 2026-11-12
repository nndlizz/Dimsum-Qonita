@extends('admin.layout')

@section('title', 'Kelola Sponsor')

@section('content')
<div class="page-heading">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-2">
        <h3 class="mb-0">Kelola Sponsor</h3>

        <form action="{{ route('admin.kelolasponsor') }}" method="GET"
              class="d-flex align-items-center"
              style="max-width: 400px; width: 100%;">
            <input type="text" name="search" class="form-control"
                   placeholder="Cari pengajuan sponsor..."
                   value="{{ request('search') }}">

            <button type="submit" class="btn-search btn-primary ms-2">
                <i class="bi bi-search"></i>
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
                                        <a href="{{ asset('storage/' . $pengajuan->file_proposal) }}"
                                           target="_blank" rel="noopener noreferrer">
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

                                <td>{{ $pengajuan->catatan_admin ?: '-' }}</td>

                                <td>
                                    {{ $pengajuan->tanggal_pengajuan
                                        ? \Carbon\Carbon::parse($pengajuan->tanggal_pengajuan)->format('d-m-Y H:i')
                                        : '-' }}
                                </td>

                                <td style="min-width: 280px;">
                                    <form
                                        action="{{ route('admin.kelolasponsor.status', $pengajuan->id_pengajuan) }}"
                                        method="POST"
                                        class="form-status"
                                        data-nama="{{ $pengajuan->nama_kegiatan }}"
                                    >
                                        @csrf
                                        @method('PUT')

                                        <div class="mb-2">
                                            <label for="status-{{ $pengajuan->id_pengajuan }}"
                                                   class="form-label">
                                                Ubah Status
                                            </label>

                                            <select
                                                name="status"
                                                id="status-{{ $pengajuan->id_pengajuan }}"
                                                class="form-select status-select"
                                                required
                                            >
                                                @foreach ([
                                                    'diajukan',
                                                    'diproses',
                                                    'diterima',
                                                    'ditolak',
                                                    'selesai'
                                                ] as $status)
                                                    <option value="{{ $status }}"
                                                        @selected($pengajuan->status === $status)>
                                                        {{ ucfirst($status) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-2">
                                            <label for="catatan-{{ $pengajuan->id_pengajuan }}"
                                                   class="form-label">
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

                                        <button type="submit" class="btn btn-primary btn-sm">
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

@section('scripts')
<script>
    // Alert ketika form status disimpan
    document.querySelectorAll('.form-status').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const status = form.querySelector('.status-select').value;
            const nama = form.dataset.nama;

            let config = {
                title: 'Simpan perubahan?',
                text: 'Yakin ingin menyimpan perubahan status pengajuan ini?',
                icon: 'question',
                confirmButtonText: 'Ya, Simpan',
                confirmButtonColor: '#435ebe'
            };

            // Konfirmasi khusus status selesai
            if (status === 'selesai') {
                config = {
                    title: 'Selesaikan pengajuan?',
                    text: `Pengajuan "${nama}" akan diselesaikan dan dipindahkan ke Riwayat Sponsor.`,
                    icon: 'success',
                    confirmButtonText: 'Ya, Selesaikan',
                    confirmButtonColor: '#198754'
                };
            }

            // Konfirmasi khusus status ditolak
            if (status === 'ditolak') {
                config = {
                    title: 'Tolak pengajuan?',
                    text: `Pengajuan "${nama}" akan ditolak dan dipindahkan ke Riwayat Sponsor.`,
                    icon: 'warning',
                    confirmButtonText: 'Ya, Tolak',
                    confirmButtonColor: '#dc3545'
                };
            }

            Swal.fire({
                ...config,
                showCancelButton: true,
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then(result => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    // Alert sukses setelah redirect
    @if(session('success'))
        Swal.fire({
            title: 'Berhasil!',
            text: @json(session('success')),
            icon: 'success',
            confirmButtonText: 'OK'
        });
    @endif

    // Alert error validasi
    @if($errors->any())
        Swal.fire({
            title: 'Terjadi Kesalahan!',
            html: `{!! implode('<br>', $errors->all()) !!}`,
            icon: 'error',
            confirmButtonText: 'OK'
        });
    @endif
</script>
@endsection
