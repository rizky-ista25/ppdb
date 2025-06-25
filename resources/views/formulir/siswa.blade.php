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
            background-color: #0057b34f;
        }

        .disabled {
            pointer-events: none;
            opacity: 0.6;
            background-color: #6c757d !important;
            cursor: not-allowed;
        }


        .status-badge {
            display: inline-block;
            padding: 0.4rem 1rem;
            font-size: 0.9rem;
            font-weight: 600;
            border-radius: 20px;
            color: #fff;
        }

        .status-menunggu {
            background-color: #ffc107;
        }

        .status-diterima {
            background-color: #28a745;
        }

        .status-ditolak {
            background-color: #dc3545;
        }
    </style>

    @if ($siswa)
        {{-- Formulir Terisi --}}
        <div class="biodata-container">
            <div class="biodata-title">📄 Formulir Saya</div>

            {{-- Status --}}
            <div class="biodata-footer mb-3">
                @php
                    $statusKet = strtolower($status);
                    $badgeClass = match($statusKet) {
                        'diterima' => 'status-diterima',
                        'ditolak' => 'status-ditolak',
                        default => 'status-menunggu'
                    };
                @endphp
                <span class="status-badge {{ $badgeClass }}">
                    {{ ucfirst($status) }}
                </span>
            </div>
            
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
                    <strong>NIS Lokal</strong>
                    <span>{{ $siswa->nis_lokal ?? '-' }}</span>
                </div>
                <div class="biodata-item">
                    <strong>Kewarganegaraan</strong>
                    <span>{{ $siswa->kewarganegaraan }}</span>
                </div>
                <div class="biodata-item">
                    <strong>Tempat, Tanggal Lahir</strong>
                    <span>{{ $siswa->tempat_lahir }}</span>
                </div>
                <div class="biodata-item">
                    <strong>Tanggal Lahir</strong>
                    <span>{{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->translatedFormat('d F Y') }}</span>
                </div>
                <div class="biodata-item">
                    <strong>Jenis Kelamin</strong>
                    <span>{{ ucfirst($siswa->jenis_kelamin) }}</span>
                </div>
                <div class="biodata-item">
                    <strong>Agama</strong>
                    <span>{{ ucfirst($siswa->agama) }}</span>
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
                    <strong>Cita-cita</strong>
                    <span>{{ $siswa->cita_cita }}</span>
                </div>
                <div class="biodata-item">
                    <strong>No HP</strong>
                    <span>{{ $siswa->no_hp ?? '-' }}</span>
                </div>
                <div class="biodata-item">
                    <strong>Hobi</strong>
                    <span>{{ $siswa->hobi }}</span>
                </div>
                <div class="biodata-item">
                    <strong>Pembiaya Sekolah</strong>
                    <span>{{ $siswa->pembiaya_sekolah }}</span>
                </div>
                <div class="biodata-item">
                    <strong>Pendidikan Pra Sekolah</strong>
                    <span>{{ $siswa->pra_sekolah }}</span>
                </div>
                <div class="biodata-item">
                    <strong>KIP</strong>
                    <span>{{ $siswa->kip ?? '-' }}</span>
                </div>
                <div class="biodata-item">
                    <strong>No. KK</strong>
                    <span>{{ $siswa->kk }}</span>
                </div>
                <div class="biodata-item">
                    <strong>Kepala Keluarga</strong>
                    <span>{{ $siswa->kepala_kk }}</span>
                </div>
            </div>


            <div class="biodata-footer">
                @php
                    if ($status !== 'ditolak') {
                        $ket = 'disabled';
                    }else{
                        $ket = '';
                    }
                @endphp
                <a href="" class="edit-btn {{ $ket }}">✏️ Edit Formulir</a>
            </div>
        </div>
    @else
        {{-- Belum ada data formulir --}}
        <div class="biodata-container text-center">
            <h2 class="biodata-title">📄 Formulir Belum Diisi</h2>
            <p class="mb-4" style="font-size: 1rem; color: #666;">Anda belum mengisi formulir biodata. Silakan lengkapi terlebih dahulu untuk melanjutkan.</p>
            <a href="{{ route('form') }}" class="edit-btn">📝 Isi Formulir</a>
        </div>
    @endif
    
</x-layout>
