<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login | Qonita Food Store</title>

    <!-- FontAwesome untuk Ikon Mata -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #FFF4E5;
            padding: 20px;
        }

        .container {
            display: flex;
            width: 850px;
            max-width: 100%;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 35px rgba(80, 30, 20, 0.12);
        }

        .form-section {
            flex: 1;
            padding: 45px 40px;
        }

        h2 {
            color: #332005;
            margin-bottom: 10px;
            font-size: 27px;
        }

        .description {
            color: #888;
            font-size: 13px;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #604113;
            font-size: 13px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 13px;
            border: 1px solid #EED1A6;
            border-radius: 9px;
            outline: none;
        }

        input:focus {
            border-color: #820000;
        }

        /* Styling khusus untuk membungkus input password & tombol mata agar sejajar */
        .password-container {
            position: relative;
            width: 100%;
            margin-top: 8px;
            margin-bottom: 20px;
        }

        .password-container input {
            margin-bottom: 0;
            padding-right: 45px;
        }

        #togglePassword {
            position: absolute;
            top: 50%;
            right: 12px;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #888;
            font-size: 16px;
            padding: 5px;
        }

        #togglePassword:hover {
            color: #820000;
        }

        button[type="submit"] {
            width: 100%;
            padding: 14px;
            background: #820000;
            color: white;
            border: none;
            border-radius: 9px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s;
        }

        button[type="submit"]:hover {
            background: #9A0000;
        }

        /* Styling Tombol Google */
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

        /* Garis Pembatas "Atau" */
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

        .divider::before { margin-right: 10px; }
        .divider::after { margin-left: 10px; }

        .error {
            color: #c62828;
            background: #ffebee;
            padding: 10px;
            border-radius: 6px;
            font-size: 13px;
            margin-bottom: 15px;
        }

        .success {
            color: #2e7d32;
            background: #e8f5e9;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 13px;
        }

        .visual-section {
            flex: 0.9;
            background: #820000;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 35px;
        }

        .visual-section .emoji {
            font-size: 100px;
            margin-bottom: 25px;
        }

        .visual-section h3 {
            font-size: 26px;
            margin-bottom: 12px;
        }

        .visual-section .subtitle {
            color: #FFF4E5;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 35px;
        }

        .visual-section p {
            color: #FFF4E5;
            font-size: 14px;
            line-height: 1.7;
        }

        @media (max-width: 650px) {
            .visual-section {
                display: none;
            }
            .form-section {
                padding: 40px 25px;
            }
        }
    </style>
</head>

<body>
    <main class="container">

        <!-- BAGIAN KIRI: FORM LOGIN -->
        <section class="form-section">

            <h2>Selamat Datang!</h2>
            <p class="description">Silakan masuk untuk mengakses halaman.</p>

            @if ($errors->any())
                <div class="error" role="alert">
                    {{ $errors->first() }}
                </div>
            @endif

            @if (session('error'))
                <div class="error" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('login.proses') }}" method="POST">
                @csrf

                <label for="login">Username atau Email</label>
                <input
                    type="text"
                    id="login"
                    name="login"
                    placeholder="Masukkan username atau email"
                    value="{{ old('login') }}"
                    autocomplete="username"
                    required
                >

                <label for="password" style="margin-top: 15px;">Kata Sandi</label>
                <div class="password-container">
                    <input
                        type="password"
                        name="password"
                        id="password"
                        placeholder="Masukkan kata sandi"
                        autocomplete="current-password"
                        required
                    >
                    <button type="button" id="togglePassword" tabindex="-1">
                        <i class="fas fa-eye" id="iconEye"></i>
                    </button>
                </div>

                <button type="submit">Masuk Sekarang</button>

                <div style="margin-top: 18px; text-align: center;">
                    <span style="font-size: 14px; color: #666;">Belum punya akun?</span>
                    <a href="{{ route('register') }}" style="color: #800000; font-weight: bold; text-decoration: underline; margin-left: 5px;">
                        Daftar Akun
                    </a>
                </div>
            </form>

            <!-- Garis Pembatas -->
            <div class="divider">Atau masuk dengan</div>

            <!-- Tombol Google OAuth -->
            <a href="{{ route('google.login') }}" class="btn-google">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 48 48" style="margin-right: 10px;">
                    <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/>
                    <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/>
                    <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"/>
                    <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.46-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/>
                </svg>
                Lanjutkan dengan Google
            </a>

        </section>

        <!-- BAGIAN KANAN: IDENTITAS DIMSUM QONITA -->
        <aside class="visual-section">
            <div class="emoji">🥟</div>
            <h3>Qonita Food Store</h3>
            <p class="subtitle">
                Sistem Pengelolaan Qonita Food Store
            </p>
            <p>
                Kelola produk dan aktivitas Qonita Food Store
                melalui satu sistem yang praktis.
            </p>
        </aside>

    </main>

    <!-- Skrip JavaScript untuk Toggle Show/Hide Password -->
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
    </script>
</body>
</html>