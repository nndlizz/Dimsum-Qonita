<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin | Dimsum Qonita</title>

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

        .brand {
            color: #820000;
            font-size: 25px;
            font-weight: bold;
            margin-bottom: 12px;
        }

        .subtitle {
            color: #886128;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 35px;
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
            margin-bottom: 20px;
            outline: none;
        }

        input:focus {
            border-color: #820000;
        }

        button {
            width: 100%;
            padding: 14px;
            background: #820000;
            color: white;
            border: none;
            border-radius: 9px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
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
                Silakan login untuk masuk ke halaman admin.
            </p>

            @if ($errors->any())
                <div class="error" role="alert">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('admin.login.process') }}" method="POST">
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
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Masukkan password"
                    autocomplete="current-password"
                    required
                >

                <button type="submit">Login Sekarang</button>
            </form>

        </section>

        <!-- BAGIAN KANAN: IDENTITAS DIMSUM QONITA -->
        <aside class="visual-section">

            <div class="emoji">🥟</div>

            <h3>Dimsum Qonita</h3>

            <p class="subtitle">
                Sistem Pengelolaan Dimsum Qonita
            </p>

            <p>
                Kelola produk dan aktivitas Dimsum Qonita
                melalui satu sistem yang praktis.
            </p>

        </aside>

    </main>
</body>
</html>
