
@extends('admin.layout')

@section('content')
<div class="container-fluid py-4">

    <div class="mb-4">
        <h2 class="fw-bold mb-1">Edit Produk</h2>
        <p class="text-muted mb-0">Ubah informasi produk Dimsum Qonita.</p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">

            <form action="{{ route('admin.produk.update', $produk->id_produk) }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama_produk" class="form-label">Nama Produk</label>
                    <input type="text"
                           name="nama_produk"
                           id="nama_produk"
                           class="form-control"
                           value="{{ old('nama_produk', $produk->nama_produk) }}"
                           required>
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea name="deskripsi"
                              id="deskripsi"
                              class="form-control"
                              rows="3">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="id_kategori" class="form-label">Kategori</label>
                    <select name="id_kategori" id="id_kategori" class="form-select" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id_kategori }}"
                                {{ old('id_kategori', $produk->id_kategori) == $kategori->id_kategori ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="harga" class="form-label">Harga (Rp)</label>
                    <input type="number"
                           name="harga"
                           id="harga"
                           class="form-control"
                           min="0"
                           value="{{ old('harga', $produk->harga) }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Cabang</label>
                    @foreach ($cabangs as $cabang)
                        <div class="form-check">
                            <input class="form-check-input"
                                   type="checkbox"
                                   name="cabangs[]"
                                   id="cabang_{{ $cabang->id_cabang }}"
                                   value="{{ $cabang->id_cabang }}"
                                   {{ in_array($cabang->id_cabang, old('cabangs', $produk->cabangs->pluck('id_cabang')->toArray())) ? 'checked' : '' }}>
                            <label class="form-check-label" for="cabang_{{ $cabang->id_cabang }}">
                                {{ $cabang->nama_cabang }}
                            </label>
                        </div>
                    @endforeach
                </div>

                <div class="mb-3">
                    <label class="form-label">Gambar Produk</label>

                    @if ($produk->gambar)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $produk->gambar) }}"
                                 alt="{{ $produk->nama_produk }}"
                                 width="120"
                                 style="border-radius: 8px; object-fit: cover;">
                        </div>
                    @endif

                    <input type="file"
                           name="gambar"
                           id="gambar"
                           class="form-control"
                           accept="image/*">

                    <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar.</small>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-danger">Simpan Perubahan</button>
                    <a href="{{ route('admin.produk.index') }}" class="btn btn-secondary">Batal</a>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection