@extends('admin.layout')

@section('content')

    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Dashboard GoDimsum</h1>
            <p class="page-subtitle">
                Selamat datang di halaman admin GoDimsum.
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

    <!-- Dashboard Content -->
    <div class="card p-4 border-light shadow-sm text-center">
        <div>
            <div class="mb-4 text-lime empty-state-icon">
                <i class="bi bi-speedometer2"></i>
            </div>

            <h3 class="mb-2">Dashboard GoDimsum</h3>

            <p class="text-muted-green mb-4">
                Selamat datang di halaman admin GoDimsum.
                Kelola produk, pengajuan sponsor, dan informasi lainnya
                melalui menu sidebar.
            </p>
        </div>
    </div>

@endsection