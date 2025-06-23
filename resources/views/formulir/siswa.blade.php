<x-layout>
    <style>
        .biodata-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            font-family: 'Segoe UI', sans-serif;
        }

        .biodata-title {
            text-align: center;
            font-size: 1.8rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
            color: #333;
        }

        .biodata-group {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 1.2rem;
        }

        .biodata-item {
            flex: 1 1 45%;
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 6px;
        }

        .biodata-item strong {
            display: block;
            font-size: 0.9rem;
            color: #555;
            margin-bottom: 0.3rem;
        }

        .biodata-item span {
            font-size: 1rem;
            color: #222;
        }

        .biodata-footer {
            text-align: center;
            margin-top: 2rem;
        }

        .edit-btn {
            padding: 0.6rem 1.4rem;
            font-size: 1rem;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .edit-btn:hover {
            background-color: #0056b3;
        }
    </style>

    <div class="biodata-container">
        <div class="biodata-title">📄 Formulir Saya</div>

        <div class="biodata-group">
            <div class="biodata-item">
                <strong>Nama Lengkap</strong>
                <span>{{ $siswa->nama_lengkap }}</span>
            </div>
            <div class="biodata-item">
                <strong>Email</strong>
                <span>{{ $siswa->email }}</span>
            </div>

            <div class="biodata-item">
                <strong>NIK</strong>
                <span>{{ $siswa->nik }}</span>
            </div>
            <div class="biodata-item">
                <strong>NISN</strong>
                <span>{{ $siswa->nisn }}</span>
            </div>

            <div class="biodata-item">
                <strong>Tempat, Tanggal Lahir</strong>
                <span>{{ $siswa->tempat_lahir }}, {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->translatedFormat('d F Y') }}</span>
            </div>
            <div class="biodata-item">
                <strong>Agama</strong>
                <span>{{ ucfirst($siswa->agama) }}</span>
            </div>

            <div class="biodata-item">
                <strong>Jenis Kelamin</strong>
                <span>{{ ucfirst($siswa->jenis_kelamin) }}</span>
            </div>
            <div class="biodata-item">
                <strong>Jumlah Saudara</strong>
                <span>{{ $siswa->jumlah_sodara }}</span>
            </div>

            <div class="biodata-item">
                <strong>Anak Ke</strong>
                <span>{{ $siswa->anakke }}</span>
            </div>
            <div class="biodata-item">
                <strong>Hobi</strong>
                <span>{{ $siswa->hobi }}</span>
            </div>

            <div class="biodata-item">
                <strong>Cita-cita</strong>
                <span>{{ $siswa->cita_cita }}</span>
            </div>
            <div class="biodata-item">
                <strong>No HP</strong>
                <span>{{ $siswa->no_hp }}</span>
            </div>

            <div class="biodata-item">
                <strong>Disabilitas</strong>
                <span>{{ ucfirst($siswa->kebutuhan_disabillitas) }}</span>
            </div>
            <div class="biodata-item">
                <strong>Kebutuhan Khusus</strong>
                <span>{{ ucfirst($siswa->kebutuhan_khusus) }}</span>
            </div>

            <div class="biodata-item" style="flex: 1 1 100%;">
                <strong>Alamat</strong>
                <span>{{ $siswa->alamat }}</span>
            </div>

            <div class="biodata-item">
                <strong>Status Tempat Tinggal</strong>
                <span>{{ $siswa->status_tempat_tinggal }}</span>
            </div>
            <div class="biodata-item">
                <strong>Jarak Tempat Tinggal</strong>
                <span>{{ $siswa->jarak_tempat_tinggal }}</span>
            </div>

            <div class="biodata-item">
                <strong>Waktu Tempuh</strong>
                <span>{{ $siswa->waktu_tempuh }}</span>
            </div>
            <div class="biodata-item">
                <strong>Transportasi</strong>
                <span>{{ $siswa->transportasi }}</span>
            </div>
        </div>

        <div class="biodata-footer">
            <a href="" class="edit-btn">✏️ Edit Biodata</a>
        </div>
    </div>
</x-layout>
