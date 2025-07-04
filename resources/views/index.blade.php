@if (Auth::user()->role == 'admin')
    <x-layout title="Dashboard">
        <style>
            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background-color: #f4f6f9;
                margin: 0;
                padding: 0;
            }

            .dashboard-container {
                max-width: 1200px;
                margin: 2rem auto;
                padding: 2rem;
                background-color: white;
                border-radius: 8px;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            }

            .dashboard-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 2rem;
            }

            .dashboard-header h1 {
                font-size: 24px;
                color: #333;
            }

            .user-greeting {
                font-size: 16px;
                color: #555;
            }

            .dashboard-cards {
                display: flex;
                flex-wrap: wrap;
                gap: 1.5rem;
            }

            .card {
                flex: 1 1 250px;
                background-color: #e8f0fe;
                padding: 1.5rem;
                border-radius: 8px;
                text-align: center;
                box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);
                position: relative;
            }

            .card i {
                font-size: 32px;
                color: #1a73e8;
                margin-bottom: 0.75rem;
            }

            .card h2 {
                font-size: 20px;
                color: #1a73e8;
                margin-bottom: 0.5rem;
            }

            .card p {
                font-size: 16px;
                color: #444;
            }

            .footer {
                text-align: center;
                margin-top: 2rem;
                color: #999;
                font-size: 14px;
            }
        </style>

        <div class="dashboard-container">
            <div class="dashboard-header">
                <h1>Dashboard PPDB</h1>
                <div class="user-greeting">Selamat datang, {{ Auth::user()->name ?? 'Admin' }}</div>
            </div>

            <div class="dashboard-cards">
                <div class="card" style="cursor: pointer;" onclick="pendaftar()">
                    <i class="fas fa-user-plus"></i>
                    <h2>Pendaftar</h2>
                    <p>{{ $jmlSiswa }} siswa</p>
                </div>
                <div class="card" style="cursor: pointer;" onclick="verifikasi()">
                    <i class="fas fa-file-alt"></i>
                    <h2>Verifikasi Berkas</h2>
                    <p>{{ $berkasSiswa }} siswa</p>
                </div>
                <div class="card">
                    <i class="fas fa-check-circle"></i>
                    <h2>Sudah Diterima</h2>
                    <p>8 siswa</p>
                </div>
                <div class="card">
                    <i class="fas fa-chart-bar"></i>
                    <h2>Statistik Pendaftaran</h2>
                    <p>Lihat Grafik</p>
                </div>
            </div>

            <div class="footer">
                &copy; 2025 MA Quantum IDEA - Sistem Informasi PPDB
            </div>
        </div>
        <script>
            function pendaftar() {
                window.location.href = "{{ route('pendaftar') }}";
            }
            function verifikasi() {
                window.location.href = "{{ route('verifikasi') }}";
            }
        </script>
    </x-layout>
@else
<x-layout title="Dashboard">
    @php
    
        $fullName = Auth::user()->name;
        $parts = explode(' ', $fullName);

        if (count($parts) > 1 && (strlen($parts[0]) == 1 || substr($parts[0], -1) == '.')) {
            // Jika kata pertama cuma 1 huruf atau berakhiran titik, pakai kata kedua
            $namaTampil = $parts[1];
        } else {
            // Kalau tidak, pakai kata pertama
            $namaTampil = $parts[0];
        }
    @endphp
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f4f8;
            margin: 0;
            padding: 0;
        }

        .dashboard-container {
            max-width: 900px;
            margin: 3rem auto;
            padding: 2rem 2.5rem;
            background: linear-gradient(to right, #ffffff, #f9fbfd);
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
            text-align: center;
        }

        .welcome-title {
            font-size: 28px;
            color: #2d3748;
            margin-bottom: 0.5rem;
        }

        .welcome-subtitle {
            font-size: 16px;
            color: #718096;
            margin-bottom: 2rem;
        }

        .highlight-box {
            background-color: #edf2f7;
            border-left: 5px solid #4299e1;
            padding: 1.25rem;
            margin-bottom: 2rem;
            border-radius: 8px;
            color: #2a4365;
        }

        .action-button {
            display: inline-block;
            padding: 0.75rem 2rem;
            background-color: #3182ce;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .action-button:hover {
            background-color: #2b6bb04f;
        }
    </style>

    <div class="dashboard-container">
        <h1 class="welcome-title">Selamat Datang, {{ $namaTampil }}!</h1>
        <p class="welcome-subtitle">Selamat datang di sistem PPDB MA Quantum IDEA. Silakan isi formulir pendaftaran untuk melanjutkan proses.</p>

        <div class="highlight-box">
            📌 Pastikan data yang kamu isi lengkap dan benar. Jika mengalami kendala, hubungi panitia PPDB.
        </div>

        <a href="{{ route('form') }}" class="action-button">
            Isi Formulir Pendaftaran
        </a>
    </div>
</x-layout>

@endif
