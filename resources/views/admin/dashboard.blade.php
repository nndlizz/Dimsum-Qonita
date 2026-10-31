@extends('admin.layout')

@section('content')

    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Dashboard Qonita Food Store</h1>
                <p class="page-subtitle text-secondary">
                    Selamat datang di halaman admin Qonita Food Store.
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
                    Dashboard
                </li>
            </ol>
        </nav>
    </div>

    <!-- Statistik Dashboard -->
    <div class="row g-3 mb-4">

        <!-- Jumlah Cabang -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-3 h-100"
            style="background-color: #820000; color: white;">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-3 p-3 bg-light">
                        <i class="bi bi-shop fs-3 text-success"></i>
                    </div>
                    <div>
                        <p class="mb-1" style="color: #FFF4E5;">Jumlah Cabang</p>
                        <h3 class="mb-0 text-white">{{ $jumlahCabang }}</h3>
                        <small style="color: #FFF4E5;">Cabang terdaftar</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jumlah Produk -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-3 h-100"
                style="background-color: #820000; color: white;">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-3 p-3 bg-light">
                        <i class="bi bi-box-seam fs-3 text-success"></i>
                    </div>
                    <div>
                        <p class="mb-1" style="color: #FFF4E5;">Jumlah Produk</p>
                        <h3 class="mb-0 text-white">{{ $jumlahProduk }}</h3>
                        <small style="color: #FFF4E5;">Produk Terdaftar</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jumlah Kategori -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-3 h-100"
                style="background-color: #820000; color: white;">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-3 p-3 bg-light">
                        <i class="bi bi-tags fs-3 text-success"></i>
                    </div>
                    <div>
                        <p class="mb-1" style="color: #FFF4E5;">Jumlah Kategori</p>
                        <h3 class="mb-0 text-white">{{ $jumlahKategori }}</h3>
                        <small style="color: #FFF4E5;">Kategori Terdaftar</small>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Lokasi Utama -->

<!-- Lokasi Utama -->
<div class="card border-0 shadow-sm p-4 mb-4"
     style="background-color: #820000; color: white;">
    <div class="d-flex align-items-center gap-3 mb-3">
        <div class="rounded-3 p-3 bg-light">
            <i class="bi bi-geo-alt fs-3 text-success"></i>
        </div>
        <div>
            <h5 class="mb-1 text-white">Lokasi Utama GoDimsum</h5>
            <p class="mb-0" style="color: #FFF4E5;">
                Pabrik Dimsum Qonita Food Store
            </p>
        </div>
    </div>

    <hr>

    <p class="mb-3" style="color: #FFF4E5;">
    <i class="bi bi-geo-alt-fill me-2"></i>
    Perum Jl. Usman Singawinata No. 2 Blok B2,
    Nagri Kaler, Purwakarta, Jawa Barat 41115
    </p>    

    <div class="row g-3 align-items-stretch">
        <!-- Foto Lokasi -->
        <div class="col-md-6">
          <img
                src="{{ asset('storage/lokasi/lokasi-utama.png') }}"
                alt="Pabrik Dimsum Qonita Food Store"
                class="img-fluid rounded w-100"
                style="height: 300px; object-fit: cover;"
            >
        </div>

        <!-- Google Maps -->
        <div class="col-md-6">
            <iframe
                src="https://maps.google.com/maps?q=-6.5285054,107.4465055&z=17&output=embed"
                width="100%"
                height="300"
                style="border: 0; border-radius: 10px;"
                allowfullscreen
                loading="lazy"
                title="Lokasi Pabrik Dimsum Qonita Food Store">
            </iframe>

            <a
                href="https://www.google.com/maps/place/Pabrik+Dimsum+Qonita+Food+Store/@-6.5285054,107.4465055,17z"
                target="_blank"
                rel="noopener noreferrer"
                class="btn btn-outline-success btn-sm mt-2 btn-maps-custom"
                <i class="bi bi-shop fs-3" style="color: #FFF4E5;"></i>
                Buka di Google Maps
            </a>
        </div>
    </div>
</div>
@endsection