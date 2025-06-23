<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ 'image/icon-quantum.png' }}" type="image/x-icon">
    <title>PPDB MA Quantum IDEA | Login</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #6b120e, #e59a34);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background: #fff;
            padding: 40px 30px;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.25);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .login-container img.logo {
            width: 120px;
            margin-bottom: 20px;
        }

        .login-container h2 {
            margin-bottom: 20px;
            color: #6b120e;
            font-size: 24px;
        }

        .form-group {
            text-align: left;
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: #333;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            box-sizing: border-box;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #e59a34;
            box-shadow: 0 0 0 2px rgba(229, 154, 52, 0.3);
            outline: none;
        }

        .submit-btn {
            background-color: #e59a34;
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-btn:hover {
            background-color: #cf852c;
        }

        .footer-text {
            font-size: 13px;
            color: #777;
            margin-top: 16px;
        }

        .footer-text a {
            color: #6b120e;
            text-decoration: none;
            font-weight: bold;
        }

        .footer-text a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="login-container">
    <img src="https://quantumidea.id/wp-content/uploads/2022/08/QUANTUM-LOGO.png" alt="Quantum Logo" class="logo">
    <h2>Login ke Akun Anda</h2>

    <form method="POST" action="/login">
        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Masukkan email" required autofocus>
        </div>

        <div class="form-group">
            <label for="password">Kata Sandi</label>
            <input type="password" id="password" name="password" placeholder="Masukkan kata sandi" required>
        </div>

        <button type="submit" class="submit-btn">Masuk</button>
        @if (session('ok'))
            <div>
                <p style="color: green">{{ session('ok') }}</p>
            </div>
        @endif
        @error ('email')
            <div>
                <p style="color: red">{{ $message }}</p>
            </div>
        @enderror
    </form>

    <div class="footer-text">
        Belum punya akun? <a href="/register">Daftar di sini</a>
    </div>
</div>

</body>
</html>
