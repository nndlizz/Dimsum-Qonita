@extends('admin.layout')

@section('content')
<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Kelola Kategori</h2>
            <p class="text-muted mb-0">Kelola kategori produk Dimsum Qonita.</p>
        </div>

        <a href="{{ route('admin.kategori.create') }}"
           class="btn btn-danger">
            + Tambah Kategori
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
                            <th>Nama Kategori</th>
                            <th>Jumlah Produk</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($kategoris as $kategori)
                            <tr>
                                <td>
                                    {{ $kategoris->firstItem() + $loop->index }}
                                </td>

                                <td>
                                    {{ $kategori->nama_kategori }}
                                </td>

                                <td>
                                    {{ $kategori->produks()->count() }} produk
                                </td>

                                <td>
                                    <a href="{{ route('admin.kategori.edit', $kategori->id_kategori) }}"
                                       class="btn btn-sm btn-warning mb-1">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.kategori.destroy', $kategori->id_kategori) }}"
                                          method="POST"
                                          class="d-inline form-hapus-kategori">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-sm btn-danger mb-1">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    Belum ada kategori produk.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $kategoris->links() }}
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.querySelectorAll('.form-hapus-kategori').forEach(function(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const currentForm = this;

            Swal.fire({
                title: 'Hapus Kategori?',
                text: 'Kategori yang dihapus tidak dapat dikembalikan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#820000',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    currentForm.submit();
                }
            });
        });
    });
</script>
@endsection