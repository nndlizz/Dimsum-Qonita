@extends('pelanggan.layout.app')

@section('content')
<div class="container-fluid py-5 min-vh-100 d-flex align-items-center justify-content-center" style="background-color: #fdfaf6; margin-top: -30px;">
    <div class="card shadow-lg border-0 rounded-5 overflow-hidden w-100" style="max-width: 400px;">
        
        <!-- Header Visual (Warna Maroon) -->
        <div class="text-white text-center p-4 pb-5" style="background-color: #800000;">
            <div class="mb-3">
                <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle shadow-sm" style="width: 70px; height: 70px;">
                    <i class="fas fa-utensils fa-2x" style="color: #800000;"></i>
                </div>
            </div>
            <h4 class="fw-bold mb-2 text-white">Login Akun</h4>
            <p class="small mb-0 pb-3 px-3" style="color: #f6eed9; opacity: 0.95;">Silakan login untuk mengakses akun Anda</p>
        </div>

        <!-- Form Login -->
        <div class="card-body bg-white p-4 p-md-5 rounded-top-5" style="margin-top: -25px; position: relative;">
            @if(session('error'))
                <div class="alert alert-danger py-2 small rounded-3 mb-3">{{ session('error') }}</div>
            @endif
            @if(session('success'))
                <div class="alert alert-success py-2 small rounded-3 mb-3">{{ session('success') }}</div>
            @endif

            <form action="{{ route('pelanggan.login.proses') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold small">Email</label>
                    <input type="email" name="email" class="form-control form-control-lg bg-light border-0 fs-6" placeholder="nama@gmail.com" required>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold small">Password</label>
                    <input type="password" name="password" class="form-control form-control-lg bg-light border-0 fs-6" placeholder="••••••••" required>
                </div>

                <button type="submit" class="btn text-white w-100 py-3 fw-bold rounded-3 shadow-sm mb-3" style="background-color: #800000;">
                    Login Sekarang
                </button>

                <div class="text-center">
                    <span class="small text-muted">Belum punya akun pelanggan? </span>
                    <a href="{{ route('pelanggan.register') }}" class="small fw-bold text-decoration-none" style="color: #800000;">Daftar Akun</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection