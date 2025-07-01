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

    @if ($ortu)
    {{-- Formulir Terisi --}}
    <div class="biodata-container">
        <div class="biodata-title">📄 Formulir Orang Tua / Wali</div>

        {{-- Status --}}
        <div class="biodata-footer mb-3">
            @php
                $statusKet = strtolower($ortu->status_dok_ortu);
                $badgeClass = match($statusKet) {
                    'diterima' => 'status-diterima',
                    'ditolak' => 'status-ditolak',
                    default => 'status-menunggu'
                };
            @endphp
            <span class="status-badge {{ $badgeClass }}">
                {{ ucfirst($ortu->status_dok_ortu) }}
            </span>
        </div>

        {{-- Data Ayah --}}
        <div class="biodata-group">
            <div class="biodata-title mt-4">👨 Data Ayah</div>
            <div class="biodata-item"><strong>Nama Ayah</strong><span>{{ $ortu->nama_ayah }}</span></div>
            <div class="biodata-item"><strong>Status</strong><span>{{ $ortu->status_ayah }}</span></div>
            <div class="biodata-item"><strong>Kewarganegaraan</strong><span>{{ $ortu->kewarganegaraan_ayah }}</span></div>
            <div class="biodata-item"><strong>NIK</strong><span>{{ $ortu->nik_ayah }}</span></div>
            <div class="biodata-item"><strong>Tempat Lahir</strong><span>{{ $ortu->tempat_lahir_ayah }}</span></div>
            <div class="biodata-item"><strong>Tanggal Lahir</strong><span>{{ \Carbon\Carbon::parse($ortu->tanggal_lahir_ayah)->translatedFormat('d F Y') }}</span></div>
            <div class="biodata-item"><strong>Pendidikan</strong><span>{{ $ortu->pendidikan_ayah }}</span></div>
            <div class="biodata-item"><strong>Pekerjaan</strong><span>{{ $ortu->pekerjaan_ayah }}</span></div>
            <div class="biodata-item"><strong>Penghasilan</strong><span>{{ $ortu->penghasilan_ayah }}</span></div>
            <div class="biodata-item"><strong>No. HP</strong><span>{{ $ortu->no_hp_ayah ?? '-' }}</span></div>
        </div>

        {{-- Data Ibu --}}
        <div class="biodata-group">
            <div class="biodata-title mt-4">👩 Data Ibu</div>
            <div class="biodata-item"><strong>Nama Ibu</strong><span>{{ $ortu->nama_ibu }}</span></div>
            <div class="biodata-item"><strong>Status</strong><span>{{ $ortu->status_ibu }}</span></div>
            <div class="biodata-item"><strong>Kewarganegaraan</strong><span>{{ $ortu->kewarganegaraan_ibu }}</span></div>
            <div class="biodata-item"><strong>NIK</strong><span>{{ $ortu->nik_ibu }}</span></div>
            <div class="biodata-item"><strong>Tempat Lahir</strong><span>{{ $ortu->tempat_lahir_ibu }}</span></div>
            <div class="biodata-item"><strong>Tanggal Lahir</strong><span>{{ \Carbon\Carbon::parse($ortu->tanggal_lahir_ibu)->translatedFormat('d F Y') }}</span></div>
            <div class="biodata-item"><strong>Pendidikan</strong><span>{{ $ortu->pendidikan_ibu }}</span></div>
            <div class="biodata-item"><strong>Pekerjaan</strong><span>{{ $ortu->pekerjaan_ibu }}</span></div>
            <div class="biodata-item"><strong>Penghasilan</strong><span>{{ $ortu->penghasilan_ibu }}</span></div>
            <div class="biodata-item"><strong>No. HP</strong><span>{{ $ortu->no_hp_ibu ?? '-' }}</span></div>
        </div>

        {{-- Data Wali --}}
        @if ($ortu->nik_wali == $ortu->nik_ayah || $ortu->nik_wali == $ortu->nik_ibu)
        <div class="biodata-group d-none">
            @else
            <div class="biodata-group">
        @endif
            <div class="biodata-title mt-4">🧑‍🏫 Data Wali</div>
            <div class="biodata-item"><strong>Nama Wali</strong><span>{{ $ortu->nama_wali }}</span></div>
            <div class="biodata-item"><strong>Status</strong><span>{{ $ortu->status_wali }}</span></div>
            <div class="biodata-item"><strong>Kewarganegaraan</strong><span>{{ $ortu->kewarganegaraan_wali }}</span></div>
            <div class="biodata-item"><strong>NIK</strong><span>{{ $ortu->nik_wali }}</span></div>
            <div class="biodata-item"><strong>Tempat Lahir</strong><span>{{ $ortu->tempat_lahir_wali }}</span></div>
            <div class="biodata-item"><strong>Tanggal Lahir</strong><span>{{ \Carbon\Carbon::parse($ortu->tanggal_lahir_wali)->translatedFormat('d F Y') }}</span></div>
            <div class="biodata-item"><strong>Pendidikan</strong><span>{{ $ortu->pendidikan_wali }}</span></div>
            <div class="biodata-item"><strong>Pekerjaan</strong><span>{{ $ortu->pekerjaan_wali }}</span></div>
            <div class="biodata-item"><strong>Penghasilan</strong><span>{{ $ortu->penghasilan_wali }}</span></div>
            <div class="biodata-item"><strong>No. HP</strong><span>{{ $ortu->no_hp_wali ?? '-' }}</span></div>
        </div>

        <div class="biodata-footer mt-4">
            @php
                $ket = $ortu->status_dok_ortu !== 'ditolak' ? 'disabled' : '';
            @endphp
            <a href="" class="edit-btn {{ $ket }}">✏️ Edit Formulir</a>
        </div>
    </div>
@else
    {{-- Belum ada data formulir --}}
    <div class="biodata-container text-center">
        <h2 class="biodata-title">📄 Formulir Belum Diisi</h2>
        <p class="mb-4" style="font-size: 1rem; color: #666;">Anda belum mengisi formulir biodata orang tua/wali. Silakan lengkapi terlebih dahulu untuk melanjutkan.</p>
        <a href="{{ route('form') }}" class="edit-btn">📝 Isi Formulir</a>
    </div>
@endif

    
</x-layout>
