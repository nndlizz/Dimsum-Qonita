@extends('admin.layout')

@section('content')
<div class="container-fluid py-4">

    <div class="mb-4">
        <h2 class="fw-bold mb-1">Tambah Cabang</h2>
        <p class="text-muted mb-0">
            Tambahkan data dan foto toko Dimsum Qonita.
        </p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">

            <form
                action="{{ route('admin.cabang.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >
                @csrf

                <div class="mb-3">
                    <label for="nama_cabang" class="form-label fw-semibold">
                        Nama Cabang
                    </label>

                    <input
                        type="text"
                        name="nama_cabang"
                        id="nama_cabang"
                        class="form-control @error('nama_cabang') is-invalid @enderror"
                        value="{{ old('nama_cabang') }}"
                        placeholder="Contoh: Dimsum Qonita Purwakarta"
                        maxlength="255"
                        required
                    >

                    @error('nama_cabang')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label fw-semibold">
                        Alamat Cabang
                    </label>

                    <textarea
                        name="alamat"
                        id="alamat"
                        rows="3"
                        class="form-control @error('alamat') is-invalid @enderror"
                        placeholder="Masukkan alamat lengkap toko"
                        required
                    >{{ old('alamat') }}</textarea>

                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="foto" class="form-label fw-semibold">
                        Foto Toko
                    </label>

                    <input
                        type="file"
                        name="foto"
                        id="foto"
                        class="form-control @error('foto') is-invalid @enderror"
                        accept=".jpg,.jpeg,.png,.webp"
                    >

                    <div class="form-text">
                        Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                        Foto boleh dikosongkan.
                    </div>

                    @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-danger">
                        Simpan Cabang
                    </button>

                    <a
                        href="{{ route('admin.cabang.index') }}"
                        class="btn btn-secondary"
                    >
                        Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
