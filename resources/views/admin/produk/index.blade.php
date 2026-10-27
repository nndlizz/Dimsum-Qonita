
@extends('admin.layout')

@push('styles')
<style>
    .pagination {
        margin-bottom: 0;
        justify-content: flex-end;
        font-size: 14px;
    }

    .pagination .page-link {
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.5;
    }

    .pagination svg {
        width: 16px !important;
        height: 16px !important;
    }
    .produk-pagination {
    display: block;
    width: 100%;
    margin-top: 12px;
}

.produk-pagination .pagination {
    display: flex;
    justify-content: flex-start;
    flex-wrap: wrap;
    gap: 4px;
    margin-bottom: 0;
}
</style>
@endpush


@section('content')
<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Kelola Produk</h2>
            <p class="text-muted mb-0">Kelola produk Dimsum Qonita di sini.</p>
        </div>

        <a href="{{ route('admin.produk.create') }}" class="btn btn-danger">
            + Tambah Produk
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No.</th>
                            <th>Gambar</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Cabang</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($produks as $produk)
                            <tr>
                                <td>{{ $produks->firstItem() + $loop->index }}</td>

                                <td>
                                    @if ($produk->gambar)
                                        <img
                                            src="{{ asset('storage/' . $produk->gambar) }}"
                                            alt="{{ $produk->nama_produk }}"
                                            width="65"
                                            height="65"
                                            style="object-fit: cover; border-radius: 8px;"
                                        >
                                    @else
                                        <span class="text-muted">Tidak ada gambar</span>
                                    @endif
                                </td>

                                <td>{{ $produk->nama_produk }}</td>

                                <td>{{ $produk->kategori->nama_kategori ?? '-' }}</td>

                                <td>Rp{{ number_format($produk->harga, 0, ',', '.') }}</td>

                                <td>
                                    @forelse ($produk->cabangs as $cabang)
                                        <span class="badge bg-light text-dark border">
                                            {{ $cabang->nama_cabang }}
                                        </span>
                                    @empty
                                        <span class="text-muted">Belum ada cabang</span>
                                    @endforelse
                                </td>

                                <td>
                                    <a href="{{ route('admin.produk.edit', $produk->id_produk) }}"
                                       class="btn btn-sm btn-warning mb-1">
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('admin.produk.destroy', $produk->id_produk) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus produk ini?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-sm btn-danger">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    Belum ada produk yang ditambahkan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            
<div class="mt-4">
    <div class="produk-pagination">
        {{ $produks->onEachSide(1)->links() }}
    </div>
</div>



        </div>
    </div>
</div>
@endsection