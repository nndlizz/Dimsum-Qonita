@extends('admin.layout')

@section('content')
<div class="container-fluid py-4">

    <div class="mb-4">
        <h2 class="fw-bold mb-1">Edit Kategori</h2>
        <p class="text-muted mb-0">
            Ubah nama kategori produk Dimsum Qonita.
        </p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">

            <form id="formKategori" action="{{ route('admin.kategori.update', $kategori->id_kategori) }}"
                  method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama_kategori" class="form-label fw-semibold">
                        Nama Kategori
                    </label>

                    <input
                        type="text"
                        name="nama_kategori"
                        id="nama_kategori"
                        class="form-control @error('nama_kategori') is-invalid @enderror"
                        value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                        maxlength="255"
                        required
                    >

                    @error('nama_kategori')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-danger">
                        Simpan Perubahan
                    </button>

                    <a href="{{ route('admin.kategori.index') }}"
                       class="btn btn-secondary">
                        Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.getElementById('formKategori').addEventListener('submit', function(e) {
        e.preventDefault();

        const form = this;

        Swal.fire({
            title: 'Simpan Perubahan?',
            text: 'Apakah kamu yakin ingin memperbarui kategori ini?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#820000',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Perbarui',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
</script>
@endsection
