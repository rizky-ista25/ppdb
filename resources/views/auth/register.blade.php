<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Akun - PPDB Quantum</title>
    <style>
        body {
            background-color: #6b120e;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .register-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 15px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
            text-align: center;
        }

        .register-container img {
            width: 80px;
            margin-bottom: 10px;
        }

        .register-container h2 {
            margin-bottom: 25px;
            color: #6b120e;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            margin: 8px 0 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #e59a34;
            border: none;
            color: white;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
        }

        button:hover {
            background-color: #d1811c;
        }

        .login-link {
            margin-top: 15px;
            display: block;
            color: #6b120e;
            text-decoration: none;
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

    <div class="register-container">
        <img src="https://quantumidea.id/wp-content/uploads/2022/08/QUANTUM-LOGO.png" alt="Logo Quantum">
        <h2>Daftar Akun PPDB</h2>

        <form method="POST" action="/register">
            @csrf

            <input type="text" name="name" placeholder="Nama Lengkap" required>
            <input type="email" name="email" placeholder="Email" required>
           
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>

            <button type="submit">Daftar</button>
            @if ($errors->any())
                <div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li style="color: red">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>

        <div class="footer-text">
            Sudah punya akun? <a href="/login">Masuk</a>
        </div>
    </div>

</body>
</html>
