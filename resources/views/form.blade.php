<x-layout>
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
    </style>

    <div class="container">
        <h2>Formulir Pendaftaran</h2>
        <div class="d-flex justify-content-center mb-3">
            <div class="btn-group" role="group" aria-label="Basic example">
                {{-- <button  type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#collapseSiswa" aria-expanded="false" aria-controls="collapseSiswa">Data Siswa</button>
                <button  type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#collapseAyah" aria-expanded="false" aria-controls="collapseAyah">Data Ayah</button>
                <button  type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#collapseIbu" aria-expanded="false" aria-controls="collapseIbu">Data Ibu</button> --}}
                @php
                    $status_siswa = $statusSiswa ? 'disabled' : '' ;
                    $title_siswa = $statusSiswa ? 'Formulir siswa telah diisi' : '' ;
                    $status_ortu = $statusOrtu ? 'disabled' : '' ;
                    $title_ortu = $statusOrtu ? 'Formulir Orang Tua telah diisi' : '' ;
                @endphp
                <button {{ $status_siswa }} title="{{ $title_siswa }}" type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#collapseSiswa" aria-expanded="false" aria-controls="collapseSiswa">Data Siswa</button>
                <button {{ $status_ortu }} title="{{ $title_ortu }}" type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#collapseOrangTua" aria-expanded="false" aria-controls="collapseAyah">Data Orang Tua</button>
                
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
                            <input type="text" class="form-control" name="kk" value="{{ old('kk') }}">
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

                    <div class="mb-4">
                        <h5 class="mb-3">Data Ayah Kandung</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama_ayah" value="{{ old('nama_ayah') }}">
                                @error('nama_ayah','ortu') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Status</label>
                                <select class="form-control" name="status_ayah">
                                    <option value="hidup" @selected(old('status_ayah') == 'hidup')>Hidup</option>
                                    <option value="meninggal" @selected(old('status_ayah') == 'meninggal')>Meninggal</option>
                                </select>
                                @error('status_ayah','ortu') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Kewarganegaraan</label>
                                <select class="form-select" name="kewarganegaraan_ayah">
                                    <option value="">-- Pilih --</option>
                                    <option value="WNI" @selected(old('kewarganegaraan') == 'WNI')>WNI</option>
                                    <option value="WNA" @selected(old('kewarganegaraan') == 'WNA')>WNA</option>
                                </select>
                                @error('kewarganegaraan_ayah','ortu') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>NIK</label>
                                <input type="text" class="form-control" maxlength="16" pattern="\d*" inputmode="numeric" name="nik_ayah" value="{{ old('nik_ayah') }}">
                                @error('nik_ayah','ortu') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Tempat Lahir</label>
                                <input type="text" class="form-control" name="tempat_lahir_ayah" value="{{ old('tempat_lahir_ayah') }}">
                                @error('tempat_lahir_ayah','ortu') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Tanggal Lahir</label>
                                <input type="date" class="form-control" name="tanggal_lahir_ayah" value="{{ old('tanggal_lahir_ayah') }}">
                                @error('tanggal_lahir_ayah','ortu') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Pendidikan Terakhir</label>
                                <select class="form-control" name="pendidikan_ayah">
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
                                <select class="form-control" name="pekerjaan_ayah">
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
                                <select class="form-control" name="penghasilan_ayah">
                                    <option value="Kurang dari 500.000" @selected(old('penghasilan_ayah') == 'Kurang dari 500.000')>Kurang dari 500.000</option>
                                    <option value="500.000 - 1.000.000" @selected(old('penghasilan_ayah') == '500.000 - 1.000.000')>500.000 - 1.000.000</option>
                                    <option value="1.000.001 - 2.000.000" @selected(old('penghasilan_ayah') == '1.000.001 - 2.000.000')>1.000.001 - 2.000.000</option>
                                    <option value="2.000.001 - 3.000.000" @selected(old('penghasilan_ayah') == '2.000.001 - 3.000.000')>2.000.001 - 3.000.000</option>
                                    <option value="3.000.001 - 5.000.000" @selected(old('penghasilan_ayah') == '3.000.001 - 5.000.000')>3.000.001 - 5.000.000</option>
                                    <option value="Lebih dari 5.000.000" @selected(old('penghasilan_ayah') == 'Lebih dari 5.000.000')>Lebih dari 5.000.000</option>
                                    <option value="Tidak ada" @selected(old('penghasilan_ayah') == 'Tidak ada')>Tidak ada</option>
                                </select>
                                @error('penghasilan_ayah','ortu') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>No Handphone</label>
                                <input type="text" class="form-control" maxlength="13" pattern="\d*" inputmode="numeric" name="no_hp_ayah" value="{{ old('no_hp_ayah') }}">
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
                                <input type="text" class="form-control" name="nama_ibu" value="{{ old('nama_ibu') }}">
                                @error('nama_ibu','ortu') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Status</label>
                                <select class="form-control" name="status_ibu">
                                    <option value="hidup" @selected(old('status_ibu') == 'hidup')>Hidup</option>
                                    <option value="meninggal" @selected(old('status_ibu') == 'meninggal')>Meninggal</option>
                                </select>
                                @error('status_ibu','ortu') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <select class="form-select" name="kewarganegaraan_ibu">
                                    <option value="">-- Pilih --</option>
                                    <option value="WNI" @selected(old('kewarganegaraan_ibu') == 'WNI')>WNI</option>
                                    <option value="WNA" @selected(old('kewarganegaraan_ibu') == 'WNA')>WNA</option>
                                </select>
                                @error('kewarganegaraan_ibu','ortu') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>NIK</label>
                                <input type="text" class="form-control" name="nik_ibu" maxlength="16" pattern="\d*" inputmode="numeric" value="{{ old('nik_ibu') }}">
                                @error('nik_ibu','ortu') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Tempat Lahir</label>
                                <input type="text" class="form-control" name="tempat_lahir_ibu" value="{{ old('tempat_lahir_ibu') }}">
                                @error('tempat_lahir_ibu','ortu') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Tanggal Lahir</label>
                                <input type="date" class="form-control" name="tanggal_lahir_ibu" value="{{ old('tanggal_lahir_ibu') }}">
                                @error('tanggal_lahir_ibu','ortu') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Pendidikan Terakhir</label>
                                <select class="form-control" name="pendidikan_ibu">
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
                                <select class="form-control" name="pekerjaan_ibu">
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
                                <select class="form-control" name="penghasilan_ibu">
                                    <option value="Kurang dari 500.000" @selected(old('penghasilan_ibu') == 'Kurang dari 500.000')>Kurang dari 500.000</option>
                                    <option value="500.000 - 1.000.000" @selected(old('penghasilan_ibu') == '500.000 - 1.000.000')>500.000 - 1.000.000</option>
                                    <option value="1.000.001 - 2.000.000" @selected(old('penghasilan_ibu') == '1.000.001 - 2.000.000')>1.000.001 - 2.000.000</option>
                                    <option value="2.000.001 - 3.000.000" @selected(old('penghasilan_ibu') == '2.000.001 - 3.000.000')>2.000.001 - 3.000.000</option>
                                    <option value="3.000.001 - 5.000.000" @selected(old('penghasilan_ibu') == '3.000.001 - 5.000.000')>3.000.001 - 5.000.000</option>
                                    <option value="Lebih dari 5.000.000" @selected(old('penghasilan_ibu') == 'Lebih dari 5.000.000')>Lebih dari 5.000.000</option>
                                    <option value="Tidak ada" @selected(old('penghasilan_ibu') == 'Tidak ada')>Tidak ada</option>
                                </select>
                                @error('penghasilan_ibu','ortu') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>No Handphone</label>
                                <input type="text" class="form-control" name="no_hp_ibu" maxlength="13" pattern="\d*" inputmode="numeric" value="{{ old('no_hp_ibu') }}">
                                @error('no_hp_ibu','ortu') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                    </div>


                    <hr>

                    {{-- Data Wali --}}
                    <div class="mb-4">
                        <h5 class="mb-3">Data Wali</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama_wali" value="{{ old('nama_wali') }}">
                                @error('nama_wali','ortu') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Status</label>
                                <select class="form-control" name="status_wali">
                                    <option value="hidup" @selected(old('status_wali') == 'hidup')>Hidup</option>
                                    <option value="meninggal" @selected(old('status_wali') == 'meninggal')>Meninggal</option>
                                </select>
                                @error('status_wali','ortu') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <select class="form-select" name="kewarganegaraan_wali">
                                    <option value="">-- Pilih --</option>
                                    <option value="WNI" @selected(old('kewarganegaraan_wali') == 'WNI')>WNI</option>
                                    <option value="WNA" @selected(old('kewarganegaraan_wali') == 'WNA')>WNA</option>
                                </select>
                                @error('kewarganegaraan_wali','ortu') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>NIK</label>
                                <input type="text" class="form-control" name="nik_wali" maxlength="16" pattern="\d*" inputmode="numeric" value="{{ old('nik_wali') }}">
                                @error('nik_wali','ortu') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Tempat Lahir</label>
                                <input type="text" class="form-control" name="tempat_lahir_wali" value="{{ old('tempat_lahir_wali') }}">
                                @error('tempat_lahir_wali','ortu') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Tanggal Lahir</label>
                                <input type="date" class="form-control" name="tanggal_lahir_wali" value="{{ old('tanggal_lahir_wali') }}">
                                @error('tanggal_lahir_wali','ortu') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Pendidikan Terakhir</label>
                                <select class="form-control" name="pendidikan_wali">
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
                                <select class="form-control" name="pekerjaan_wali">
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
                                <select class="form-control" name="penghasilan_wali">
                                    <option value="Kurang dari 500.000" @selected(old('penghasilan_wali') == 'Kurang dari 500.000')>Kurang dari 500.000</option>
                                    <option value="500.000 - 1.000.000" @selected(old('penghasilan_wali') == '500.000 - 1.000.000')>500.000 - 1.000.000</option>
                                    <option value="1.000.001 - 2.000.000" @selected(old('penghasilan_wali') == '1.000.001 - 2.000.000')>1.000.001 - 2.000.000</option>
                                    <option value="2.000.001 - 3.000.000" @selected(old('penghasilan_wali') == '2.000.001 - 3.000.000')>2.000.001 - 3.000.000</option>
                                    <option value="3.000.001 - 5.000.000" @selected(old('penghasilan_wali') == '3.000.001 - 5.000.000')>3.000.001 - 5.000.000</option>
                                    <option value="Lebih dari 5.000.000" @selected(old('penghasilan_wali') == 'Lebih dari 5.000.000')>Lebih dari 5.000.000</option>
                                    <option value="Tidak ada" @selected(old('penghasilan_wali') == 'Tidak ada')>Tidak ada</option>
                                </select>
                                @error('penghasilan_wali','ortu') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>No Handphone</label>
                                <input type="text" class="form-control" name="no_hp_wali" maxlength="13" pattern="\d*" inputmode="numeric" value="{{ old('no_hp_wali') }}">
                                @error('no_hp_wali','ortu') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                    </div>


                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Kirim Formulir</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
    <!-- JS Bootstrap (pastikan menambahkan sebelum penutupan body) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.22.1/dist/sweetalert2.all.min.js"></script>
    @if (session('success'))
        
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
                });
                Toast.fire({
                icon: "success",
                title: "Formulir berhasil diunggah!"
            });
        </script>
    @endif
</x-layout>