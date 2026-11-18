<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Qonita Food Store</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #fdfaf6;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
    </style>
</head>
<body>

<div class="container py-4 min-vh-100 d-flex align-items-center justify-content-center">
    <div class="card shadow-lg border-0 rounded-5 overflow-hidden w-100" style="max-width: 400px;">
        
        <!-- Header Visual (Warna Maroon di Atas) -->
        <div class="text-white text-center p-4 pb-5" style="background-color: #800000;">
            <div class="mb-2 mt-2">
                <span style="font-size: 50px;">🥟</span>
            </div>
            <h4 class="fw-bold mb-2 text-white">Daftar Akun</h4>
            <p class="small mb-0 pb-3 px-3" style="color: #faedcd; opacity: 0.95;">Buat akun untuk memulai ajukan sponsor dan lain sebagainya.</p>
        </div>

        <!-- Form Register Pelanggan (Bagian Putih di Bawah) -->
        <div class="card-body bg-white p-4 p-md-5 rounded-top-5" style="margin-top: -25px; position: relative;">
            @if($errors->any())
                <div class="alert alert-danger py-2 small rounded-3 mb-3">
                    <ul class="mb-0 ps-3">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold small">Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ old('nama') }}" class="form-control form-control-lg bg-light border-0 fs-6" placeholder="Masukkan nama lengkap" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold small">Email Pelanggan</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control form-control-lg bg-light border-0 fs-6" placeholder="nama@gmail.com" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold small">Kata Sandi</label>
                    <div class="input-group">
                        <input type="password" name="password" id="password" class="form-control form-control-lg bg-light border-0 fs-6" placeholder="Masukkan kata sandi" required>
                        <button class="btn btn-light bg-light border-0 text-muted px-3" type="button" id="togglePassword" tabindex="-1">
                            <i class="fas fa-eye" id="iconEye"></i>
                        </button>
                    </div>
                    <div class="form-text text-muted mt-1" style="font-size: 11.5px;">
                        *Minimal 8 karakter, wajib mengandung huruf kapital, angka, dan simbol.
                    </div>
                </div>

                <!-- Kolom Konfirmasi Kata Sandi -->
                <div class="mb-4">
                    <label class="form-label fw-semibold small">Konfirmasi Kata Sandi</label>
                    <div class="input-group">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-lg bg-light border-0 fs-6" placeholder="Ulangi kata sandi" required>
                        <button class="btn btn-light bg-light border-0 text-muted px-3" type="button" id="toggleConfirmPassword" tabindex="-1">
                            <i class="fas fa-eye" id="iconConfirmEye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn text-white w-100 py-3 fw-bold rounded-3 shadow-sm mb-3" style="background-color: #800000;">
                    Daftar Sekarang
                </button>

                <div class="text-center">
                    <span class="small text-muted">Sudah punya akun? </span>
                    <a href="{{ route('login') }}" class="small fw-bold" style="color: #800000; text-decoration: underline;">Masuk</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Script Toggle Show/Hide Password & Konfirmasi -->
<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordInput = document.getElementById('password');
        const iconEye = document.getElementById('iconEye');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            iconEye.classList.remove('fa-eye');
            iconEye.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            iconEye.classList.remove('fa-eye-slash');
            iconEye.classList.add('fa-eye');
        }
    });

    document.getElementById('toggleConfirmPassword').addEventListener('click', function () {
        const confirmInput = document.getElementById('password_confirmation');
        const iconConfirmEye = document.getElementById('iconConfirmEye');

        if (confirmInput.type === 'password') {
            confirmInput.type = 'text';
            iconConfirmEye.classList.remove('fa-eye');
            iconConfirmEye.classList.add('fa-eye-slash');
        } else {
            confirmInput.type = 'password';
            iconConfirmEye.classList.remove('fa-eye-slash');
            iconConfirmEye.classList.add('fa-eye');
        }
    });
</script>
</body>
</html>