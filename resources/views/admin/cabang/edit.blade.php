@extends('admin.layout')

@section('content')
<div class="container-fluid py-4">

    <div class="mb-4">
        <h2 class="fw-bold mb-1">Edit Cabang</h2>
        <p class="text-muted mb-0">
            Perbarui informasi dan foto toko Dimsum Qonita.
        </p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">

            <form
                action="{{ route('admin.cabang.update', $cabang->id_cabang) }}"
                method="POST"
                enctype="multipart/form-data"
            >
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama_cabang" class="form-label fw-semibold">
                        Nama Cabang
                    </label>

                    <input
                        type="text"
                        name="nama_cabang"
                        id="nama_cabang"
                        class="form-control @error('nama_cabang') is-invalid @enderror"
                        value="{{ old('nama_cabang', $cabang->nama_cabang) }}"
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
                        required
                    >{{ old('alamat', $cabang->alamat) }}</textarea>

                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Foto Toko Saat Ini
                    </label>

                    <div class="mb-3">
                        @if ($cabang->foto)
                            <img
                                src="{{ asset('storage/' . $cabang->foto) }}"
                                alt="Foto {{ $cabang->nama_cabang }}"
                                width="180"
                                height="130"
                                style="object-fit: cover; border-radius: 10px;"
                            >
                        @else
                            <p class="text-muted mb-0">
                                Belum ada foto toko.
                            </p>
                        @endif
                    </div>

                    <label for="foto" class="form-label">
                        Ganti Foto Toko (Opsional)
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
                        Kosongkan jika tidak ingin mengganti foto.
                    </div>

                    @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-danger">
                        Simpan Perubahan
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