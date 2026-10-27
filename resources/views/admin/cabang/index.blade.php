
@extends('admin.layout')

@section('content')
<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Kelola Cabang</h2>
            <p class="text-muted mb-0">
                Kelola data cabang Dimsum Qonita.
            </p>
        </div>

        <a href="{{ route('admin.cabang.create') }}" class="btn btn-danger">
            + Tambah Cabang
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No.</th>
                            <th>Foto Toko</th>
                            <th>Nama Cabang</th>
                            <th>Alamat</th>
                            <th>Jumlah Produk</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($cabangs as $cabang)
                            <tr>
                                <td>
                                    {{ $cabangs->firstItem() + $loop->index }}
                                </td>

                                <td>
                                    @if ($cabang->foto)
                                        <img
                                            src="{{ asset('storage/' . $cabang->foto) }}"
                                            alt="Foto {{ $cabang->nama_cabang }}"
                                            width="80"
                                            height="60"
                                            style="object-fit: cover; border-radius: 8px;"
                                        >
                                    @else
                                        <span class="text-muted">Belum ada foto</span>
                                    @endif
                                </td>

                                <td>{{ $cabang->nama_cabang }}</td>

                                <td>{{ $cabang->alamat }}</td>

                                <td>
                                    {{ $cabang->produks()->count() }} produk
                                </td>

                                <td>
                                    <a
                                        href="{{ route('admin.cabang.edit', $cabang->id_cabang) }}"
                                        class="btn btn-sm btn-warning mb-1"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('admin.cabang.destroy', $cabang->id_cabang) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus cabang ini?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-sm btn-danger mb-1">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    Belum ada data cabang.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $cabangs->links() }}
            </div>
        </div>
    </div>

</div>
@endsection
