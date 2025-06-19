<x-layout>
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
            <div class="card">
                <i class="fas fa-user-plus"></i>
                <h2>Pendaftar Baru</h2>
                <p>23 siswa</p>
            </div>
            <div class="card">
                <i class="fas fa-file-alt"></i>
                <h2>Verifikasi Berkas</h2>
                <p>15 siswa</p>
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
</x-layout>
