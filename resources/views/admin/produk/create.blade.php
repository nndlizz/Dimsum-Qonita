@extends('admin.layout')
<style>
    /* Hilangkan tombol naik-turun pada input harga cabang */
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


@section('content')


<div class="page-header">
    <div>
        <h1 class="page-title">Tambah Produk</h1>
        <p class="page-subtitle" style="color: #6c757d;">
            Tambahkan produk baru ke dalam sistem GoDimsum.
        </p>
    </div>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="{{ url('/admin') }}"
                   class="text-decoration-none text-muted-green">
                    Home
                </a>
            </li>
            <li class="breadcrumb-item active text-main"
                aria-current="page">
                Tambah Produk
            </li>
        </ol>
    </nav>
</div>

<div class="card p-4 border-light shadow-sm">

    <h5 class="mb-4">Form Tambah Produk</h5>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.produk.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        <div class="mb-3">
            <label for="nama_produk" class="form-label">
                Nama Produk
            </label>
            <input type="text"
                   name="nama_produk"
                   id="nama_produk"
                   class="form-control"
                   value="{{ old('nama_produk') }}"
                   placeholder="Masukkan nama produk"
                   required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">
                Deskripsi
            </label>
            <textarea name="deskripsi"
                      id="deskripsi"
                      class="form-control"
                      rows="3"
                      placeholder="Masukkan deskripsi produk">{{ old('deskripsi') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="id_kategori" class="form-label">
                Kategori Produk
            </label>
            <select name="id_kategori"
                    id="id_kategori"
                    class="form-select"
                    required>
                <option value="">-- Pilih Kategori --</option>
                @foreach ($kategoris as $kategori)
                    <option value="{{ $kategori->id_kategori }}"
                        {{ old('id_kategori') == $kategori->id_kategori ? 'selected' : '' }}>
                        {{ $kategori->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="gambar" class="form-label">
                Gambar Produk
            </label>
            <input type="file"
                   name="gambar"
                   id="gambar"
                   class="form-control"
                   accept=".jpg,.jpeg,.png,.webp">
            <small class="text-muted">
                Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
            </small>
        </div>

        
<hr>

<h6 class="mb-3">Harga per Cabang</h6>

@forelse ($cabangs as $cabang)
    <div class="row align-items-center mb-3">
        <div class="col-md-6">
            <div class="form-check">
                <input
                    class="form-check-input"
                    type="checkbox"
                    id="cabang_{{ $cabang->id_cabang }}"
                    name="cabang[{{ $cabang->id_cabang }}][id_cabang]"
                    value="{{ $cabang->id_cabang }}"
                    {{ old('cabang.' . $cabang->id_cabang . '.id_cabang') ? 'checked' : '' }}
                    onchange="toggleHarga({{ $cabang->id_cabang }})"
                >

                <label
                    class="form-check-label"
                    for="cabang_{{ $cabang->id_cabang }}"
                >
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
                value="{{ old('cabang.' . $cabang->id_cabang . '.harga') }}"
                {{ old('cabang.' . $cabang->id_cabang . '.id_cabang') ? 'required' : 'disabled' }}
                onwheel="this.blur()"
            >
        </div>
    </div>
@empty
    <p class="text-muted">
        Belum ada data cabang. Tambahkan cabang terlebih dahulu.
    </p>
@endforelse

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

        <div class="d-flex justify-content-end gap-2 mt-4">
            <a href="{{ url('/admin') }}"
               class="btn btn-outline-secondary">
                Batal
            </a>

            <button type="submit" class="btn btn-success">
                <i class="bi bi-plus-circle me-1"></i>
                Simpan Produk
            </button>
        </div>

    </form>
</div>

@endsection