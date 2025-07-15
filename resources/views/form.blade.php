<x-layout title="Formulir Pendaftaran">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.22.1/dist/sweetalert2.min.css">
    <!-- CSS Bootstrap -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            max-width: 1000px;
            margin: 20px auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
        }
        h2 {
            text-align: center;
            margin-bottom: 25px;
        }
        form div {
            margin-bottom: 15px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        input, select, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        textarea {
            resize: vertical;
        }
        .section-title {
            background: #e6e6e6;
            padding: 10px;
            font-size: 18px;
            margin-top: 20px;
            margin-bottom: 10px;
        }
        .submit-btn {
            background: #007BFF;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        .submit-btn:hover {
            background: #0056b3;
        }

        .cek{
            display: flex;
        }
        @media (max-width: 768px) {
            .cek {
                width: 100% !important;
            }
        }
        select[readonly] {
            pointer-events: none;
            background: #eee;
        }
    </style>

    <div class="container">
        <h2>Formulir Pendaftaran</h2>
        <div class="d-flex justify-content-center mb-3">
            <div class="btn-group" role="group" aria-label="Basic example">
                
                @php
                    $status_siswa = $statusSiswa && $statusSiswa->status_dok_siswa !== 'ditolak' ? 'disabled' : '' ;
                    $title_siswa = $statusSiswa ? 'Formulir siswa telah diisi' : '' ;
                    $display_ortu = $statusSiswa ? '' : 'd-none' ;

                    $status_ortu = $statusOrtu && $statusOrtu->status_dok_ortu !== 'ditolak' ? 'disabled' : '' ;
                    $title_ortu = $statusOrtu ? 'Formulir Orang Tua telah diisi' : '' ;
                    $display_alamat = $statusOrtu ? '' : 'd-none' ;

                    $status_alamat = $statusAlamat && $statusAlamat->status_dok_alamat !== 'ditolak' ? 'disabled' : '' ;
                    $title_alamat = $statusAlamat ? 'Formulir Alamat telah diisi' : '' ;
                @endphp
                <button {{ $status_siswa }} title="{{ $title_siswa }}" type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#collapseSiswa" aria-expanded="false" aria-controls="collapseSiswa">Data Siswa</button>
                <button {{ $status_ortu }} title="{{ $title_ortu }}" type="button" class="btn btn-primary {{ $display_ortu }}" data-bs-toggle="collapse" data-bs-target="#collapseOrangTua" aria-expanded="false" aria-controls="collapseAyah">Data Orang Tua</button>
                <button {{ $status_alamat }} title="{{ $title_alamat }}" type="button" class="btn btn-primary {{ $display_alamat }}" data-bs-toggle="collapse" data-bs-target="#collapseAlamat" aria-expanded="false" aria-controls="collapseAyah">Data Alamat</button>
                
            </div>
        </div>

        <div class="accordion" id="accordionExample">
            <div class="collapse {{ $errors->siswa->any() ? 'show' : '' }}" id="collapseSiswa" data-bs-parent="#accordionExample">
                <form method="POST" action="{{ route('upload') }}" enctype="multipart/form-data">
                    @csrf

                    @if ($errors->siswa->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->siswa->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <input type="hidden" name="status_dok_siswa" value="menunggu">

                    <div class="section-title">Data Pribadi</div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama_lengkap" value="{{ auth()->user()->name }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" value="{{ auth()->user()->email }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>NISN</label>
                            <input type="text" class="form-control" name="nisn" maxlength="10" pattern="\d*" inputmode="numeric" value="{{ old('nisn') }}">
                            @error('nisn','siswa') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label>Kewarganegaraan</label>
                            <select class="form-select" name="kewarganegaraan">
                                <option value="">-- Pilih --</option>
                                <option value="WNI" @selected(old('kewarganegaraan') == 'WNI')>WNI</option>
                                <option value="WNA" @selected(old('kewarganegaraan') == 'WNA')>WNA</option>
                            </select>
                            @error('kewarganegaraan','siswa') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>NIK</label>
                            <input type="text" class="form-control" name="nik" maxlength="16" pattern="\d*" inputmode="numeric" value="{{ old('nik') }}">
                            @error('nik','siswa') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label>Tempat Lahir</label>
                            <input type="text" class="form-control" name="tempat_lahir" value="{{ old('tempat_lahir') }}">
                            @error('tempat_lahir','siswa') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                            @error('tanggal_lahir','siswa') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label>Jenis Kelamin</label>
                            <select class="form-select" name="jenis_kelamin">
                                <option value="laki-laki" @selected(old('jenis_kelamin') == 'laki-laki')>Laki-laki</option>
                                <option value="perempuan" @selected(old('jenis_kelamin') == 'perempuan')>Perempuan</option>
                            </select>
                            @error('jenis_kelamin','siswa') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Agama</label>
                            <select class="form-select" name="agama">
                                <option value="">-- Pilih Agama --</option>
                                <option value="Islam" @selected(old('agama') == 'Islam')>Islam</option>
                                <option value="Kristen" @selected(old('agama') == 'Kristen')>Kristen</option>
                                <option value="Katolik" @selected(old('agama') == 'Katolik')>Katolik</option>
                                <option value="Hindu" @selected(old('agama') == 'Hindu')>Hindu</option>
                                <option value="Buddha" @selected(old('agama') == 'Buddha')>Buddha</option>
                                <option value="Konghucu" @selected(old('agama') == 'Konghucu')>Konghucu</option>
                            </select>
                            @error('agama','siswa') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label>No Handphone</label>
                            <input type="text" class="form-control" maxlength="13" pattern="\d*" inputmode="numeric" name="no_hp" value="{{ old('no_hp') }}">
                            @error('no_hp','siswa') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Jumlah Saudara</label>
                            <input type="number" class="form-control" name="jumlah_sodara" value="{{ old('jumlah_sodara') }}">
                            @error('jumlah_sodara','siswa') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label>Anak Ke</label>
                            <input type="number" class="form-control" name="anakke" value="{{ old('anakke') }}">
                            @error('anakke','siswa') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Cita-Cita</label>
                            <select class="form-select" name="cita_cita">
                                <option value="">-- Pilih --</option>
                                <option value="PNS" @selected(old('cita_cita') == 'PNS')>PNS</option>
                                <option value="TNI/Polri" @selected(old('cita_cita') == 'TNI/Polri')>TNI/Polri</option>
                                <option value="Guru/Dosen" @selected(old('cita_cita') == 'Guru/Dosen')>Guru/Dosen</option>
                                <option value="Dokter" @selected(old('cita_cita') == 'Dokter')>Dokter</option>
                                <option value="Politikus" @selected(old('cita_cita') == 'Politikus')>Politikus</option>
                                <option value="Wiraswasta" @selected(old('cita_cita') == 'Wiraswasta')>Wiraswasta</option>
                                <option value="Seniman/Artis" @selected(old('cita_cita') == 'Seniman/Artis')>Seniman/Artis</option>
                                <option value="Ilmuwan" @selected(old('cita_cita') == 'Ilmuwan')>Ilmuwan</option>
                                <option value="Agamawan" @selected(old('cita_cita') == 'Agamawan')>Agamawan</option>
                                <option value="Lainnya" @selected(old('cita_cita') == 'Lainnya')>Lainnya</option>
                            </select>
                            @error('cita_cita', 'siswa') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label>Hobi</label>
                            <select name="hobi" class="form-select">
                                <option value="">-- Pilih --</option>
                                <option value="Olahraga" @selected(old('hobi') == 'Olahraga')>Olahraga</option>
                                <option value="Kesenian" @selected(old('hobi') == 'Kesenian')>Kesenian</option>
                                <option value="Membaca" @selected(old('hobi') == 'Membaca')>Membaca</option>
                                <option value="Menulis" @selected(old('hobi') == 'Menulis')>Menulis</option>
                                <option value="Jalan - jalan" @selected(old('hobi') == 'Jalan - jalan')>Jalan - jalan</option>
                                <option value="Lainnya" @selected(old('hobi') == 'Lainnya')>Lainnya</option>
                            </select>
                            @error('hobi', 'siswa') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Yang Membiayai Sekolah</label>
                            <select name="pembiaya_sekolah" class="form-select">
                                <option value="">-- Pilih --</option>
                                <option value="Orang Tua" @selected(old('pembiaya_sekolah') == 'Orang Tua')>Orang Tua</option>
                                <option value="Wali/Orang Tua Asuh" @selected(old('pembiaya_sekolah') == 'Wali/Orang Tua Asuh')>Wali/Orang Tua Asuh</option>
                                <option value="Tanggungan Sendiri" @selected(old('pembiaya_sekolah') == 'Tanggungan Sendiri')>Tanggungan Sendiri</option>
                                <option value="Lainnya" @selected(old('pembiaya_sekolah') == 'Lainnya')>Lainnya</option>
                            </select>
                            @error('pembiaya_sekolah', 'siswa') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="d-block">Pendidikan Pra Sekolah</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="pra_sekolah" value="Pernah TKA/RA" @checked(old('pra_sekolah') == 'Pernah TKA/RA')>
                                <label class="form-check-label text-nowrap">Pernah TKA/RA</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="pra_sekolah" value="Pernah PAUD" @checked(old('pra_sekolah') == 'Pernah PAUD')>
                                <label class="form-check-label text-nowrap">Pernah PAUD</label>
                            </div>
                            @error('pra_sekolah', 'siswa') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label>Nomor KIP (jika ada)</label>
                            <input type="text" class="form-control" name="kip" value="{{ old('kip') }}">
                            @error('kip','siswa') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4">
                            <label>Nomor KK</label>
                            <input type="text" maxlength="16" class="form-control" name="kk" value="{{ old('kk') }}">
                            @error('kk','siswa') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4">
                            <label>Nama Kepala Keluarga</label>
                            <input type="text" class="form-control" name="kepala_kk" value="{{ old('kepala_kk') }}">
                            @error('kepala_kk','siswa') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Kirim Formulir</button>
                    </div>
                </form>

            </div>
            
            {{-- Form Orang Tua --}}
            <div class="collapse {{ $errors->ortu->any() ? 'show' : '' }}" id="collapseOrangTua" data-bs-parent="#accordionExample">
                <form method="POST" action="{{ route('upload_ortu') }}">
                    @csrf
                    <input type="hidden" name="siswa_id" value="{{ auth()->user()->id }}">
                    <input type="hidden" name="status_dok_ortu" value="menunggu">
                    
                    @if ($errors->ortu->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->ortu->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mb-4">
                        <h5 class="mb-3">Data Ayah Kandung</h5>
                        <div class="row">
                            <div class="col-md-12">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Nama Lengkap</label>
                                <input type="text" class="form-control mb-2" id="nama_ayah" name="nama_ayah" value="{{ old('nama_ayah') }}">
                                @error('nama_ayah','ortu') <small class="text-danger">{{ $message }}</small> @enderror
                                <div class="cek" style="text-align: center; width: 50%;">
                                    <input type="checkbox" id="defaultCheck1" style="margin: 0 8px 0 0; width: 16px; height: 16px;" name="sama_dengan_kepala_kk" {{ old('sama_dengan_kepala_kk') ? 'checked' : '' }}>
                                    <p style="font-size: 0.85rem; font-style: italic;  margin: 0; margin-right: 10px;">
                                        Sama dengan Kepala Keluarga
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Status</label>
                                <select class="form-control" id="status_ayah" name="status_ayah">
                                    <option value="hidup" @selected(old('status_ayah') == 'hidup')>Hidup</option>
                                    <option value="meninggal" @selected(old('status_ayah') == 'meninggal')>Meninggal</option>
                                </select>
                                @error('status_ayah','ortu') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Kewarganegaraan</label>
                                <select class="form-select" id="kewarganegaraan_ayah" name="kewarganegaraan_ayah">
                                    {{-- <option value="">-- Pilih --</option> --}}
                                    <option value="WNI" @selected(old('kewarganegaraan_ayah') == 'WNI')>WNI</option>
                                    <option value="WNA" @selected(old('kewarganegaraan_ayah') == 'WNA')>WNA</option>
                                </select>
                                @error('kewarganegaraan_ayah','ortu') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>NIK</label>
                                <input type="text" class="form-control" maxlength="16" pattern="\d*" inputmode="numeric" id="nik_ayah" name="nik_ayah" value="{{ old('nik_ayah') }}">
                                @error('nik_ayah','ortu') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Tempat Lahir</label>
                                <input type="text" class="form-control" id="tempat_lahir_ayah" name="tempat_lahir_ayah" value="{{ old('tempat_lahir_ayah') }}">
                                @error('tempat_lahir_ayah','ortu') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggal_lahir_ayah" name="tanggal_lahir_ayah" value="{{ old('tanggal_lahir_ayah') }}" required>
                                @error('tanggal_lahir_ayah','ortu') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Pendidikan Terakhir</label>
                                <select class="form-control" id="pendidikan_ayah" name="pendidikan_ayah">
                                    <option value="SD" @selected(old('pendidikan_ayah') == 'SD')>SD/Sederajat</option>
                                    <option value="SMP" @selected(old('pendidikan_ayah') == 'SMP')>SMP/Sederajat</option>
                                    <option value="SMA" @selected(old('pendidikan_ayah') == 'SMA')>SMA/Sederajat</option>
                                    <option value="D1" @selected(old('pendidikan_ayah') == 'D1')>D1</option>
                                    <option value="D2" @selected(old('pendidikan_ayah') == 'D2')>D2</option>
                                    <option value="D3" @selected(old('pendidikan_ayah') == 'D3')>D3</option>
                                    <option value="S1" @selected(old('pendidikan_ayah') == 'S1')>D4/S1</option>
                                    <option value="S2" @selected(old('pendidikan_ayah') == 'S2')>S2</option>
                                    <option value="S3" @selected(old('pendidikan_ayah') == 'S3')>S3</option>
                                    <option value="Tidak bersekolah" @selected(old('pendidikan_ayah') == 'Tidak bersekolah')>Tidak bersekolah</option>
                                    <option value="Lainnya" @selected(old('pendidikan_ayah') == 'Lainnya')>Lainnya</option>
                                </select>
                                @error('pendidikan_ayah','ortu') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Pekerjaan Utama</label>
                                <select class="form-control" id="pekerjaan_ayah" name="pekerjaan_ayah">
                                    <option value="Tidak Bekerja" @selected(old('pekerjaan_ayah') == 'Tidak Bekerja')>Tidak Bekerja</option>
                                    <option value="Pensiunan" @selected(old('pekerjaan_ayah') == 'Pensiunan')>Pensiunan</option>
                                    <option value="PNS" @selected(old('pekerjaan_ayah') == 'PNS')>PNS</option>
                                    <option value="TNI/Polisi" @selected(old('pekerjaan_ayah') == 'TNI/Polisi')>TNI/Polisi</option>
                                    <option value="Guru/Dosen" @selected(old('pekerjaan_ayah') == 'Guru/Dosen')>Guru/Dosen</option>
                                    <option value="Pegawai Swasta" @selected(old('pekerjaan_ayah') == 'Pegawai Swasta')>Pegawai Swasta</option>
                                    <option value="Wiraswasta" @selected(old('pekerjaan_ayah') == 'Wiraswasta')>Wiraswasta</option>
                                    <option value="Pengacara/Jaksa/Hakim/Notaris" @selected(old('pekerjaan_ayah') == 'Pengacara/Jaksa/Hakim/Notaris')>Pengacara/Jaksa/Hakim/Notaris</option>
                                    <option value="Seniman/Pelukis/Artis/Sejenis" @selected(old('pekerjaan_ayah') == 'Seniman/Pelukis/Artis/Sejenis')>Seniman/Pelukis/Artis/Sejenis</option>
                                    <option value="Dokter/Bidan/Perawat" @selected(old('pekerjaan_ayah') == 'Dokter/Bidan/Perawat')>Dokter/Bidan/Perawat</option>
                                    <option value="Pilot/Pramugara" @selected(old('pekerjaan_ayah') == 'Pilot/Pramugara')>Pilot/Pramugara</option>
                                    <option value="Pedagang" @selected(old('pekerjaan_ayah') == 'Pedagang')>Pedagang</option>
                                    <option value="Petani/Peternak" @selected(old('pekerjaan_ayah') == 'Petani/Peternak')>Petani/Peternak</option>
                                    <option value="Nelayan" @selected(old('pekerjaan_ayah') == 'Nelayan')>Nelayan</option>
                                    <option value="Buruh (Tani/Pabrik/Bangunan)" @selected(old('pekerjaan_ayah') == 'Buruh (Tani/Pabrik/Bangunan)')>Buruh (Tani/Pabrik/Bangunan)</option>
                                    <option value="Sopir/Masinis/Kondektur" @selected(old('pekerjaan_ayah') == 'Sopir/Masinis/Kondektur')>Sopir/Masinis/Kondektur</option>
                                    <option value="Politikus" @selected(old('pekerjaan_ayah') == 'Politikus')>Politikus</option>
                                    <option value="Lainnya" @selected(old('pekerjaan_ayah') == 'Lainnya')>Lainnya</option>
                                </select>
                                @error('pekerjaan_ayah','ortu') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Penghasilan Rata-rata per Bulan (RP)</label>
                                <select class="form-control" id="penghasilan_ayah" name="penghasilan_ayah">
                                    <option value="Kurang dari 500.000" @selected(old('penghasilan_ayah') == 'Kurang dari 500.000')>Kurang dari 500.000</option>
                                    <option value="500.000 - 1.000.000" @selected(old('penghasilan_ayah') == '500.000 - 1.000.000')>500.000 - 1.000.000</option>
                                    <option value="1.000.000 - 2.000.000" @selected(old('penghasilan_ayah') == '1.000.000 - 2.000.000')>1.000.000 - 2.000.000</option>
                                    <option value="2.000.000 - 3.000.000" @selected(old('penghasilan_ayah') == '2.000.000 - 3.000.000')>2.000.000 - 3.000.000</option>
                                    <option value="3.000.000 - 5.000.000" @selected(old('penghasilan_ayah') == '3.000.000 - 5.000.000')>3.000.000 - 5.000.000</option>
                                    <option value="Lebih dari 5.000.000" @selected(old('penghasilan_ayah') == 'Lebih dari 5.000.000')>Lebih dari 5.000.000</option>
                                    <option value="Tidak ada" @selected(old('penghasilan_ayah') == 'Tidak ada')>Tidak ada</option>
                                </select>
                                @error('penghasilan_ayah','ortu') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>No Handphone</label>
                                <input type="text" class="form-control" maxlength="13" pattern="\d*" inputmode="numeric" id="no_hp_ayah" name="no_hp_ayah" value="{{ old('no_hp_ayah') }}">
                                @error('no_hp_ayah','ortu') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                    </div>

                    <hr>

                    {{-- Data Ibu --}}
                    <div class="mb-4">
                        <h5 class="mb-3">Data Ibu Kandung</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Nama</label>
                                <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" value="{{ old('nama_ibu') }}">
                                @error('nama_ibu','ortu') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Status</label>
                                <select class="form-control" id="status_ibu" name="status_ibu">
                                    <option value="hidup" @selected(old('status_ibu') == 'hidup')>Hidup</option>
                                    <option value="meninggal" @selected(old('status_ibu') == 'meninggal')>Meninggal</option>
                                </select>
                                @error('status_ibu','ortu') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Kewarganegaraan</label>
                                <select class="form-select" id="kewarganegaraan_ibu" name="kewarganegaraan_ibu">
                                    <option value="">-- Pilih --</option>
                                    <option value="WNI" @selected(old('kewarganegaraan_ibu') == 'WNI')>WNI</option>
                                    <option value="WNA" @selected(old('kewarganegaraan_ibu') == 'WNA')>WNA</option>
                                </select>
                                @error('kewarganegaraan_ibu','ortu') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>NIK</label>
                                <input type="text" class="form-control" id="nik_ibu" name="nik_ibu" maxlength="16" pattern="\d*" inputmode="numeric" value="{{ old('nik_ibu') }}">
                                @error('nik_ibu','ortu') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Tempat Lahir</label>
                                <input type="text" class="form-control" id="tempat_lahir_ibu" name="tempat_lahir_ibu" value="{{ old('tempat_lahir_ibu') }}">
                                @error('tempat_lahir_ibu','ortu') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggal_lahir_ibu" name="tanggal_lahir_ibu" value="{{ old('tanggal_lahir_ibu') }}">
                                @error('tanggal_lahir_ibu','ortu') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Pendidikan Terakhir</label>
                                <select class="form-control" id="pendidikan_ibu" name="pendidikan_ibu">
                                    <option value="SD" @selected(old('pendidikan_ibu') == 'SD')>SD/Sederajat</option>
                                    <option value="SMP" @selected(old('pendidikan_ibu') == 'SMP')>SMP/Sederajat</option>
                                    <option value="SMA" @selected(old('pendidikan_ibu') == 'SMA')>SMA/Sederajat</option>
                                    <option value="D1" @selected(old('pendidikan_ibu') == 'D1')>D1</option>
                                    <option value="D2" @selected(old('pendidikan_ibu') == 'D2')>D2</option>
                                    <option value="D3" @selected(old('pendidikan_ibu') == 'D3')>D3</option>
                                    <option value="S1" @selected(old('pendidikan_ibu') == 'S1')>D4/S1</option>
                                    <option value="S2" @selected(old('pendidikan_ibu') == 'S2')>S2</option>
                                    <option value="S3" @selected(old('pendidikan_ibu') == 'S3')>S3</option>
                                    <option value="Tidak bersekolah" @selected(old('pendidikan_ibu') == 'Tidak bersekolah')>Tidak bersekolah</option>
                                    <option value="Lainnya" @selected(old('pendidikan_ibu') == 'Lainnya')>Lainnya</option>
                                </select>
                                @error('pendidikan_ibu','ortu') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Pekerjaan Utama</label>
                                <select class="form-control" id="pekerjaan_ibu" name="pekerjaan_ibu">
                                    <option value="Tidak Bekerja" @selected(old('pekerjaan_ibu') == 'Tidak Bekerja')>Tidak Bekerja</option>
                                    <option value="Pensiunan" @selected(old('pekerjaan_ibu') == 'Pensiunan')>Pensiunan</option>
                                    <option value="PNS" @selected(old('pekerjaan_ibu') == 'PNS')>PNS</option>
                                    <option value="TNI/Polisi" @selected(old('pekerjaan_ibu') == 'TNI/Polisi')>TNI/Polisi</option>
                                    <option value="Guru/Dosen" @selected(old('pekerjaan_ibu') == 'Guru/Dosen')>Guru/Dosen</option>
                                    <option value="Pegawai Swasta" @selected(old('pekerjaan_ibu') == 'Pegawai Swasta')>Pegawai Swasta</option>
                                    <option value="Wiraswasta" @selected(old('pekerjaan_ibu') == 'Wiraswasta')>Wiraswasta</option>
                                    <option value="Pengacara/Jaksa/Hakim/Notaris" @selected(old('pekerjaan_ibu') == 'Pengacara/Jaksa/Hakim/Notaris')>Pengacara/Jaksa/Hakim/Notaris</option>
                                    <option value="Seniman/Pelukis/Artis/Sejenis" @selected(old('pekerjaan_ibu') == 'Seniman/Pelukis/Artis/Sejenis')>Seniman/Pelukis/Artis/Sejenis</option>
                                    <option value="Dokter/Bidan/Perawat" @selected(old('pekerjaan_ibu') == 'Dokter/Bidan/Perawat')>Dokter/Bidan/Perawat</option>
                                    <option value="Pilot/Pramugara" @selected(old('pekerjaan_ibu') == 'Pilot/Pramugara')>Pilot/Pramugara</option>
                                    <option value="Pedagang" @selected(old('pekerjaan_ibu') == 'Pedagang')>Pedagang</option>
                                    <option value="Petani/Peternak" @selected(old('pekerjaan_ibu') == 'Petani/Peternak')>Petani/Peternak</option>
                                    <option value="Nelayan" @selected(old('pekerjaan_ibu') == 'Nelayan')>Nelayan</option>
                                    <option value="Buruh (Tani/Pabrik/Bangunan)" @selected(old('pekerjaan_ibu') == 'Buruh (Tani/Pabrik/Bangunan)')>Buruh (Tani/Pabrik/Bangunan)</option>
                                    <option value="Sopir/Masinis/Kondektur" @selected(old('pekerjaan_ibu') == 'Sopir/Masinis/Kondektur')>Sopir/Masinis/Kondektur</option>
                                    <option value="Politikus" @selected(old('pekerjaan_ibu') == 'Politikus')>Politikus</option>
                                    <option value="Lainnya" @selected(old('pekerjaan_ibu') == 'Lainnya')>Lainnya</option>
                                </select>
                                @error('pekerjaan_ibu','ortu') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Penghasilan Rata-rata per Bulan (RP)</label>
                                <select class="form-control" id="penghasilan_ibu" name="penghasilan_ibu">
                                    <option value="Kurang dari 500.000" @selected(old('penghasilan_ibu') == 'Kurang dari 500.000')>Kurang dari 500.000</option>
                                    <option value="500.000 - 1.000.000" @selected(old('penghasilan_ibu') == '500.000 - 1.000.000')>500.000 - 1.000.000</option>
                                    <option value="1.000.000 - 2.000.000" @selected(old('penghasilan_ibu') == '1.000.000 - 2.000.000')>1.000.000 - 2.000.000</option>
                                    <option value="2.000.000 - 3.000.000" @selected(old('penghasilan_ibu') == '2.000.000 - 3.000.000')>2.000.000 - 3.000.000</option>
                                    <option value="3.000.000 - 5.000.000" @selected(old('penghasilan_ibu') == '3.000.000 - 5.000.000')>3.000.000 - 5.000.000</option>
                                    <option value="Lebih dari 5.000.000" @selected(old('penghasilan_ibu') == 'Lebih dari 5.000.000')>Lebih dari 5.000.000</option>
                                    <option value="Tidak ada" @selected(old('penghasilan_ibu') == 'Tidak ada')>Tidak ada</option>
                                </select>
                                @error('penghasilan_ibu','ortu') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>No Handphone</label>
                                <input type="text" class="form-control" id="no_hp_ibu" name="no_hp_ibu" maxlength="13" pattern="\d*" inputmode="numeric" value="{{ old('no_hp_ibu') }}">
                                @error('no_hp_ibu','ortu') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                    </div>


                    <hr>

                    {{-- Data Wali --}}
                    <div class="mb-4">
                        <h5 class="mb-3">Data Wali</h5>
                        <p class="mb-3"></p>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="">Wali</label>
                                <select @if(old('pilih_wali')) data-old="{{ old('pilih_wali') }}" @endif class="form-select" name="pilih_wali" id="pilih_wali">
                                    <option value="">-- Pilih Wali--</option>
                                    <option value="ayah">Sama dengan ayah kandung</option>
                                    <option value="ibu">Sama dengan ibu kandung</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama_wali" @if(old('nama_wali')) data-old="{{ old('nama_wali') }}" @endif name="nama_wali" value="{{ old('nama_wali') }}">
                                @error('nama_wali','ortu') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>


                            <div class="col-md-6 mb-3">
                                <label>Status</label>
                                <select class="form-control" id="status_wali" @if(old('status_wali')) data-old="{{ old('nama_wali') }}" @endif name="status_wali">
                                    <option value="hidup" @selected(old('status_wali') == 'hidup')>Hidup</option>
                                    <option value="meninggal" @selected(old('status_wali') == 'meninggal')>Meninggal</option>
                                </select>
                                @error('status_wali','ortu') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>


                            <div class="col-md-6 mb-3">
                                <label for="">Kewarganegaraan</label>
                                <select class="form-select" id="kewarganegaraan_wali" @if(old('kewarganegaraan_wali')) data-old="{{ old('nama_wali') }}" @endif name="kewarganegaraan_wali">
                                    <option value="">-- Pilih --</option>
                                    <option value="WNI" @selected(old('kewarganegaraan_wali') == 'WNI')>WNI</option>
                                    <option value="WNA" @selected(old('kewarganegaraan_wali') == 'WNA')>WNA</option>
                                </select>
                                @error('kewarganegaraan_wali','ortu') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>NIK</label>
                                <input type="text" class="form-control" id="nik_wali" @if(old('nik_wali')) data-old="{{ old('nama_wali') }}" @endif name="nik_wali" maxlength="16" pattern="\d*" inputmode="numeric" value="{{ old('nik_wali') }}">
                                @error('nik_wali','ortu') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Tempat Lahir</label>
                                <input type="text" class="form-control" id="tempat_lahir_wali" @if(old('tempat_lahir_wali')) data-old="{{ old('nama_wali') }}" @endif name="tempat_lahir_wali" value="{{ old('tempat_lahir_wali') }}">
                                @error('tempat_lahir_wali','ortu') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggal_lahir_wali" @if(old('tanggal_lahir_wali')) data-old="{{ old('nama_wali') }}" @endif name="tanggal_lahir_wali" value="{{ old('tanggal_lahir_wali') }}">
                                @error('tanggal_lahir_wali','ortu') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            
                            <div class="col-md-6 mb-3">
                                <label>Pendidikan Terakhir</label>
                                <select class="form-control" id="pendidikan_wali" @if(old('pendidikan_wali')) data-old="{{ old('nama_wali') }}" @endif name="pendidikan_wali">
                                    <option value="SD" @selected(old('pendidikan_wali') == 'SD')>SD/Sederajat</option>
                                    <option value="SMP" @selected(old('pendidikan_wali') == 'SMP')>SMP/Sederajat</option>
                                    <option value="SMA" @selected(old('pendidikan_wali') == 'SMA')>SMA/Sederajat</option>
                                    <option value="D1" @selected(old('pendidikan_wali') == 'D1')>D1</option>
                                    <option value="D2" @selected(old('pendidikan_wali') == 'D2')>D2</option>
                                    <option value="D3" @selected(old('pendidikan_wali') == 'D3')>D3</option>
                                    <option value="S1" @selected(old('pendidikan_wali') == 'S1')>D4/S1</option>
                                    <option value="S2" @selected(old('pendidikan_wali') == 'S2')>S2</option>
                                    <option value="S3" @selected(old('pendidikan_wali') == 'S3')>S3</option>
                                    <option value="Tidak bersekolah" @selected(old('pendidikan_wali') == 'Tidak bersekolah')>Tidak bersekolah</option>
                                    <option value="Lainnya" @selected(old('pendidikan_wali') == 'Lainnya')>Lainnya</option>
                                </select>
                                @error('pendidikan_wali','ortu') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>


                            <div class="col-md-6 mb-3">
                                <label>Pekerjaan Utama</label>
                                <select class="form-control" id="pekerjaan_wali" @if(old('pekerjaan_wali')) data-old="{{ old('nama_wali') }}" @endif name="pekerjaan_wali">
                                    <option value="Tidak Bekerja" @selected(old('pekerjaan_ibu') == 'Tidak Bekerja')>Tidak Bekerja</option>
                                    <option value="Pensiunan" @selected(old('pekerjaan_ibu') == 'Pensiunan')>Pensiunan</option>
                                    <option value="PNS" @selected(old('pekerjaan_ibu') == 'PNS')>PNS</option>
                                    <option value="TNI/Polisi" @selected(old('pekerjaan_wali') == 'TNI/Polisi')>TNI/Polisi</option>
                                    <option value="Guru/Dosen" @selected(old('pekerjaan_wali') == 'Guru/Dosen')>Guru/Dosen</option>
                                    <option value="Pegawai Swasta" @selected(old('pekerjaan_wali') == 'Pegawai Swasta')>Pegawai Swasta</option>
                                    <option value="Wiraswasta" @selected(old('pekerjaan_wali') == 'Wiraswasta')>Wiraswasta</option>
                                    <option value="Pengacara/Jaksa/Hakim/Notaris" @selected(old('pekerjaan_wali') == 'Pengacara/Jaksa/Hakim/Notaris')>Pengacara/Jaksa/Hakim/Notaris</option>
                                    <option value="Seniman/Pelukis/Artis/Sejenis" @selected(old('pekerjaan_wali') == 'Seniman/Pelukis/Artis/Sejenis')>Seniman/Pelukis/Artis/Sejenis</option>
                                    <option value="Dokter/Bidan/Perawat" @selected(old('pekerjaan_wali') == 'Dokter/Bidan/Perawat')>Dokter/Bidan/Perawat</option>
                                    <option value="Pilot/Pramugara" @selected(old('pekerjaan_wali') == 'Pilot/Pramugara')>Pilot/Pramugara</option>
                                    <option value="Pedagang" @selected(old('pekerjaan_wali') == 'Pedagang')>Pedagang</option>
                                    <option value="Petani/Peternak" @selected(old('pekerjaan_wali') == 'Petani/Peternak')>Petani/Peternak</option>
                                    <option value="Nelayan" @selected(old('pekerjaan_wali') == 'Nelayan')>Nelayan</option>
                                    <option value="Buruh (Tani/Pabrik/Bangunan)" @selected(old('pekerjaan_wali') == 'Buruh (Tani/Pabrik/Bangunan)')>Buruh (Tani/Pabrik/Bangunan)</option>
                                    <option value="Sopir/Masinis/Kondektur" @selected(old('pekerjaan_wali') == 'Sopir/Masinis/Kondektur')>Sopir/Masinis/Kondektur</option>
                                    <option value="Politikus" @selected(old('pekerjaan_wali') == 'Politikus')>Politikus</option>
                                    <option value="Lainnya" @selected(old('pekerjaan_wali') == 'Lainnya')>Lainnya</option>
                                </select>
                                @error('pekerjaan_wali','ortu') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>


                            <div class="col-md-6 mb-3">
                                <label>Penghasilan Rata-rata per Bulan (RP)</label>
                                <select class="form-control" id="penghasilan_wali" @if(old('penghasilan_wali')) data-old="{{ old('penghasilan_wali') }}" @endif name="penghasilan_wali">
                                    <option value="Kurang dari 500.000" @selected(old('penghasilan_wali') == 'Kurang dari 500.000')>Kurang dari 500.000</option>
                                    <option value="500.000 - 1.000.000" @selected(old('penghasilan_wali') == '500.000 - 1.000.000')>500.000 - 1.000.000</option>
                                    <option value="1.000.000 - 2.000.000" @selected(old('penghasilan_wali') == '1.000.000 - 2.000.000')>1.000.000 - 2.000.000</option>
                                    <option value="2.000.000 - 3.000.000" @selected(old('penghasilan_wali') == '2.000.000 - 3.000.000')>2.000.000 - 3.000.000</option>
                                    <option value="3.000.000 - 5.000.000" @selected(old('penghasilan_wali') == '3.000.000 - 5.000.000')>3.000.000 - 5.000.000</option>
                                    <option value="Lebih dari 5.000.000" @selected(old('penghasilan_wali') == 'Lebih dari 5.000.000')>Lebih dari 5.000.000</option>
                                    <option value="Tidak ada" @selected(old('penghasilan_wali') == 'Tidak ada')>Tidak ada</option>
                                </select>
                                @error('penghasilan_wali','ortu') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>No Handphone</label>
                                <input type="text" class="form-control" id="no_hp_wali" @if(old('no_hp_wali')) data-old="{{ old('no_hp_wali') }}" @endif name="no_hp_wali" maxlength="13" pattern="\d*" inputmode="numeric" value="{{ old('no_hp_wali') }}">
                                @error('no_hp_wali','ortu') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                    </div>


                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Kirim Formulir</button>
                    </div>
                </form>
            </div>
            
            {{-- Form Alamat --}}
            <div class="collapse {{ $errors->alamat->any() ? 'show' : '' }}" id="collapseAlamat" data-bs-parent="#accordionExample">
            {{-- <div class="collapse show" id="collapseAlamat" data-bs-parent="#accordionExample"> --}}
                <form method="POST" action="{{ route('upload_alamat') }}" enctype="multipart/form-data">
                    @csrf

                    @if ($errors->alamat->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->alamat->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Alamat Ayah -->
                    <div class="section-title">Ayah Kandung</div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label>Status Kepemilikan Rumah</label>
                            <select class="form-control" name="pemilikan_rumah_ayah" {{isset($statusOrtu) && $statusOrtu->status_ayah == 'meninggal' ? 'disabled' : '' }}>
                                <option value=""></option>
                                <option value="Milik Sendiri" {{ old('pemilikan_rumah_ayah') == 'Milik Sendiri' ? 'selected' : '' }}>Milik Sendiri</option>
                                <option value="Rumah Orang Tua" {{ old('pemilikan_rumah_ayah') == 'Rumah Orang Tua' ? 'selected' : '' }}>Rumah Orang Tua</option>
                                <option value="Rumah Saudara/kerabat" {{ old('pemilikan_rumah_ayah') == 'Rumah Saudara/kerabat' ? 'selected' : '' }}>Rumah Saudara/kerabat</option>
                                <option value="Rumah Dinas" {{ old('pemilikan_rumah_ayah') == 'Rumah Dinas' ? 'selected' : '' }}>Rumah Dinas</option>
                                <option value="Sewa/kontrak" {{ old('pemilikan_rumah_ayah') == 'Sewa/kontrak' ? 'selected' : '' }}>Sewa/kontrak</option>
                                <option value="Lainnya" {{ old('pemilikan_rumah_ayah') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            
                            @error('pemilikan_rumah_ayah','alamat')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Provinsi</label>
                            <select class="form-control" name="provinsi_ayah" id="provinsi_ayah" {{isset(
                                $statusOrtu) && $statusOrtu->status_ayah == 'meninggal' ? 'disabled' : '' }}>
                                <option value="">Pilih Provinsi</option>
                            </select>
                            @error('provinsi_ayah','alamat')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label>Kabupaten/Kota</label>
                            <select class="form-control" name="kab_kota_ayah" id="kab_kota_ayah" disabled>
                                <option value="">Pilih Kabupaten/Kota</option>
                            </select>
                            @error('kab_kota_ayah','alamat')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Kecamatan</label>
                            <select class="form-control" name="kecamatan_ayah" id="kecamatan_ayah" disabled>
                                <option value="">Pilih Kecamatan</option>
                            </select>
                            @error('kecamatan_ayah','alamat')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label>Kelurahan/Desa</label>
                            <select class="form-control" name="kel_des_ayah" id="kel_des_ayah" disabled>
                                <option value="">Pilih Kelurahan/Desa</option>
                            </select>
                            @error('kel_des_ayah','alamat')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>RT</label>
                            <input type="text" class="form-control" name="rt_ayah" value="{{ old('rt_ayah') }}" {{isset($statusOrtu) && $statusOrtu->status_ayah == 'meninggal' ? 'disabled' : '' }}>
                            @error('rt_ayah','alamat')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label>RW</label>
                            <input type="text" class="form-control" name="rw_ayah" value="{{ old('rw_ayah') }}" {{isset($statusOrtu) && $statusOrtu->status_ayah == 'meninggal' ? 'disabled' : '' }}>
                            @error('rw_ayah','alamat')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Alamat</label>
                            <textarea class="form-control" name="alamat_ayah" {{isset($statusOrtu) && $statusOrtu->status_ayah == 'meninggal' ? 'disabled' : '' }}>{{ old('alamat_ayah') }}</textarea>
                            @error('alamat_ayah','alamat')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label>Kode Pos</label>
                            <input type="text" class="form-control" name="kode_pos_ayah" value="{{ old('kode_pos_ayah') }}" {{isset($statusOrtu) && $statusOrtu->status_ayah == 'meninggal' ? 'disabled' : '' }}>
                            @error('kode_pos_ayah','alamat')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <!-- Alamat Ibu -->
                    <div class="section-title">Ibu Kandung</div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label>Status Kepemilikan Rumah</label>
                            <select class="form-control" name="pemilikan_rumah_ibu" {{isset($statusOrtu) && $statusOrtu->status_ibu == 'meninggal' ? 'disabled' : '' }}>
                                <option value=""></option>
                                {{-- <option value="Sama Dengan Ayah" {{ old('pemilikan_rumah_ibu') == 'Sama Dengan Ayah' ? 'selected' : '' }}>Milik Sendiri</option> --}}
                                <option value="Sama Dengan Ayah" {{ old('pemilikan_rumah_ibu') == 'Sama Dengan Ayah' ? 'selected' : '' }}>Sama Dengan Ayah</option>
                                <option value="Milik Sendiri" {{ old('pemilikan_rumah_ibu') == 'Milik Sendiri' ? 'selected' : '' }}>Milik Sendiri</option>
                                <option value="Rumah Orang Tua" {{ old('pemilikan_rumah_ibu') == 'Rumah Orang Tua' ? 'selected' : '' }}>Rumah Orang Tua</option>
                                <option value="Rumah Saudara/kerabat" {{ old('pemilikan_rumah_ibu') == 'Rumah Saudara/kerabat' ? 'selected' : '' }}>Rumah Saudara/kerabat</option>
                                <option value="Rumah Dinas" {{ old('pemilikan_rumah_ibu') == 'Rumah Dinas' ? 'selected' : '' }}>Rumah Dinas</option>
                                <option value="Sewa/kontrak" {{ old('pemilikan_rumah_ibu') == 'Sewa/kontrak' ? 'selected' : '' }}>Sewa/kontrak</option>
                                <option value="Lainnya" {{ old('pemilikan_rumah_ibu') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>

                            @error('pemilikan_rumah_ibu','alamat')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Provinsi</label>
                            <select class="form-control" name="provinsi_ibu" id="provinsi_ibu" {{isset($statusOrtu) && $statusOrtu->status_ibu == 'meninggal' ? 'disabled' : '' }}>
                                <option value="">Pilih Provinsi</option>
                            </select>
                            @error('provinsi_ibu','alamat')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label>Kabupaten/Kota</label>
                            <select class="form-control" name="kab_kota_ibu" id="kab_kota_ibu" disabled>
                                <option value="">Pilih Kabupaten/Kota</option>
                            </select>
                            @error('kab_kota_ibu','alamat')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Kecamatan</label>
                            <select class="form-control" name="kecamatan_ibu" id="kecamatan_ibu" disabled>
                                <option value="">Pilih Kecamatan</option>
                            </select>
                            @error('kecamatan_ibu','alamat')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label>Kelurahan/Desa</label>
                            <select class="form-control" name="kel_des_ibu" id="kel_des_ibu" disabled>
                                <option value="">Pilih Kelurahan/Desa</option>
                            </select>
                            @error('kel_des_ibu','alamat')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>


                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>RT</label>
                            <input type="text" class="form-control" name="rt_ibu" value="{{ old('pemilikan_rumah_ibu') == 'Sama Dengan Ayah' ? old('rt_ayah') : old('rt_ibu') }}" {{isset($statusOrtu) && $statusOrtu->status_ibu == 'meninggal' ? 'disabled' : '' }}>
                            @error('rt_ibu','alamat')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label>RW</label>
                            <input type="text" class="form-control" name="rw_ibu" value="{{ old('pemilikan_rumah_ibu') == 'Sama Dengan Ayah' ? old('rw_ayah') : old('rw_ibu') }}" {{isset($statusOrtu) && $statusOrtu->status_ibu == 'meninggal' ? 'disabled' : '' }}>
                            @error('rw_ibu','alamat')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Alamat</label>
                            <textarea class="form-control" name="alamat_ibu" {{isset($statusOrtu) && $statusOrtu->status_ibu == 'meninggal' ? 'disabled' : '' }}>{{ old('pemilikan_rumah_ibu') == 'Sama Dengan Ayah' ? old('alamat_ayah') : old('alamat_ibu') }}</textarea>
                        </div>

                        <div class="col-md-6">
                            <label>Kode Pos</label>
                            <input type="text" class="form-control" name="kode_pos_ibu" value="{{ old('pemilikan_rumah_ibu') == 'Sama Dengan Ayah' ? old('kode_pos_ayah') : old('kode_pos_ibu') }}" {{isset($statusOrtu) && $statusOrtu->status_ibu == 'meninggal' ? 'disabled' : '' }}>
                            @error('kode_pos_ibu','alamat')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>


                    <!-- Alamat Wali -->
                    <div class="section-title">Wali</div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label>Status Kepemilikan Rumah</label>
                            <select class="form-control" name="pemilikan_rumah_wali">
                                <option value=""></option>
                                <option value="Sama dengan Ayah" {{ old('pemilikan_rumah_wali') == 'Sama dengan Ayah' ? 'selected' : '' }}>Sama dengan Ayah</option>
                                <option value="Sama dengan Ibu" {{ old('pemilikan_rumah_wali') == 'Sama dengan Ibu' ? 'selected' : '' }}>Sama dengan Ibu</option>
                                <option value="Milik Sendiri" {{ old('pemilikan_rumah_wali') == 'Milik Sendiri' ? 'selected' : '' }}>Milik Sendiri</option>
                                <option value="Rumah Orang Tua" {{ old('pemilikan_rumah_wali') == 'Rumah Orang Tua' ? 'selected' : '' }}>Rumah Orang Tua</option>
                                <option value="Rumah Saudara/kerabat" {{ old('pemilikan_rumah_wali') == 'Rumah Saudara/kerabat' ? 'selected' : '' }}>Rumah Saudara/kerabat</option>
                                <option value="Rumah Dinas" {{ old('pemilikan_rumah_wali') == 'Rumah Dinas' ? 'selected' : '' }}>Rumah Dinas</option>
                                <option value="Sewa/kontrak" {{ old('pemilikan_rumah_wali') == 'Sewa/kontrak' ? 'selected' : '' }}>Sewa/kontrak</option>
                                <option value="Lainnya" {{ old('pemilikan_rumah_wali') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>

                            @error('pemilikan_rumah_wali','alamat')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Provinsi</label>
                            <select class="form-control" name="provinsi_wali" id="provinsi_wali">
                                <option value="">Pilih Provinsi</option>
                            </select>
                            @error('provinsi_wali','alamat')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label>Kabupaten/Kota</label>
                            <select class="form-control" name="kab_kota_wali" id="kab_kota_wali" disabled>
                                <option value="">Pilih Kabupaten/Kota</option>
                            </select>
                            @error('kab_kota_wali','alamat')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Kecamatan</label>
                            <select class="form-control" name="kecamatan_wali" id="kecamatan_wali" disabled>
                                <option value="">Pilih Kecamatan</option>
                            </select>
                            @error('kecamatan_wali','alamat')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label>Kelurahan/Desa</label>
                            <select class="form-control" name="kel_des_wali" id="kel_des_wali" disabled>
                                <option value="">Pilih Kelurahan/Desa</option>
                            </select>
                            @error('kel_des_wali','alamat')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>


                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>RT</label>
                            <input type="text" class="form-control" name="rt_wali" value="{{ old('pemilikan_rumah_wali') == 'Sama dengan Ayah' ? old('rt_ayah') : (old('pemilikan_rumah_wali') == 'Sama dengan Ibu' ? old('rt_ibu') : old('rt_wali')) }}">
                            @error('rt_wali','alamat')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label>RW</label>
                            <input type="text" class="form-control" name="rw_wali" value="{{ old('pemilikan_rumah_wali') == 'Sama dengan Ayah' ? old('rw_ayah') : (old('pemilikan_rumah_wali') == 'Sama dengan Ibu' ? old('rw_ibu') : old('rw_wali')) }}">
                            @error('rw_wali','alamat')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Alamat</label>
                            <textarea class="form-control" name="alamat_wali">{{ old('pemilikan_rumah_wali') == 'Sama dengan Ayah' ? old('alamat_ayah') : (old('pemilikan_rumah_wali') == 'Sama dengan Ibu' ? old('alamat_ibu') : old('alamat_wali')) }}</textarea>
                            @error('alamat_wali','alamat')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label>Kode Pos</label>
                            <input type="text" class="form-control" name="kode_pos_wali" value="{{ old('pemilikan_rumah_wali') == 'Sama dengan Ayah' ? old('kode_pos_ayah') : (old('pemilikan_rumah_wali') == 'Sama dengan Ibu' ? old('kode_pos_ibu') : old('kode_pos_wali')) }}">
                            @error('kode_pos_wali','alamat')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>


                    <!-- Alamat Siswa -->
                    <div class="section-title mt-4">Alamat Siswa</div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label>Status Tempat Tinggal</label>
                            <select class="form-control" name="status_tempat_tinggal">
                                <option value=""></option>
                                <option value="Tinggal dengan Ayah Kandung" {{ old('status_tempat_tinggal') == 'Tinggal dengan Ayah Kandung' ? 'selected' : '' }}>Tinggal dengan Ayah Kandung</option>
                                <option value="Tinggal dengan Ibu Kandung" {{ old('status_tempat_tinggal') == 'Tinggal dengan Ibu Kandung' ? 'selected' : '' }}>Tinggal dengan Ibu Kandung</option>
                                <option value="Tinggal dengan Wali" {{ old('status_tempat_tinggal') == 'Tinggal dengan Wali' ? 'selected' : '' }}>Tinggal dengan Wali</option>
                                <option value="Ikut Saudara/Kerabat" {{ old('status_tempat_tinggal') == 'Ikut Saudara/Kerabat' ? 'selected' : '' }}>Ikut Saudara/Kerabat</option>
                                <option value="Asrama Madrasah" {{ old('status_tempat_tinggal') == 'Asrama Madrasah' ? 'selected' : '' }}>Asrama Madrasah</option>
                                <option value="Kontrak/Kost" {{ old('status_tempat_tinggal') == 'Kontrak/Kost' ? 'selected' : '' }}>Kontrak/Kost</option>
                                <option value="Tinggal di Asrama Pesantren" {{ old('status_tempat_tinggal') == 'Tinggal di Asrama Pesantren' ? 'selected' : '' }}>Tinggal di Asrama Pesantren</option>
                                <option value="Panti Asuhan" {{ old('status_tempat_tinggal') == 'Panti Asuhan' ? 'selected' : '' }}>Panti Asuhan</option>
                                <option value="Rumah Singgah" {{ old('status_tempat_tinggal') == 'Rumah Singgah' ? 'selected' : '' }}>Rumah Singgah</option>
                                <option value="Lainnya" {{ old('status_tempat_tinggal') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>

                            @error('status_tempat_tinggal','alamat')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Provinsi</label>
                            <select class="form-control" name="provinsi_siswa" id="provinsi_siswa">
                                <option value="">Pilih Provinsi</option>
                            </select>
                            @error('provinsi_siswa','alamat')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label>Kabupaten/Kota</label>
                            <select class="form-control" name="kab_kota_siswa" id="kab_kota_siswa" disabled>
                                <option value="">Pilih Kabupaten/Kota</option>
                            </select>
                            @error('kab_kota_siswa','alamat')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Kecamatan</label>
                            <select class="form-control" name="kecamatan_siswa" id="kecamatan_siswa" disabled>
                                <option value="">Pilih Kecamatan</option>
                            </select>
                            @error('kecamatan_siswa','alamat')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label>Kelurahan/Desa</label>
                            <select class="form-control" name="kel_des_siswa" id="kel_des_siswa" disabled>
                                <option value="">Pilih Kelurahan/Desa</option>
                            </select>
                            @error('kel_des_siswa','alamat')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>RT</label>
                            <input type="text" class="form-control" name="rt_siswa" value="{{ old('status_tempat_tinggal') == 'Tinggal dengan Ayah Kandung' ? old('rt_ayah') : (old('status_tempat_tinggal') == 'Tinggal dengan Ibu Kandung' ? old('rt_ibu') : old('rt_siswa')) }}">
                            @error('rt_siswa','alamat')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label>RW</label>
                            <input type="text" class="form-control" name="rw_siswa" value="{{ old('status_tempat_tinggal') == 'Tinggal dengan Ayah Kandung' ? old('rw_ayah') : (old('status_tempat_tinggal') == 'Tinggal dengan Ibu Kandung' ? old('rw_ibu') : old('rw_siswa')) }}">
                            @error('rw_siswa','alamat')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Alamat</label>
                            <textarea class="form-control" name="alamat_siswa">{{ old('status_tempat_tinggal') == 'Tinggal dengan Ayah Kandung' ? old('alamat_ayah') : (old('status_tempat_tinggal') == 'Tinggal dengan Ibu Kandung' ? old('alamat_ibu') : old('alamat_siswa')) }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label>Kode Pos</label>
                            <input type="text" class="form-control" name="kode_pos_siswa" value="{{ old('status_tempat_tinggal') == 'Tinggal dengan Ayah Kandung' ? old('kode_pos_ayah') : (old('status_tempat_tinggal') == 'Tinggal dengan Ibu Kandung' ? old('kode_pos_ibu') : old('kode_pos_siswa')) }}">
                            @error('alamat_siswa','alamat')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Jarak</label>
                            <select class="form-control" name="jarak">
                                <option value="">Pilih Jarak Tempuh</option>
                                <option value="Kurang dari 5 km" {{ old('jarak') == 'Kurang dari 5 km' ? 'selected' : '' }}>Kurang dari 5 km</option>
                                <option value="Antara 5-10 Km" {{ old('jarak') == 'Antara 5-10 Km' ? 'selected' : '' }}>Antara 5-10 Km</option>
                                <option value="Antara 11 - 20 Km" {{ old('jarak') == 'Antara 11 - 20 Km' ? 'selected' : '' }}>Antara 11 - 20 Km</option>
                                <option value="Antara 21 - 30 Km" {{ old('jarak') == 'Antara 21-30 Km' ? 'selected' : '' }}>Antara 21-30 Km</option>
                                <option value="Lebih dari 30 Km" {{ old('jarak') == 'Lebih dari 30 Km' ? 'selected' : '' }}>Lebih dari 30 Km</option>
                            </select>
                            @error('jarak', 'alamat')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label>Transportasi</label>
                            <select class="form-control" name="transportasi">
                                <option value="">Pilih Transportasi</option>
                                <option value="Jalan Kaki" {{ old('transportasi') == 'Jalan Kaki' ? 'selected' : '' }}>Jalan Kaki</option>
                                <option value="Sepeda" {{ old('transportasi') == 'Sepeda' ? 'selected' : '' }}>Sepeda</option>
                                <option value="Sepeda Motor" {{ old('transportasi') == 'Sepeda Motor' ? 'selected' : '' }}>Sepeda Motor</option>
                                <option value="Mobil Pribadi" {{ old('transportasi') == 'Mobil Pribadi' ? 'selected' : '' }}>Mobil Pribadi</option>
                                <option value="Antar Jemput Sekolah" {{ old('transportasi') == 'Antar Jemput Sekolah' ? 'selected' : '' }}>Antar Jemput Sekolah</option>
                                <option value="Angkutan Umum" {{ old('transportasi') == 'Angkutan Umum' ? 'selected' : '' }}>Angkutan Umum</option>
                                <option value="Perahu/Sampan" {{ old('transportasi') == 'Perahu/Sampan' ? 'selected' : '' }}>Perahu/Sampan</option>
                                <option value="Lainnya" {{ old('transportasi') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                <option value="Kendaraan Pribadi" {{ old('transportasi') == 'Kendaraan Pribadi' ? 'selected' : '' }}>Kendaraan Pribadi</option>
                                <option value="Kereta Api" {{ old('transportasi') == 'Kereta Api' ? 'selected' : '' }}>Kereta Api</option>
                                <option value="Ojek" {{ old('transportasi') == 'Ojek' ? 'selected' : '' }}>Ojek</option>
                                <option value="Andong/Bendi/Sado/Dokar/Delman/Becak" {{ old('transportasi') == 'Andong/Bendi/Sado/Dokar/Delman/Becak' ? 'selected' : '' }}>
                                    Andong/Bendi/Sado/Dokar/Delman/Becak
                                </option>
                            </select>
                            @error('transportasi', 'alamat')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Waktu Tempuh</label>
                            <input type="text" class="form-control" name="waktu_tempuh" value="{{ old('waktu_tempuh') }}">
                            @error('waktu_tempuh','alamat')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Kirim Formulir</button>
                    </div>
                </form>
            </div>

            

            </div>
    </div>
    <!-- JS Bootstrap (pastikan menambahkan sebelum penutupan body) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.22.1/dist/sweetalert2.all.min.js"></script>
    @if (session('success_ortu'))
        
        <script>
            Swal.fire({
                title: `{{ session('success_ortu') }}`,
                text: `{{ session('info_ortu') }}`,
                icon: "success"
            });
        </script>
    @endif
    @if (session('success_siswa'))
        
        <script>
            Swal.fire({
                title: `{{ session('success_siswa') }}`,
                text: `{{ session('info_siswa') }}`,
                icon: "success"
            });
        </script>
    @endif
    @if (session('success_alamat'))
        
        <script>
            Swal.fire({
                title: `{{ session('success_alamat') }}`,
                text: `{{ session('info_alamat') }}`,
                icon: "success"
            });
        </script>
    @endif
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkbox = document.getElementById('defaultCheck1');
            const inputAyah = document.getElementById('nama_ayah');
            const kepalaKK = @json($statusSiswa ? $statusSiswa->kepala_kk : null);

            function applyCheckboxLogic() {
                if (checkbox.checked) {
                    inputAyah.value = kepalaKK;
                    inputAyah.readOnly = true;
                } else {
                    inputAyah.readOnly = false;
                }
            }

            // Jalankan saat load halaman
            applyCheckboxLogic();

            checkbox.addEventListener('change', function () {
                applyCheckboxLogic();
                if (!this.checked) {
                    inputAyah.value = ''; // reset input kalau user uncheck
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            const selectWali = document.getElementById('pilih_wali');
            const oldValue = selectWali.dataset.old;

            if (oldValue) {
                selectWali.value = oldValue;
                selectWali.dispatchEvent(new Event('change'));
            }
        });
        
        document.addEventListener('DOMContentLoaded', function () {
            const selectWali = document.getElementById('pilih_wali');

            function handleWaliChange() {
                const val = selectWali.value;

                const fields = [
                    'nama',
                    'status',
                    'kewarganegaraan',
                    'nik',
                    'tempat_lahir',
                    'tanggal_lahir',
                    'pendidikan',
                    'pekerjaan',
                    'penghasilan',
                    'no_hp'
                ];

                fields.forEach(field => {
                    const sourceId = `${field}_${val}`;     // e.g. nama_ayah
                    const targetId = `${field}_wali`;       // e.g. nama_wali

                    const sourceElem = document.getElementById(sourceId);
                    const targetElem = document.getElementById(targetId);

                    if (!targetElem) return;

                    if (val === 'ayah' || val === 'ibu') {
                        if (sourceElem) {
                            targetElem.value = sourceElem.value;
                        }

                        if (targetElem.tagName.toLowerCase() === 'select') {
                            
                        } else {
                            targetElem.readOnly = true;
                        }

                    } else {
                        // Saat "lainnya", jangan kosongkan jika old() dari Laravel sudah mengisi
                        if (!targetElem.hasAttribute('data-old')) {
                            targetElem.value = '';
                        }

                        targetElem.readOnly = false;
                    }
                });
            }

            // Jalankan saat halaman dimuat (mendukung old())
            handleWaliChange();

            // Jalankan saat select berubah
            selectWali.addEventListener('change', handleWaliChange);
        });

        // ayah meninggal
        document.addEventListener("DOMContentLoaded", function() {
            // Ambil elemen status ayah
            var statusAyah = document.getElementById("status_ayah");
            var pilihWali = document.getElementById('pilih_wali');

            

            // Fungsi untuk menonaktifkan semua input/select
            function disableForm() {
                // Semua elemen input dan select yang perlu dinonaktifkan
                var inputs = document.querySelectorAll(
                    '#kewarganegaraan_ayah, #nik_ayah, #tempat_lahir_ayah, #tanggal_lahir_ayah, #pendidikan_ayah, #pekerjaan_ayah, #penghasilan_ayah, #no_hp_ayah'
                );

                
                
                
                inputs.forEach(function(input) {
                    input.disabled = true;
                    
                    
                });

                Array.from(pilihWali.options).forEach(option => {
                    if (option.value === 'ayah') {
                        option.disabled = true; 
                    }
                });
            }

            // Fungsi untuk mengaktifkan form
            function enableForm() {
                // Semua elemen input dan select yang perlu diaktifkan kembali
                var inputs = document.querySelectorAll(
                    '#kewarganegaraan_ayah, #nik_ayah, #tempat_lahir_ayah, #tanggal_lahir_ayah, #pendidikan_ayah, #pekerjaan_ayah, #penghasilan_ayah, #no_hp_ayah'
                );
                inputs.forEach(function(input) {
                    input.disabled = false;
                    
                });
                Array.from(pilihWali.options).forEach(option => {
                    if (option.value === 'ayah') {
                        option.disabled = false; 
                    }
                });
            }

            // Tambahkan event listener pada perubahan status ayah
            statusAyah.addEventListener('change', function() {
                if (statusAyah.value === 'meninggal') {
                    disableForm();
                } else {
                    enableForm();
                }
            });

            // Periksa status saat pertama kali halaman dimuat
            if (statusAyah.value === 'meninggal') {
                disableForm();
            }
        });

        
        // ibu meninggal
        document.addEventListener("DOMContentLoaded", function() {
            // Ambil elemen status ayah
            var statusIbu = document.getElementById("status_ibu");
            var pilihWali = document.getElementById('pilih_wali');

            

            // Fungsi untuk menonaktifkan semua input/select
            function disableForm() {
                // Semua elemen input dan select yang perlu dinonaktifkan
                var inputs = document.querySelectorAll(
                    '#kewarganegaraan_ibu, #nik_ibu, #tempat_lahir_ibu, #tanggal_lahir_ibu, #pendidikan_ibu, #pekerjaan_ibu, #penghasilan_ibu, #no_hp_ibu'
                );
                
                inputs.forEach(function(input) {
                    input.disabled = true;
                });

                Array.from(pilihWali.options).forEach(option => {
                    if (option.value === 'ibu') {
                        option.disabled = true; 
                    }
                });
            }

            // Fungsi untuk mengaktifkan form
            function enableForm() {
                // Semua elemen input dan select yang perlu diaktifkan kembali
                var inputs = document.querySelectorAll(
                    '#kewarganegaraan_ibu, #nik_ibu, #tempat_lahir_ibu, #tanggal_lahir_ibu, #pendidikan_ibu, #pekerjaan_ibu, #penghasilan_ibu, #no_hp_ibu'
                );
                inputs.forEach(function(input) {
                    input.disabled = false;
                });
                Array.from(pilihWali.options).forEach(option => {
                    if (option.value === 'ibu') {
                        option.disabled = false; 
                    }
                });
            }

            // Tambahkan event listener pada perubahan status ayah
            statusIbu.addEventListener('change', function() {
                if (statusIbu.value === 'meninggal') {
                    disableForm();
                } else {
                    enableForm();
                }
            });

            // Periksa status saat pertama kali halaman dimuat
            if (statusIbu.value === 'meninggal') {
                disableForm();
            }
        });
    </script>
    <script src="{{ 'js/field.js' }}"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.22.1/dist/sweetalert2.all.min.js"></script>
    <script>
        // Wilayah Indonesia untuk alamat ayah dengan fitur old()
        document.addEventListener('DOMContentLoaded', function () {
            // 1. Load Provinsi
            fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')
                .then(res => res.json())
                .then(data => {
                    const provinsiSelect = document.getElementById('provinsi_ayah');
                    data.forEach(prov => {
                        let opt = document.createElement('option');
                        opt.value = prov.name;
                        opt.setAttribute('data-id', prov.id);
                        opt.textContent = prov.name;
                        provinsiSelect.appendChild(opt);
                    });
                    // Set old value jika ada
                    if (oldProvinsiAyah) {
                        provinsiSelect.value = oldProvinsiAyah;
                        provinsiSelect.dispatchEvent(new Event('change'));
                    }
                });

            document.getElementById('provinsi_ayah').addEventListener('change', function () {
                const provId = this.options[this.selectedIndex].getAttribute('data-id');
                const kabSelect = document.getElementById('kab_kota_ayah');
                kabSelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
                kabSelect.disabled = true;
                document.getElementById('kecamatan_ayah').innerHTML = '<option value="">Pilih Kecamatan</option>';
                document.getElementById('kecamatan_ayah').disabled = true;
                document.getElementById('kel_des_ayah').innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
                document.getElementById('kel_des_ayah').disabled = true;

                if (provId) {
                    fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provId}.json`)
                        .then(res => res.json())
                        .then(data => {
                            data.forEach(kab => {
                                let opt = document.createElement('option');
                                opt.value = kab.name;
                                opt.setAttribute('data-id', kab.id);
                                opt.textContent = kab.name;
                                kabSelect.appendChild(opt);
                            });
                            kabSelect.disabled = false;
                            // Set old value jika ada
                            if (oldKabKotaAyah) {
                                kabSelect.value = oldKabKotaAyah;
                                kabSelect.dispatchEvent(new Event('change'));
                            }
                        });
                }
            });

            document.getElementById('kab_kota_ayah').addEventListener('change', function () {
                const kabId = this.options[this.selectedIndex].getAttribute('data-id');
                const kecSelect = document.getElementById('kecamatan_ayah');
                kecSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                kecSelect.disabled = true;
                document.getElementById('kel_des_ayah').innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
                document.getElementById('kel_des_ayah').disabled = true;

                if (kabId) {
                    fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${kabId}.json`)
                        .then(res => res.json())
                        .then(data => {
                            data.forEach(kec => {
                                let opt = document.createElement('option');
                                opt.value = kec.name;
                                opt.setAttribute('data-id', kec.id);
                                opt.textContent = kec.name;
                                kecSelect.appendChild(opt);
                            });
                            kecSelect.disabled = false;
                            // Set old value jika ada
                            if (oldKecamatanAyah) {
                                kecSelect.value = oldKecamatanAyah;
                                kecSelect.dispatchEvent(new Event('change'));
                            }
                        });
                }
            });

            document.getElementById('kecamatan_ayah').addEventListener('change', function () {
                const kecId = this.options[this.selectedIndex].getAttribute('data-id');
                const kelSelect = document.getElementById('kel_des_ayah');
                kelSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
                kelSelect.disabled = true;

                if (kecId) {
                    fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/villages/${kecId}.json`)
                        .then(res => res.json())
                        .then(data => {
                            data.forEach(kel => {
                                let opt = document.createElement('option');
                                opt.value = kel.name;
                                opt.textContent = kel.name;
                                kelSelect.appendChild(opt);
                            });
                            kelSelect.disabled = false;
                            // Set old value jika ada
                            if (oldKelDesAyah) {
                                kelSelect.value = oldKelDesAyah;
                            }
                        });
                }
            });
        });
    </script>
    <script>
        // Ambil value old dari Laravel untuk alamat wali
        const oldProvinsiWali = @json(old('provinsi_wali'));
        const oldKabKotaWali = @json(old('kab_kota_wali'));
        const oldKecamatanWali = @json(old('kecamatan_wali'));
        const oldKelDesWali = @json(old('kel_des_wali'));
    </script>
    <script>
        // Wilayah Indonesia untuk alamat wali dengan fitur old()
        document.addEventListener('DOMContentLoaded', function () {
            // 1. Load Provinsi
            fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')
                .then(res => res.json())
                .then(data => {
                    const provinsiSelect = document.getElementById('provinsi_wali');
                    data.forEach(prov => {
                        let opt = document.createElement('option');
                        opt.value = prov.name;
                        opt.setAttribute('data-id', prov.id);
                        opt.textContent = prov.name;
                        provinsiSelect.appendChild(opt);
                    });
                    // Set old value jika ada
                    if (oldProvinsiWali) {
                        provinsiSelect.value = oldProvinsiWali;
                        provinsiSelect.dispatchEvent(new Event('change'));
                    }
                });

            document.getElementById('provinsi_wali').addEventListener('change', function () {
                const provId = this.options[this.selectedIndex].getAttribute('data-id');
                const kabSelect = document.getElementById('kab_kota_wali');
                kabSelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
                kabSelect.disabled = true;
                document.getElementById('kecamatan_wali').innerHTML = '<option value="">Pilih Kecamatan</option>';
                document.getElementById('kecamatan_wali').disabled = true;
                document.getElementById('kel_des_wali').innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
                document.getElementById('kel_des_wali').disabled = true;

                if (provId) {
                    fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provId}.json`)
                        .then(res => res.json())
                        .then(data => {
                            data.forEach(kab => {
                                let opt = document.createElement('option');
                                opt.value = kab.name;
                                opt.setAttribute('data-id', kab.id);
                                opt.textContent = kab.name;
                                kabSelect.appendChild(opt);
                            });
                            kabSelect.disabled = false;
                            // Set old value jika ada
                            if (oldKabKotaWali) {
                                kabSelect.value = oldKabKotaWali;
                                kabSelect.dispatchEvent(new Event('change'));
                            }
                        });
                }
            });

            document.getElementById('kab_kota_wali').addEventListener('change', function () {
                const kabId = this.options[this.selectedIndex].getAttribute('data-id');
                const kecSelect = document.getElementById('kecamatan_wali');
                kecSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                kecSelect.disabled = true;
                document.getElementById('kel_des_wali').innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
                document.getElementById('kel_des_wali').disabled = true;

                if (kabId) {
                    fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${kabId}.json`)
                        .then(res => res.json())
                        .then(data => {
                            data.forEach(kec => {
                                let opt = document.createElement('option');
                                opt.value = kec.name;
                                opt.setAttribute('data-id', kec.id);
                                opt.textContent = kec.name;
                                kecSelect.appendChild(opt);
                            });
                            kecSelect.disabled = false;
                            // Set old value jika ada
                            if (oldKecamatanWali) {
                                kecSelect.value = oldKecamatanWali;
                                kecSelect.dispatchEvent(new Event('change'));
                            }
                        });
                }
            });

            document.getElementById('kecamatan_wali').addEventListener('change', function () {
                const kecId = this.options[this.selectedIndex].getAttribute('data-id');
                const kelSelect = document.getElementById('kel_des_wali');
                kelSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
                kelSelect.disabled = true;

                if (kecId) {
                    fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/villages/${kecId}.json`)
                        .then(res => res.json())
                        .then(data => {
                            data.forEach(kel => {
                                let opt = document.createElement('option');
                                opt.value = kel.name;
                                opt.textContent = kel.name;
                                kelSelect.appendChild(opt);
                            });
                            kelSelect.disabled = false;
                            // Set old value jika ada
                            if (oldKelDesWali) {
                                kelSelect.value = oldKelDesWali;
                            }
                        });
                }
            });
        });
    </script>
    <script>
        // Ambil value old dari Laravel untuk alamat ibu
        const oldProvinsiIbu = @json(old('provinsi_ibu'));
        const oldKabKotaIbu = @json(old('kab_kota_ibu'));
        const oldKecamatanIbu = @json(old('kecamatan_ibu'));
        const oldKelDesIbu = @json(old('kel_des_ibu'));
        // Ambil value old dari Laravel untuk alamat siswa
        const oldProvinsiSiswa = @json(old('provinsi_siswa'));
        const oldKabKotaSiswa = @json(old('kab_kota_siswa'));
        const oldKecamatanSiswa = @json(old('kecamatan_siswa'));
        const oldKelDesSiswa = @json(old('kel_des_siswa'));
    </script>
    <script>
        // Wilayah Indonesia untuk alamat ibu dengan fitur old()
        document.addEventListener('DOMContentLoaded', function () {
            // IBU
            fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')
                .then(res => res.json())
                .then(data => {
                    const provinsiSelect = document.getElementById('provinsi_ibu');
                    data.forEach(prov => {
                        let opt = document.createElement('option');
                        opt.value = prov.name;
                        opt.setAttribute('data-id', prov.id);
                        opt.textContent = prov.name;
                        provinsiSelect.appendChild(opt);
                    });
                    if (oldProvinsiIbu) {
                        provinsiSelect.value = oldProvinsiIbu;
                        provinsiSelect.dispatchEvent(new Event('change'));
                    }
                });
            });
            // IBU
            document.getElementById('provinsi_ibu').addEventListener('change', function () {
                const provId = this.options[this.selectedIndex].getAttribute('data-id');
                const kabSelect = document.getElementById('kab_kota_ibu');
                kabSelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
                kabSelect.disabled = true;
                document.getElementById('kecamatan_ibu').innerHTML = '<option value="">Pilih Kecamatan</option>';
                document.getElementById('kecamatan_ibu').disabled = true;
                document.getElementById('kel_des_ibu').innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
                document.getElementById('kel_des_ibu').disabled = true;
                if (provId) {
                    fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provId}.json`)
                        .then(res => res.json())
                        .then(data => {
                            data.forEach(kab => {
                                let opt = document.createElement('option');
                                opt.value = kab.name;
                                opt.setAttribute('data-id', kab.id);
                                opt.textContent = kab.name;
                                kabSelect.appendChild(opt);
                            });
                            kabSelect.disabled = false;
                            if (oldKabKotaIbu) {
                                kabSelect.value = oldKabKotaIbu;
                                kabSelect.dispatchEvent(new Event('change'));
                            }
                        });
            }
        });
        document.getElementById('kab_kota_ibu').addEventListener('change', function () {
            const kabId = this.options[this.selectedIndex].getAttribute('data-id');
            const kecSelect = document.getElementById('kecamatan_ibu');
            kecSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
            kecSelect.disabled = true;
            document.getElementById('kel_des_ibu').innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
            document.getElementById('kel_des_ibu').disabled = true;
            if (kabId) {
                fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${kabId}.json`)
                    .then(res => res.json())
                    .then(data => {
                        data.forEach(kec => {
                            let opt = document.createElement('option');
                            opt.value = kec.name;
                            opt.setAttribute('data-id', kec.id);
                            opt.textContent = kec.name;
                            kecSelect.appendChild(opt);
                        });
                        kecSelect.disabled = false;
                        if (oldKecamatanIbu) {
                            kecSelect.value = oldKecamatanIbu;
                            kecSelect.dispatchEvent(new Event('change'));
                        }
                    });
            }
        });
        document.getElementById('kecamatan_ibu').addEventListener('change', function () {
            const kecId = this.options[this.selectedIndex].getAttribute('data-id');
            const kelSelect = document.getElementById('kel_des_ibu');
            kelSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
            kelSelect.disabled = true;
            if (kecId) {
                fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/villages/${kecId}.json`)
                    .then(res => res.json())
                    .then(data => {
                        data.forEach(kel => {
                            let opt = document.createElement('option');
                            opt.value = kel.name;
                            opt.textContent = kel.name;
                            kelSelect.appendChild(opt);
                        });
                        kelSelect.disabled = false;
                        if (oldKelDesIbu) {
                            kelSelect.value = oldKelDesIbu;
                        }
                    });
            }
        });
        // SISWA
        fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')
            .then(res => res.json())
            .then(data => {
                const provinsiSelect = document.getElementById('provinsi_siswa');
                data.forEach(prov => {
                    let opt = document.createElement('option');
                    opt.value = prov.name;
                    opt.setAttribute('data-id', prov.id);
                    opt.textContent = prov.name;
                    provinsiSelect.appendChild(opt);
                });
                if (oldProvinsiSiswa) {
                    provinsiSelect.value = oldProvinsiSiswa;
                    provinsiSelect.dispatchEvent(new Event('change'));
                }
            });
        document.getElementById('provinsi_siswa').addEventListener('change', function () {
            const provId = this.options[this.selectedIndex].getAttribute('data-id');
            const kabSelect = document.getElementById('kab_kota_siswa');
            kabSelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
            kabSelect.disabled = true;
            document.getElementById('kecamatan_siswa').innerHTML = '<option value="">Pilih Kecamatan</option>';
            document.getElementById('kecamatan_siswa').disabled = true;
            document.getElementById('kel_des_siswa').innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
            document.getElementById('kel_des_siswa').disabled = true;
            if (provId) {
                fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provId}.json`)
                    .then(res => res.json())
                    .then(data => {
                        data.forEach(kab => {
                            let opt = document.createElement('option');
                            opt.value = kab.name;
                            opt.setAttribute('data-id', kab.id);
                            opt.textContent = kab.name;
                            kabSelect.appendChild(opt);
                        });
                        kabSelect.disabled = false;
                        if (oldKabKotaSiswa) {
                            kabSelect.value = oldKabKotaSiswa;
                            kabSelect.dispatchEvent(new Event('change'));
                        }
                    });
            }
        });
        document.getElementById('kab_kota_siswa').addEventListener('change', function () {
            const kabId = this.options[this.selectedIndex].getAttribute('data-id');
            const kecSelect = document.getElementById('kecamatan_siswa');
            kecSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
            kecSelect.disabled = true;
            document.getElementById('kel_des_siswa').innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
            document.getElementById('kel_des_siswa').disabled = true;
            if (kabId) {
                fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${kabId}.json`)
                    .then(res => res.json())
                    .then(data => {
                        data.forEach(kec => {
                            let opt = document.createElement('option');
                            opt.value = kec.name;
                            opt.setAttribute('data-id', kec.id);
                            opt.textContent = kec.name;
                            kecSelect.appendChild(opt);
                        });
                        kecSelect.disabled = false;
                        if (oldKecamatanSiswa) {
                            kecSelect.value = oldKecamatanSiswa;
                            kecSelect.dispatchEvent(new Event('change'));
                        }
                    });
            }
        });
        document.getElementById('kecamatan_siswa').addEventListener('change', function () {
            const kecId = this.options[this.selectedIndex].getAttribute('data-id');
            const kelSelect = document.getElementById('kel_des_siswa');
            kelSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
            kelSelect.disabled = true;
            if (kecId) {
                fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/villages/${kecId}.json`)
                    .then(res => res.json())
                    .then(data => {
                        data.forEach(kel => {
                            let opt = document.createElement('option');
                            opt.value = kel.name;
                            opt.textContent = kel.name;
                            kelSelect.appendChild(opt);
                        });
                        kelSelect.disabled = false;
                        if (oldKelDesSiswa) {
                            kelSelect.value = oldKelDesSiswa;
                        }
                    });
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            function setupWilayah(prefix, oldProv, oldKab, oldKec, oldKel) {
                // 1. Load Provinsi
                fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')
                    .then(res => res.json())
                    .then(data => {
                        const provinsiSelect = document.getElementById('provinsi_' + prefix);
                        if (!provinsiSelect) return;
                        data.forEach(prov => {
                            let opt = document.createElement('option');
                            opt.value = prov.name;
                            opt.setAttribute('data-id', prov.id);
                            opt.textContent = prov.name;
                            provinsiSelect.appendChild(opt);
                        });
                        if (oldProv) {
                            provinsiSelect.value = oldProv;
                            provinsiSelect.dispatchEvent(new Event('change'));
                        }
                    });

                const provSelect = document.getElementById('provinsi_' + prefix);
                if (!provSelect) return;
                provSelect.addEventListener('change', function () {
                    const provId = this.options[this.selectedIndex].getAttribute('data-id');
                    const kabSelect = document.getElementById('kab_kota_' + prefix);
                    kabSelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
                    kabSelect.disabled = true;
                    document.getElementById('kecamatan_' + prefix).innerHTML = '<option value="">Pilih Kecamatan</option>';
                    document.getElementById('kecamatan_' + prefix).disabled = true;
                    document.getElementById('kel_des_' + prefix).innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
                    document.getElementById('kel_des_' + prefix).disabled = true;
                    if (provId) {
                        fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provId}.json`)
                            .then(res => res.json())
                            .then(data => {
                                data.forEach(kab => {
                                    let opt = document.createElement('option');
                                    opt.value = kab.name;
                                    opt.setAttribute('data-id', kab.id);
                                    opt.textContent = kab.name;
                                    kabSelect.appendChild(opt);
                                });
                                kabSelect.disabled = false;
                                if (oldKab) {
                                    kabSelect.value = oldKab;
                                    kabSelect.dispatchEvent(new Event('change'));
                                }
                            });
                    }
                });

                const kabupatenSelect = document.getElementById('kab_kota_' + prefix);
                if (!kabupatenSelect) return;
                kabupatenSelect.addEventListener('change', function () {
                    const kabId = this.options[this.selectedIndex].getAttribute('data-id');
                    const kecSelect = document.getElementById('kecamatan_' + prefix);
                    kecSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                    kecSelect.disabled = true;
                    document.getElementById('kel_des_' + prefix).innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
                    document.getElementById('kel_des_' + prefix).disabled = true;
                    if (kabId) {
                        fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${kabId}.json`)
                            .then(res => res.json())
                            .then(data => {
                                data.forEach(kec => {
                                    let opt = document.createElement('option');
                                    opt.value = kec.name;
                                    opt.setAttribute('data-id', kec.id);
                                    opt.textContent = kec.name;
                                    kecSelect.appendChild(opt);
                                });
                                kecSelect.disabled = false;
                                if (oldKec) {
                                    kecSelect.value = oldKec;
                                    kecSelect.dispatchEvent(new Event('change'));
                                }
                            });
                    }
                });

                const kecamatanSelect = document.getElementById('kecamatan_' + prefix);
                if (!kecamatanSelect) return;
                kecamatanSelect.addEventListener('change', function () {
                    const kecId = this.options[this.selectedIndex].getAttribute('data-id');
                    const kelSelect = document.getElementById('kel_des_' + prefix);
                    kelSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
                    kelSelect.disabled = true;
                    if (kecId) {
                        fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/villages/${kecId}.json`)
                            .then(res => res.json())
                            .then(data => {
                                data.forEach(kel => {
                                    let opt = document.createElement('option');
                                    opt.value = kel.name;
                                    opt.textContent = kel.name;
                                    kelSelect.appendChild(opt);
                                });
                                kelSelect.disabled = false;
                                if (oldKel) {
                                    kelSelect.value = oldKel;
                                }
                            });
                    }
                });
            }

            setupWilayah('ayah', @json(old('provinsi_ayah')), @json(old('kab_kota_ayah')), @json(old('kecamatan_ayah')), @json(old('kel_des_ayah')));
            setupWilayah('ibu', @json(old('pemilikan_rumah_ibu') == 'Sama Dengan Ayah' ? old('provinsi_ayah') : old('provinsi_ibu')), @json(old('pemilikan_rumah_ibu') == 'Sama Dengan Ayah' ? old('kab_kota_ayah') : old('kab_kota_ibu')), @json(old('pemilikan_rumah_ibu') == 'Sama Dengan Ayah' ? old('kecamatan_ayah') : old('kecamatan_ibu')), @json(old('pemilikan_rumah_ibu') == 'Sama Dengan Ayah' ? old('kel_des_ayah') : old('kel_des_ibu')));
            setupWilayah('wali', @json(old('pemilikan_rumah_wali') == 'Sama dengan Ayah' ? old('provinsi_ayah') : (old('pemilikan_rumah_wali') == 'Sama dengan Ibu' ? old('provinsi_ibu') : old('provinsi_wali'))), @json(old('pemilikan_rumah_wali') == 'Sama dengan Ayah' ? old('kab_kota_ayah') : (old('pemilikan_rumah_wali') == 'Sama dengan Ibu' ? old('kab_kota_ibu') : old('kab_kota_wali'))), @json(old('pemilikan_rumah_wali') == 'Sama dengan Ayah' ? old('kecamatan_ayah') : (old('pemilikan_rumah_wali') == 'Sama dengan Ibu' ? old('kecamatan_ibu') : old('kecamatan_wali'))), @json(old('pemilikan_rumah_wali') == 'Sama dengan Ayah' ? old('kel_des_ayah') : (old('pemilikan_rumah_wali') == 'Sama dengan Ibu' ? old('kel_des_ibu') : old('kel_des_wali'))));
            setupWilayah(
              'siswa',
              @json(old('status_tempat_tinggal') == 'Tinggal dengan Ayah Kandung' ? old('provinsi_ayah') : (old('status_tempat_tinggal') == 'Tinggal dengan Ibu Kandung' ? old('provinsi_ibu') : old('provinsi_siswa'))),
              @json(old('status_tempat_tinggal') == 'Tinggal dengan Ayah Kandung' ? old('kab_kota_ayah') : (old('status_tempat_tinggal') == 'Tinggal dengan Ibu Kandung' ? old('kab_kota_ibu') : old('kab_kota_siswa'))),
              @json(old('status_tempat_tinggal') == 'Tinggal dengan Ayah Kandung' ? old('kecamatan_ayah') : (old('status_tempat_tinggal') == 'Tinggal dengan Ibu Kandung' ? old('kecamatan_ibu') : old('kecamatan_siswa'))),
              @json(old('status_tempat_tinggal') == 'Tinggal dengan Ayah Kandung' ? old('kel_des_ayah') : (old('status_tempat_tinggal') == 'Tinggal dengan Ibu Kandung' ? old('kel_des_ibu') : old('kel_des_siswa')))
            );
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectPemilikanIbu = document.querySelector('select[name="pemilikan_rumah_ibu"]');
            if (!selectPemilikanIbu) return;

            selectPemilikanIbu.addEventListener('change', function () {
                if (this.value === 'Sama Dengan Ayah') {
                    // Copy provinsi
                    const provAyah = document.getElementById('provinsi_ayah').value;
                    const kabAyah = document.getElementById('kab_kota_ayah').value;
                    const kecAyah = document.getElementById('kecamatan_ayah').value;
                    const kelAyah = document.getElementById('kel_des_ayah').value;
                    const rtAyah = document.querySelector('input[name="rt_ayah"]').value;
                    const rwAyah = document.querySelector('input[name="rw_ayah"]').value;
                    const alamatAyah = document.querySelector('textarea[name="alamat_ayah"]').value;
                    const kodePosAyah = document.querySelector('input[name="kode_pos_ayah"]').value;

                    // Set value ibu
                    document.getElementById('provinsi_ibu').value = provAyah;
                    document.getElementById('provinsi_ibu').dispatchEvent(new Event('change'));

                    // Tunggu async load kabupaten, kecamatan, kelurahan
                    setTimeout(function () {
                        document.getElementById('kab_kota_ibu').value = kabAyah;
                        document.getElementById('kab_kota_ibu').dispatchEvent(new Event('change'));
                        setTimeout(function () {
                            document.getElementById('kecamatan_ibu').value = kecAyah;
                            document.getElementById('kecamatan_ibu').dispatchEvent(new Event('change'));
                            setTimeout(function () {
                                document.getElementById('kel_des_ibu').value = kelAyah;
                            }, 500);
                        }, 500);
                    }, 500);

                    document.querySelector('input[name="rt_ibu"]').value = rtAyah;
                    document.querySelector('input[name="rw_ibu"]').value = rwAyah;
                    document.querySelector('textarea[name="alamat_ibu"]').value = alamatAyah;
                    document.querySelector('input[name="kode_pos_ibu"]').value = kodePosAyah;

                    // Optional: disable input agar tidak bisa diubah manual
                    document.getElementById('provinsi_ibu').disabled = true;
                    document.getElementById('kab_kota_ibu').disabled = true;
                    document.getElementById('kecamatan_ibu').disabled = true;
                    document.getElementById('kel_des_ibu').disabled = true;
                    document.querySelector('input[name="rt_ibu"]').readOnly = true;
                    document.querySelector('input[name="rw_ibu"]').readOnly = true;
                    document.querySelector('textarea[name="alamat_ibu"]').readOnly = true;
                    document.querySelector('input[name="kode_pos_ibu"]').readOnly = true;
                } else {
                    // Enable input jika user pilih selain 'Sama Dengan Ayah'
                    document.getElementById('provinsi_ibu').disabled = false;
                    document.getElementById('kab_kota_ibu').disabled = false;
                    document.getElementById('kecamatan_ibu').disabled = false;
                    document.getElementById('kel_des_ibu').disabled = false;
                    document.querySelector('input[name="rt_ibu"]').readOnly = false;
                    document.querySelector('input[name="rw_ibu"]').readOnly = false;
                    document.querySelector('textarea[name="alamat_ibu"]').readOnly = false;
                    document.querySelector('input[name="kode_pos_ibu"]').readOnly = false;
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectPemilikanWali = document.querySelector('select[name="pemilikan_rumah_wali"]');
            if (!selectPemilikanWali) return;

            selectPemilikanWali.addEventListener('change', function () {
                let sumber = null;
                if (this.value === 'Sama dengan Ayah') sumber = 'ayah';
                if (this.value === 'Sama dengan Ibu') sumber = 'ibu';

                if (sumber) {
                    // Copy data dari ayah/ibu
                    const prov = document.getElementById('provinsi_' + sumber).value;
                    const kab = document.getElementById('kab_kota_' + sumber).value;
                    const kec = document.getElementById('kecamatan_' + sumber).value;
                    const kel = document.getElementById('kel_des_' + sumber).value;
                    const rt = document.querySelector('input[name="rt_' + sumber + '"]').value;
                    const rw = document.querySelector('input[name="rw_' + sumber + '"]').value;
                    const alamat = document.querySelector('textarea[name="alamat_' + sumber + '"]').value;
                    const kodePos = document.querySelector('input[name="kode_pos_' + sumber + '"]').value;

                    // Set value wali
                    document.getElementById('provinsi_wali').value = prov;
                    document.getElementById('provinsi_wali').dispatchEvent(new Event('change'));
                    setTimeout(function () {
                        document.getElementById('kab_kota_wali').value = kab;
                        document.getElementById('kab_kota_wali').dispatchEvent(new Event('change'));
                        setTimeout(function () {
                            document.getElementById('kecamatan_wali').value = kec;
                            document.getElementById('kecamatan_wali').dispatchEvent(new Event('change'));
                            setTimeout(function () {
                                document.getElementById('kel_des_wali').value = kel;
                            }, 500);
                        }, 500);
                    }, 500);

                    document.querySelector('input[name="rt_wali"]').value = rt;
                    document.querySelector('input[name="rw_wali"]').value = rw;
                    document.querySelector('textarea[name="alamat_wali"]').value = alamat;
                    document.querySelector('input[name="kode_pos_wali"]').value = kodePos;

                    // Jangan disable select agar value tetap terkirim
                    // document.getElementById('provinsi_wali').disabled = true;
                    // document.getElementById('kab_kota_wali').disabled = true;
                    // document.getElementById('kecamatan_wali').disabled = true;
                    // document.getElementById('kel_des_wali').disabled = true;
                    document.querySelector('input[name="rt_wali"]').readOnly = true;
                    document.querySelector('input[name="rw_wali"]').readOnly = true;
                    document.querySelector('textarea[name="alamat_wali"]').readOnly = true;
                    document.querySelector('input[name="kode_pos_wali"]').readOnly = true;
                } else {
                    // Enable input jika user pilih selain 'Sama dengan Ayah' atau 'Sama dengan Ibu'
                    document.getElementById('provinsi_wali').disabled = false;
                    document.getElementById('kab_kota_wali').disabled = false;
                    document.getElementById('kecamatan_wali').disabled = false;
                    document.getElementById('kel_des_wali').disabled = false;
                    document.querySelector('input[name="rt_wali"]').readOnly = false;
                    document.querySelector('input[name="rw_wali"]').readOnly = false;
                    document.querySelector('textarea[name="alamat_wali"]').readOnly = false;
                    document.querySelector('input[name="kode_pos_wali"]').readOnly = false;
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectStatusTinggal = document.querySelector('select[name="status_tempat_tinggal"]');
            if (!selectStatusTinggal) return;

            selectStatusTinggal.addEventListener('change', function () {
                let sumber = null;
                if (this.value === 'Tinggal dengan Ayah Kandung') sumber = 'ayah';
                if (this.value === 'Tinggal dengan Ibu Kandung') sumber = 'ibu';

                if (sumber) {
                    // Copy data dari ayah/ibu
                    const prov = document.getElementById('provinsi_' + sumber).value;
                    const kab = document.getElementById('kab_kota_' + sumber).value;
                    const kec = document.getElementById('kecamatan_' + sumber).value;
                    const kel = document.getElementById('kel_des_' + sumber).value;
                    const rt = document.querySelector('input[name="rt_' + sumber + '"]').value;
                    const rw = document.querySelector('input[name="rw_' + sumber + '"]').value;
                    const alamat = document.querySelector('textarea[name="alamat_' + sumber + '"]').value;
                    const kodePos = document.querySelector('input[name="kode_pos_' + sumber + '"]').value;

                    // Set value siswa
                    document.getElementById('provinsi_siswa').value = prov;
                    document.getElementById('provinsi_siswa').dispatchEvent(new Event('change'));

                    // Tunggu async load kabupaten, kecamatan, kelurahan
                    setTimeout(function () {
                        document.getElementById('kab_kota_siswa').value = kab;
                        document.getElementById('kab_kota_siswa').dispatchEvent(new Event('change'));
                        setTimeout(function () {
                            document.getElementById('kecamatan_siswa').value = kec;
                            document.getElementById('kecamatan_siswa').dispatchEvent(new Event('change'));
                            setTimeout(function () {
                                document.getElementById('kel_des_siswa').value = kel;
                            }, 500);
                        }, 500);
                    }, 500);

                    document.querySelector('input[name="rt_siswa"]').value = rt;
                    document.querySelector('input[name="rw_siswa"]').value = rw;
                    document.querySelector('textarea[name="alamat_siswa"]').value = alamat;
                    document.querySelector('input[name="kode_pos_siswa"]').value = kodePos;

                    // Optional: disable input agar tidak bisa diubah manual
                    document.getElementById('provinsi_siswa').disabled = false;
                    document.getElementById('kab_kota_siswa').disabled = true;
                    document.getElementById('kecamatan_siswa').disabled = true;
                    document.getElementById('kel_des_siswa').disabled = true;
                    document.querySelector('input[name="rt_siswa"]').readOnly = true;
                    document.querySelector('input[name="rw_siswa"]').readOnly = true;
                    document.querySelector('textarea[name="alamat_siswa"]').readOnly = true;
                    document.querySelector('input[name="kode_pos_siswa"]').readOnly = true;
                } else {
                    // Enable input jika user pilih selain 'Tinggal dengan Ayah Kandung' atau 'Tinggal dengan Ibu Kandung'
                    document.getElementById('provinsi_siswa').disabled = false;
                    document.getElementById('kab_kota_siswa').disabled = false;
                    document.getElementById('kecamatan_siswa').disabled = false;
                    document.getElementById('kel_des_siswa').disabled = false;
                    document.querySelector('input[name="rt_siswa"]').readOnly = false;
                    document.querySelector('input[name="rw_siswa"]').readOnly = false;
                    document.querySelector('textarea[name="alamat_siswa"]').readOnly = false;
                    document.querySelector('input[name="kode_pos_siswa"]').readOnly = false;
                }
            });
        });
    </script>
</x-layout>