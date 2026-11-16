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
            min-height: 500px;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 35px rgba(80, 30, 20, 0.12);
        }

        .form-section {
            flex: 1;
            padding: 55px 40px;
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
            padding-right: 45px; /* Memberikan ruang agar teks tidak tertutup ikon */
        }

        /* Tombol ikon mata */
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
        }

        button[type="submit"]:hover {
            background: #9A0000;
        }

        .error {
            color: #c62828;
            font-size: 13px;
            margin-bottom: 15px;
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

            <p class="description">
                Silakan masuk untuk mengakses halaman.
            </p>

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
                <div class="success" role="alert" style="color: #2e7d32; background: #e8f5e9; padding: 10px; border-radius: 6px; margin-bottom: 15px; font-size: 13px;">
                    {{ session('success') }}
                </div>
            @endif
            
            <form action="{{ url('/login') }}" method="POST">
                @csrf

                <label for="email">Email Admin</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Masukkan email admin"
                    value="{{ old('email') }}"
                    autocomplete="username"
                    required
                >

                <label for="password">Password</label>
                <!-- Pembungkus custom agar tombol mata menempel rapi di dalam kotak input -->
                <div class="password-container">
                    <input type="password" name="password" id="password" placeholder="Masukkan password" required>
                    
                    <button type="button" id="togglePassword" tabindex="-1">
                        <i class="fas fa-eye" id="iconEye"></i>
                    </button>
                </div>

                <button type="submit">Login Sekarang</button>

                <div class="text-center" style="margin-top: 20px; text-align: center;">
                    <span style="font-size: 14px; color: #666;">Belum punya akun?</span>
                    <a href="{{ route('register') }}" style="color: #800000; font-weight: bold; text-decoration: underline; margin-left: 5px;">
                        Daftar Akun
                    </a>
                </div>
            </form>

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