@extends('admin.layout')

@section('content')

<style>
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type="number"] {
        -moz-appearance: textfield;
        appearance: textfield;
    }
</style>

<div class="container-fluid py-4">

    <div class="mb-4">
        <h2 class="fw-bold mb-1">Edit Produk</h2>
        <p class="text-muted mb-0">Ubah informasi produk Dimsum Qonita.</p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

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
                    <select name="id_kategori"
                            id="id_kategori"
                            class="form-select"
                            required>
                        <option value="">-- Pilih Kategori --</option>

                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id_kategori }}"
                                {{ old('id_kategori', $produk->id_kategori) == $kategori->id_kategori ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <hr>

                <h5 class="mb-3">Harga per Cabang</h5>
                <p class="text-muted small">
                    Centang cabang yang menjual produk ini, lalu masukkan harga jualnya.
                </p>

                @forelse ($cabangs as $cabang)
                    @php
                        $cabangTerpilih = old(
                            'cabang.' . $cabang->id_cabang . '.id_cabang',
                            $produk->cabangs->contains('id_cabang', $cabang->id_cabang)
                                ? $cabang->id_cabang
                                : null
                        );

                        $cabangProduk = $produk->cabangs->firstWhere(
                            'id_cabang',
                            $cabang->id_cabang
                        );

                        $hargaTersimpan = $cabangProduk
                            ? $cabangProduk->pivot->harga
                            : '';
                    @endphp

                    <div class="row align-items-center mb-3">
                        <div class="col-md-6">
                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    id="cabang_{{ $cabang->id_cabang }}"
                                    name="cabang[{{ $cabang->id_cabang }}][id_cabang]"
                                    value="{{ $cabang->id_cabang }}"
                                    {{ $cabangTerpilih ? 'checked' : '' }}
                                    onchange="toggleHarga({{ $cabang->id_cabang }})"
                                >

                                <label class="form-check-label"
                                       for="cabang_{{ $cabang->id_cabang }}">
                                    {{ $cabang->nama_cabang }}
                                </label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <input
                                type="number"
                                name="cabang[{{ $cabang->id_cabang }}][harga]"
                                id="harga_cabang_{{ $cabang->id_cabang }}"
                                class="form-control"
                                min="0"
                                step="1"
                                placeholder="Harga di cabang ini"
                                value="{{ old('cabang.' . $cabang->id_cabang . '.harga', $hargaTersimpan) }}"
                                {{ $cabangTerpilih ? 'required' : 'disabled' }}
                                onwheel="this.blur()"
                            >
                        </div>
                    </div>
                @empty
                    <p class="text-muted">
                        Belum ada data cabang. Tambahkan cabang terlebih dahulu.
                    </p>
                @endforelse

                <div class="mb-3 mt-4">
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
                           accept=".jpg,.jpeg,.png,.webp">

                    <small class="text-muted">
                        Kosongkan jika tidak ingin mengganti gambar.
                        Format JPG, JPEG, PNG, atau WEBP, maksimal 2 MB.
                    </small>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-danger">
                        Simpan Perubahan
                    </button>

                    <a href="{{ route('admin.produk.index') }}"
                       class="btn btn-secondary">
                        Batal
                    </a>
                </div>

            </form>

        </div>
    </div>
</div>

<script>
    function toggleHarga(idCabang) {
        const checkbox = document.getElementById('cabang_' + idCabang);
        const inputHarga = document.getElementById('harga_cabang_' + idCabang);

        inputHarga.disabled = !checkbox.checked;
        inputHarga.required = checkbox.checked;

        if (!checkbox.checked) {
            inputHarga.value = '';
        }
    }
</script>

@endsection
