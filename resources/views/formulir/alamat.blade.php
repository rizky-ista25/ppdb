<x-layout title="Formulir Alamat">
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

    @if ($alamat)
        <div class="biodata-container">
            <div class="biodata-title">📍 Data Alamat</div>

            {{-- Status Dokumen Alamat --}}
            <div class="biodata-footer mb-3">
                @php
                    $statusKetAlamat = strtolower($alamat->status_dok_alamat);
                    $badgeAlamat = match($statusKetAlamat) {
                        'diterima' => 'status-diterima',
                        'ditolak' => 'status-ditolak',
                        default => 'status-menunggu'
                    };
                @endphp
                <span class="status-badge {{ $badgeAlamat }}">
                    {{ ucfirst($alamat->status_dok_alamat) }}
                </span>
            </div>

            {{-- Alamat Ayah --}}
            <div class="biodata-group">
                <div class="biodata-title mt-4">👨 Alamat Ayah</div>
                <div class="biodata-item"><strong>Status Kepemilikan Rumah</strong><span>{{ $alamat->pemilikan_rumah_ayah }}</span></div>
                <div class="biodata-item"><strong>Provinsi</strong><span>{{ $alamat->provinsi_ayah }}</span></div>
                <div class="biodata-item"><strong>Kab/Kota</strong><span>{{ $alamat->kab_kota_ayah }}</span></div>
                <div class="biodata-item"><strong>Kecamatan</strong><span>{{ $alamat->kecamatan_ayah }}</span></div>
                <div class="biodata-item"><strong>Kelurahan/Desa</strong><span>{{ $alamat->kel_des_ayah }}</span></div>
                <div class="biodata-item"><strong>RT/RW</strong><span>{{ $alamat->rt_ayah }}/{{ $alamat->rw_ayah }}</span></div>
                <div class="biodata-item"><strong>Alamat Lengkap</strong><span>{{ $alamat->alamat_ayah }}</span></div>
                <div class="biodata-item"><strong>Kode Pos</strong><span>{{ $alamat->kode_pos_ayah }}</span></div>
            </div>

            {{-- Alamat Ibu --}}
            <div class="biodata-group">
                <div class="biodata-title mt-4">👩 Alamat Ibu</div>
                <div class="biodata-item"><strong>Status Kepemilikan Rumah</strong><span>{{ $alamat->pemilikan_rumah_ibu }}</span></div>
                <div class="biodata-item"><strong>Provinsi</strong><span>{{ $alamat->provinsi_ibu }}</span></div>
                <div class="biodata-item"><strong>Kab/Kota</strong><span>{{ $alamat->kab_kota_ibu }}</span></div>
                <div class="biodata-item"><strong>Kecamatan</strong><span>{{ $alamat->kecamatan_ibu }}</span></div>
                <div class="biodata-item"><strong>Kelurahan/Desa</strong><span>{{ $alamat->kel_des_ibu }}</span></div>
                <div class="biodata-item"><strong>RT/RW</strong><span>{{ $alamat->rt_ibu }}/{{ $alamat->rw_ibu }}</span></div>
                <div class="biodata-item"><strong>Alamat Lengkap</strong><span>{{ $alamat->alamat_ibu }}</span></div>
                <div class="biodata-item"><strong>Kode Pos</strong><span>{{ $alamat->kode_pos_ibu }}</span></div>
            </div>

            {{-- Alamat Wali --}}
            <div class="biodata-group">
                <div class="biodata-title mt-4">🧑‍🏫 Alamat Wali</div>
                <div class="biodata-item"><strong>Status Kepemilikan Rumah</strong><span>{{ $alamat->pemilikan_rumah_wali }}</span></div>
                <div class="biodata-item"><strong>Provinsi</strong><span>{{ $alamat->provinsi_wali }}</span></div>
                <div class="biodata-item"><strong>Kab/Kota</strong><span>{{ $alamat->kab_kota_wali }}</span></div>
                <div class="biodata-item"><strong>Kecamatan</strong><span>{{ $alamat->kecamatan_wali }}</span></div>
                <div class="biodata-item"><strong>Kelurahan/Desa</strong><span>{{ $alamat->kel_des_wali }}</span></div>
                <div class="biodata-item"><strong>RT/RW</strong><span>{{ $alamat->rt_wali }}/{{ $alamat->rw_wali }}</span></div>
                <div class="biodata-item"><strong>Alamat Lengkap</strong><span>{{ $alamat->alamat_wali }}</span></div>
                <div class="biodata-item"><strong>Kode Pos</strong><span>{{ $alamat->kode_pos_wali }}</span></div>
            </div>

            {{-- Alamat Siswa --}}
            <div class="biodata-group">
                <div class="biodata-title mt-4">🧒 Alamat Siswa</div>
                <div class="biodata-item"><strong>Status Tempat Tinggal</strong><span>{{ $alamat->status_tempat_tinggal }}</span></div>
                <div class="biodata-item"><strong>Provinsi</strong><span>{{ $alamat->provinsi_siswa }}</span></div>
                <div class="biodata-item"><strong>Kab/Kota</strong><span>{{ $alamat->kab_kota_siswa }}</span></div>
                <div class="biodata-item"><strong>Kecamatan</strong><span>{{ $alamat->kecamatan_siswa }}</span></div>
                <div class="biodata-item"><strong>Kelurahan/Desa</strong><span>{{ $alamat->kel_des_siswa }}</span></div>
                <div class="biodata-item"><strong>RT/RW</strong><span>{{ $alamat->rt_siswa }}/{{ $alamat->rw_siswa }}</span></div>
                <div class="biodata-item"><strong>Alamat Lengkap</strong><span>{{ $alamat->alamat_siswa }}</span></div>
                <div class="biodata-item"><strong>Kode Pos</strong><span>{{ $alamat->kode_pos_siswa }}</span></div>
                <div class="biodata-item"><strong>Jarak ke Sekolah</strong><span>{{ $alamat->jarak }}</span></div>
                <div class="biodata-item"><strong>Transportasi</strong><span>{{ $alamat->transportasi }}</span></div>
                <div class="biodata-item"><strong>Waktu Tempuh</strong><span>{{ $alamat->waktu_tempuh }}</span></div>
            </div>

            {{-- Tombol Edit --}}
            <div class="biodata-footer mt-4">
                @php
                    $ketAlamat = $alamat->status_dok_alamat !== 'ditolak' ? 'disabled' : '';
                @endphp
                <a href="/form" class="edit-btn {{ $ketAlamat }}"> Upload Ulang Formulir</a>
            </div>
        </div>
    @else
        {{-- Belum ada data --}}
        <div class="biodata-container text-center">
            <h2 class="biodata-title">📍 Data Alamat Belum Diisi</h2>
            <p class="mb-4" style="font-size: 1rem; color: #666;">Anda belum mengisi data alamat. Silakan lengkapi terlebih dahulu.</p>
            <a href="{{ route('form') }}" class="edit-btn">📝 Isi Formulir</a>
        </div>
    @endif

    
</x-layout>
