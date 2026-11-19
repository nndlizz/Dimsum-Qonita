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
        /* Styling Tombol Google ala Aplikasi Modern */
        .btn-google {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 12px;
            background: #ffffff;
            color: #3c4043;
            border: 1px solid #dadce0;
            border-radius: 9px;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            transition: background 0.2s, box-shadow 0.2s;
            margin-top: 15px;
        }

        .btn-google:hover {
            background: #f8f9fa;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.12);
        }

        .btn-google img {
            width: 18px;
            height: 18px;
            margin-right: 10px;
        }

        /* Garis Pembatas "Atau" yang Elegan */
        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            color: #888;
            font-size: 12px;
            margin: 20px 0;
        }

        .divider::before, .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #EED1A6;
        }

        .divider::before {
            margin-right: 10px;
        }

        .divider::after {
            margin-left: 10px;
        }
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
            <!-- Ikon sendok garpu sudah dihapus, emoji gyoza diperbesar -->
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
                    <label class="form-label fw-semibold small">Username</label>
                    <input type="text" name="username" value="{{ old('username') }}" class="form-control form-control-lg bg-light border-0 fs-6" placeholder="Masukkan username..." required>
                </div>

                <div class="mb-4">
                <label class="form-label fw-semibold small">Kata Sandi</label>
                
                <!-- Bungkus dengan input-group agar tombol mata sejajar di sebelah kanan -->
                <div class="input-group">
                    <input type="password" name="password" id="password" class="form-control form-control-lg bg-light border-0 fs-6" placeholder="Masukkan password" required>
                    
                    <!-- Tombol Show/Hide Password -->
                    <button class="btn btn-light bg-light border-0 text-muted px-3" type="button" id="togglePassword" tabindex="-1">
                        <i class="fas fa-eye" id="iconEye"></i>
                    </button>
                </div>

                <div class="form-text text-muted mt-1" style="font-size: 11.5px;">
                    * Minimal 8 karakter, wajib mengandung huruf kapital, angka, dan simbol (contoh: <strong>Qonita1!</strong>).
                </div>

                <div class="mb-4">
                <label class="form-label fw-semibold small">Konfirmasi Kata Sandi</label>
                
                <!-- Bungkus dengan input-group agar tombol mata sejajar di sebelah kanan -->
                <div class="input-group">
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-lg bg-light border-0 fs-6" placeholder="Ulangi kata sandi" required>

                    <!-- Tombol Show/Hide Password -->
                    <button class="btn btn-light bg-light border-0 text-muted px-3" type="button" id="togglePassword" tabindex="-1">
                        <i class="fas fa-eye" id="iconEye"></i>
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

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<!-- Konten form registrasi/login kamu di atas... -->

    <!-- BAGIAN PENEMPATAN SCRIPT -->
    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordInput = document.getElementById('password');
            const iconEye = document.getElementById('iconEye');

            // Ubah tipe input dari password ke text, atau sebaliknya
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                iconEye.classList.remove('fa-eye');
                iconEye.classList.add('fa-eye-slash'); // Ikon mata dicoret
            } else {
                passwordInput.type = 'password';
                iconEye.classList.remove('fa-eye-slash');
                iconEye.classList.add('fa-eye'); // Ikon mata normal
            }
        });
    </script>
</body>
</html>