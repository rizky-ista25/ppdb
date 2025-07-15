<x-layout title="Detail Verifikasi">
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
<div class="row m-3">
    <div class="col-12 col-sm-12 m-auto">
        <div class="card card-primary card-tabs">
            <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Data Siswa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Data Orang Tua/Wali</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Data Alamat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-berkas-tab" data-toggle="pill" href="#custom-tabs-one-berkas" role="tab" aria-controls="custom-tabs-one-berkas" aria-selected="false">Berkas</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                    <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                    @if ($siswa)
                    {{-- Formulir Terisi --}}
                    <div class="biodata-container">
                        <div class="biodata-title">📄 Data Siswa</div>

                        {{-- Status --}}
                        <div class="biodata-footer mb-3">
                            @php
                                $statusKet = strtolower($statusSiswa);
                                $badgeClass = match($statusKet) {
                                    'diterima' => 'status-diterima',
                                    'ditolak' => 'status-ditolak',
                                    default => 'status-menunggu'
                                };
                            @endphp
                            <span class="status-badge {{ $badgeClass }}">
                                {{ ucfirst($statusSiswa) }}
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
                            <div class="custom-dropdown" style="position: relative; display: inline-block;">
                                <button id="dropdownBtn" class="btn btn-secondary" type="button" style="cursor:pointer;">
                                    Tindakan
                                </button>
                                <ul id="dropdownMenu" class="custom-dropdown-menu" style="display:none; position:absolute; left:0; top:100%; background:#fff; border:1px solid #ccc; border-radius:6px; min-width:140px; box-shadow:0 2px 8px rgba(0,0,0,0.08); margin:0; padding:0; z-index:10;">
                                    <li style="list-style:none;">
                                        <a href="#" data-status="diterima" onclick="setujuiSiswa(this); return false;" style="display:block; padding:8px 16px; color:#222; text-decoration:none;">
                                            <i class="fas fa-check-circle text-success mr-2"></i> Setujui
                                        </a>
                                    </li>
                                    <li style="list-style:none;">
                                        <a href="#" data-status="ditolak" onclick="tolakSiswa(this); return false;" style="display:block; padding:8px 16px; color:#222; text-decoration:none;">
                                            <i class="fas fa-times-circle text-danger mr-2"></i> Tolak
                                        </a>
                                    </li>
                                </ul>
                                <form method="POST" id="form-siswa" style="display:none;">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $siswa->user_id }}">
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    {{-- Belum ada data formulir --}}
                    <div class="biodata-container text-center">
                        <h2 class="biodata-title">📄 Formulir Belum Diisi</h2>
                        <p class="mb-4" style="font-size: 1rem; color: #666;">Peserta didik belum mengisi formulir biodata.</p>
                        
                    </div>
                @endif
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
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
                                <div class="custom-dropdown" style="position: relative; display: inline-block;">
                                    <button id="dropdownBtnOrtu" class="btn btn-secondary" type="button" style="cursor:pointer;">
                                        Tindakan
                                    </button>
                                    <ul id="dropdownMenuOrtu" class="custom-dropdown-menu" style="display:none; position:absolute; left:0; top:100%; background:#fff; border:1px solid #ccc; border-radius:6px; min-width:140px; box-shadow:0 2px 8px rgba(0,0,0,0.08); margin:0; padding:0; z-index:10;">
                                        <li style="list-style:none;">
                                            <a href="#" data-status="diterima" onclick="setujuiOrtu(this); return false;" style="display:block; padding:8px 16px; color:#222; text-decoration:none;">
                                                <i class="fas fa-check-circle text-success mr-2"></i> Setujui
                                            </a>
                                        </li>
                                        <li style="list-style:none;">
                                            <a href="#" data-status="ditolak" onclick="tolakOrtu(this); return false;" style="display:block; padding:8px 16px; color:#222; text-decoration:none;">
                                                <i class="fas fa-times-circle text-danger mr-2"></i> Tolak
                                            </a>
                                        </li>
                                    </ul>
                                    <form method="POST" id="form-ortu" style="display:none;">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $ortu->siswa_id }}">
                                    </form>
                                </div>
                            </div>
                        </div>
                        @else
                            {{-- Belum ada data formulir --}}
                            <div class="biodata-container text-center">
                                <h2 class="biodata-title">📄 Formulir Belum Diisi</h2>
                                <p class="mb-4" style="font-size: 1rem; color: #666;">Peserta didik belum mengisi formulir biodata orang tua/wali.</p>
                            </div>
                        @endif
                    </div>
                        <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
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
                                <div class="custom-dropdown" style="position: relative; display: inline-block;">
                                    <button id="dropdownBtnAlamat" class="btn btn-secondary" type="button" style="cursor:pointer;">
                                        Tindakan
                                    </button>
                                    <ul id="dropdownMenuAlamat" class="custom-dropdown-menu" style="display:none; position:absolute; left:0; top:100%; background:#fff; border:1px solid #ccc; border-radius:6px; min-width:140px; box-shadow:0 2px 8px rgba(0,0,0,0.08); margin:0; padding:0; z-index:10;">
                                        <li style="list-style:none;">
                                            <a href="#" data-status="diterima" onclick="setujuiAlamat(this); return false;" style="display:block; padding:8px 16px; color:#222; text-decoration:none;">
                                                <i class="fas fa-check-circle text-success mr-2"></i> Setujui
                                            </a>
                                        </li>
                                        <li style="list-style:none;">
                                            <a href="#" data-status="ditolak" onclick="tolakAlamat(this); return false;" style="display:block; padding:8px 16px; color:#222; text-decoration:none;">
                                                <i class="fas fa-times-circle text-danger mr-2"></i> Tolak
                                            </a>
                                        </li>
                                    </ul>
                                    <form method="POST" id="form-alamat" style="display:none;">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $alamat->alamatSiswa_id }}">
                                    </form>
                                </div>
                            </div>
                        </div>
                        @else
                            {{-- Belum ada data --}}
                            <div class="biodata-container text-center">
                                <h2 class="biodata-title">📍 Data Alamat Belum Diisi</h2>
                                <p class="mb-4" style="font-size: 1rem; color: #666;">Peserta didik belum mengisi data alamat.</p>
                            </div>
                        @endif
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-one-berkas" role="tabpanel" aria-labelledby="custom-tabs-one-berkas-tab">
                            @if ($berkas)
                            <div class="biodata-container">
                                <h2 class="biodata-title mb-4">📁 Daftar Berkas yang Diupload</h2>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped align-middle">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th style="width: 5%;">No</th>
                                                <th>Nama Berkas</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                // Daftar field berkas yang ingin ditampilkan
                                                $daftarBerkas = [
                                                    'kk' => 'Kartu Keluarga (KK)',
                                                    'akta_kelahiran' => 'Akta Kelahiran',
                                                    'ijazah' => 'Ijazah',
                                                    'sktm' => 'Surat Keterangan Tidak Mampu (SKTM)',
                                                    'ktp_ayah' => 'KTP Ayah',
                                                    'ktp_ibu' => 'KTP Ibu',
                                                    'ktp_wali' => 'KTP Wali'
                                                ];
                                                $adaBerkas = false;
                                            @endphp

                                            @foreach ($daftarBerkas as $field => $label)
                                                @if (!empty($berkas->$field))
                                                    @php $adaBerkas = true; @endphp
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            <a href="{{ Storage::url('uploads/berkas_' . $siswa->nisn . '/' . $berkas->$field) }}" target="_blank" style="text-decoration: underline;">
                                                                {{ $label }}
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach

                                            @if (!$adaBerkas)
                                                <tr>
                                                    <td colspan="3" class="text-center text-muted">Belum ada berkas yang diupload.</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-4 d-flex justify-content-end">
                                    <a href="{{ url()->previous() }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left mr-2"></i> Kembali
                                    </a>
                                </div>
                            </div>
                            @else
                                {{-- Belum ada data --}}
                                <div class="biodata-container text-center">
                                    <h2 class="biodata-title">📍 Berkas belum diupload</h2>
                                    <p class="mb-4" style="font-size: 1rem; color: #666;">Peserta didik belum mengupload berkas.</p>
                                    <div class="mt-4 d-flex justify-content-center">
                                        <a href="{{ url()->previous() }}" class="btn btn-secondary">
                                            <i class="fas fa-arrow-left mr-2"></i> Kembali
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            <!-- /.card -->
        </div>
        </div>
    </div>
</div>
<script>
    // Dropdown logic JS only, no Bootstrap
    document.addEventListener('DOMContentLoaded', function() {
        const btn = document.getElementById('dropdownBtn');
        const menu = document.getElementById('dropdownMenu');
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
        });
        document.addEventListener('click', function() {
            menu.style.display = 'none';
        });
    });


    document.addEventListener('DOMContentLoaded', function() {
        const btn = document.getElementById('dropdownBtnOrtu');
        const menu = document.getElementById('dropdownMenuOrtu');
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
        });
        document.addEventListener('click', function() {
            menu.style.display = 'none';
        });
    });
    document.addEventListener('DOMContentLoaded', function() {
        const btn = document.getElementById('dropdownBtnAlamat');
        const menu = document.getElementById('dropdownMenuAlamat');
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
        });
        document.addEventListener('click', function() {
            menu.style.display = 'none';
        });
    });
    // Example handlers (should be defined elsewhere in your script)
    function setujuiSiswa(el) {
        const form = document.getElementById('form-siswa');
        // Add status input
        let input = form.querySelector('input[name="status"]');
        if (!input) {
            input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'status';
            form.appendChild(input);
        }
        input.value = el.getAttribute('data-status');
        form.action = "{{ route('update_form_siswa') }}"; // Ganti dengan route yang sesuai
        form.submit();
    }
    function tolakSiswa(el) {
        const form = document.getElementById('form-siswa');
        let input = form.querySelector('input[name="status"]');
        if (!input) {
            input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'status';
            form.appendChild(input);
        }
        input.value = el.getAttribute('data-status');
        form.action = "{{ route('update_form_siswa') }}"; // Ganti dengan route yang sesuai
        form.submit();
    }
    function setujuiOrtu(el) {
        const form = document.getElementById('form-ortu');
        // Add status input
        let input = form.querySelector('input[name="status"]');
        if (!input) {
            input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'status';
            form.appendChild(input);
        }
        input.value = el.getAttribute('data-status');
        form.action = "{{ route('update_form_ortu') }}"; // Ganti dengan route yang sesuai
        form.submit();
    }
    function tolakOrtu(el) {
        const form = document.getElementById('form-ortu');
        let input = form.querySelector('input[name="status"]');
        if (!input) {
            input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'status';
            form.appendChild(input);
        }
        input.value = el.getAttribute('data-status');
        form.action = "{{ route('update_form_ortu') }}"; // Ganti dengan route yang sesuai
        form.submit();
    }
    function setujuiAlamat(el) {
        const form = document.getElementById('form-alamat');
        let input = form.querySelector('input[name="status"]');
        if (!input) {
            input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'status';
            form.appendChild(input);
        }
        input.value = el.getAttribute('data-status');
        form.action = "{{ route('update_form_alamat') }}"; // Ganti dengan route yang sesuai
        form.submit();
    }
    function tolakAlamat(el) {
        const form = document.getElementById('form-alamat');
        let input = form.querySelector('input[name="status"]');
        if (!input) {
            input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'status';
            form.appendChild(input);
        }
        input.value = el.getAttribute('data-status');
        form.action = "{{ route('update_form_alamat') }}"; // Ganti dengan route yang sesuai
        form.submit();
    }
</script>
</x-layout>