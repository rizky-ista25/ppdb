<x-layout>
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
                <button type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#collapseSiswa" aria-expanded="false" aria-controls="collapseSiswa">Data Siswa</button>
                <button type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#collapseAyah" aria-expanded="false" aria-controls="collapseAyah">Data Ayah</button>
                <button type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#collapseIbu" aria-expanded="false" aria-controls="collapseIbu">Data Ibu</button>
            </div>
        </div>

        <div class="accordion" id="accordionExample">
            <div class="collapse {{ $errors->any() ? 'show' : '' }}" id="collapseSiswa" data-bs-parent="#accordionExample">
                <form method="POST" action="{{ route('upload') }}" enctype="multipart/form-data">
                    @csrf

                    {{-- Menampilkan semua error secara global di atas form --}}
                    {{-- @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif --}}

                    <div class="section-title">Data Siswa</div>

                    <div>
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" value="{{ auth()->user()->name }}" readonly>
                    </div>

                    <div>
                        <label>Email</label>
                        <input type="email" name="email" value="{{ auth()->user()->email }}" readonly>
                    </div>

                    <div style="font-size: 0.9rem; color: #555; margin-top: 8px; margin-bottom: 16px;">
                        <em>Jika ingin mengubah <strong>nama</strong> atau <strong>email</strong>, silakan lakukan melalui <a href="/">halaman ini</a>.</em>
                    </div>


                    <div>
                        <label>NIK</label>
                        <input type="text" name="nik" maxlength="16" pattern="\d*" inputmode="numeric" value="{{ old('nik') }}">
                        @error('nik') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label>NISN</label>
                        <input type="text" name="nisn" maxlength="10" pattern="\d*" inputmode="numeric" value="{{ old('nisn') }}">
                        @error('nisn') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label>Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}">
                        @error('tempat_lahir') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                        @error('tanggal_lahir') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label>Agama</label>
                        <input type="text" name="agama" value="{{ old('agama') }}">
                        @error('agama') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin">
                            <option value="laki-laki" {{ old('jenis_kelamin') == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="perempuan" {{ old('jenis_kelamin') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label>Jumlah Saudara</label>
                        <input type="number" name="jumlah_sodara" value="{{ old('jumlah_sodara') }}">
                        @error('jumlah_sodara') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label>Anak Ke</label>
                        <input type="number" name="anakke" value="{{ old('anakke') }}">
                        @error('anakke') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label>Hobi</label>
                        <input type="text" name="hobi" value="{{ old('hobi') }}">
                        @error('hobi') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label>Cita-Cita</label>
                        <input type="text" name="cita_cita" value="{{ old('cita_cita') }}">
                        @error('cita_cita') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label>No HP</label>
                        <input type="text" name="no_hp" value="{{ old('no_hp') }}">
                        @error('no_hp') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label>Kebutuhan Disabilitas</label>
                        <select name="kebutuhan_disabillitas">
                            <option value="tidak" {{ old('kebutuhan_disabillitas') == 'tidak' ? 'selected' : '' }}>Tidak Ada</option>
                            <option value="ada" {{ old('kebutuhan_disabillitas') == 'ada' ? 'selected' : '' }}>Ada</option>
                        </select>
                        @error('kebutuhan_disabillitas') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label>Kebutuhan Khusus</label>
                        <select name="kebutuhan_khusus">
                            <option value="tidak" {{ old('kebutuhan_khusus') == 'tidak' ? 'selected' : '' }}>Tidak Ada</option>
                            <option value="ada" {{ old('kebutuhan_khusus') == 'ada' ? 'selected' : '' }}>Ada</option>
                        </select>
                        @error('kebutuhan_khusus') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label>Alamat</label>
                        <textarea name="alamat">{{ old('alamat') }}</textarea>
                        @error('alamat') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label>Status Tempat Tinggal</label>
                        <select name="status_tempat_tinggal">
                            @foreach(['BERSAMA ORANG TUA','WALI','ASRAMA','KOST','PANTI ASUHAN','LAINNYA'] as $status)
                                <option value="{{ $status }}" {{ old('status_tempat_tinggal') == $status ? 'selected' : '' }}>{{ $status }}</option>
                            @endforeach
                        </select>
                        @error('status_tempat_tinggal') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label>Jarak Tempat Tinggal</label>
                        <select name="jarak_tempat_tinggal">
                            @foreach(['KURANG DARI 1 KM','ANTARA 1 3 KM','ANTARA 3 5 KM','ANTARA 5 10 KM','LEBIH DARI 10 KM'] as $jarak)
                                <option value="{{ $jarak }}" {{ old('jarak_tempat_tinggal') == $jarak ? 'selected' : '' }}>{{ $jarak }}</option>
                            @endforeach
                        </select>
                        @error('jarak_tempat_tinggal') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label>Waktu Tempuh</label>
                        <select name="waktu_tempuh">
                            @foreach(['KURANG DARI 15 MENIT','ANTARA 15 30 MENIT','ANTARA 30 60 MENIT','LEBIH DARI 60 MENIT'] as $waktu)
                                <option value="{{ $waktu }}" {{ old('waktu_tempuh') == $waktu ? 'selected' : '' }}>{{ $waktu }}</option>
                            @endforeach
                        </select>
                        @error('waktu_tempuh') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label>Transportasi</label>
                        <select name="transportasi">
                            @foreach(['JALAN KAKI','SEPEDA','MOTOR','MOBIL PRIBADI','ANGKOT','BUS','KERETA','LAINNYA'] as $trans)
                                <option value="{{ $trans }}" {{ old('transportasi') == $trans ? 'selected' : '' }}>{{ $trans }}</option>
                            @endforeach
                        </select>
                        @error('transportasi') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <button type="submit" class="submit-btn">Kirim Formulir</button>
                    </div>
                </form>

            </div>
            <div class="collapse" id="collapseAyah" data-bs-parent="#accordionExample">
                <form method="POST" action="/upload" enctype="multipart/form-data">
                    @csrf

                    <div class="section-title">Data Ayah</div>
                    <div>
                        <div>
                            <label>NIK Ayah</label>
                            <input type="text" name="nik_ayah">
                        </div>

                        <div>
                            <label>Nama Lengkap Ayah</label>
                            <input type="text" name="nama_ayah" required>
                        </div>

                        <div>
                            <label>Tempat Lahir Ayah</label>
                            <input type="text" name="tempat_lahir_ayah" required>
                        </div>

                        <div>
                            <label>Tanggal Lahir Ayah</label>
                            <input type="date" name="tanggal_lahir_ayah" required>
                        </div>

                        <div>
                            <label>Status Ayah</label>
                            <select name="status_ayah" required>
                                <option value="masih hidup">Masih Hidup</option>
                                <option value="meninggal dunia">Meninggal Dunia</option>
                            </select>
                        </div>

                        <div>
                            <label>Pendidikan Terakhir Ayah</label>
                            <select name="pendidikan_ayah" required>
                                <option value="sd sederajat">Sd sederajat</option>
                                <option value="smp sederajat">Smp sederajat</option>
                                <option value="sma sederajat">Sma sederajat</option>
                                <option value="s1">S1</option>
                                <option value="s2">S2</option>
                                <option value="s3">S3</option>
                            </select>
                        </div>

                        <div>
                            <label>Pekerjaan Ayah</label>
                            <select name="pekerjaan_ayah" required>
                                <option value="TIDAK BEKERJA">TIDAK BEKERJA</option>
                                <option value="NELAYAN">NELAYAN</option>
                                <option value="PETANI">PETANI</option>
                                <option value="PETERNAK">PETERNAK</option>
                                <option value="PNS TNI POLRI">PNS TNI POLRI</option>
                                <option value="KARYAWAN SWASTA">KARYAWAN SWASTA</option>
                                <option value="PEDAGANG KECIL">PEDAGANG KECIL</option>
                                <option value="PEDAGANG BESAR">PEDAGANG BESAR</option>
                                <option value="WIRASWASTA">WIRASWASTA</option>
                                <option value="WIRAUSAHA">WIRAUSAHA</option>
                                <option value="BURUH">BURUH</option>
                                <option value="PENSIUNAN">PENSIUNAN</option>
                                <option value="LAINNYA">LAINNYA</option>
                            </select>
                        </div>

                        <div>
                            <label>Domisili Ayah</label>
                            <select name="domisili_ayah" required>
                                <option value="dalam negeri">Dalam Negeri</option>
                                <option value="luar negeri">Luar Negeri</option>
                            </select>
                        </div>

                        <div>
                            <label>No HP Ayah</label>
                            <input type="text" name="no_hp_ayah">
                        </div>

                        <div>
                            <label>Penghasilan Ayah</label>
                            <select name="penghasilan_ayah" required>
                                <option value="KURANG DARI 500.000">KURANG DARI 500.000</option>
                                <option value="500.000 - 999.000">500.000 - 999.000</option>
                                <option value="1 JUTA - 10 JUTA">1 JUTA - 10 JUTA</option>
                                <option value="10 JUTA - 20 JUTA">10 JUTA - 20 JUTA</option>
                                <option value="LEBIH DARI 20 JUTA">LEBIH DARI 20 JUTA</option>
                                <option value="TIDAK ADA PENGHASILAN">TIDAK ADA PENGHASILAN</option>
                            </select>
                        </div>

                        <div>
                            <label>Alamat Ayah</label>
                            <textarea name="alamat_ayah" required></textarea>
                        </div>

                        <div>
                            <label>Status Tempat Tinggal Ayah</label>
                            <select name="status_tempat_tinggal_ayah" required>
                                <option value="milik sendiri">Milik Sendiri</option>
                                <option value="sewa">Sewa</option>
                            </select>
                        </div>

                        <div>
                            <button type="submit" class="submit-btn">Kirim Formulir</button>
                        </div>
                    </div>
                </form>   
            </div>
            <div class="collapse" id="collapseIbu" data-bs-parent="#accordionExample">
                <form method="POST" action="/upload" enctype="multipart/form-data">
                    @csrf

                    <div class="section-title">Data Ibu</div>
                    <div>
                        <div>
                            <label>NIK Ibu</label>
                            <input type="text" name="nik_ibu">
                        </div>

                        <div>
                            <label>Nama Lengkap Ibu</label>
                            <input type="text" name="nama_ibu" required>
                        </div>

                        <div>
                            <label>Tempat Lahir Ibu</label>
                            <input type="text" name="tempat_lahir_ibu" required>
                        </div>

                        <div>
                            <label>Tanggal Lahir Ibu</label>
                            <input type="date" name="tanggal_lahir_ibu" required>
                        </div>

                        <div>
                            <label>Status Ibu</label>
                            <select name="status_ibu" required>
                                <option value="masih hidup">Masih Hidup</option>
                                <option value="meninggal dunia">Meninggal Dunia</option>
                            </select>
                        </div>

                        <div>
                            <label>Pendidikan Terakhir Ibu</label>
                            <select name="pendidikan_ibu" required>
                                <option value="sd sederajat">Sd sederajat</option>
                                <option value="smp sederajat">Smp sederajat</option>
                                <option value="sma sederajat">Sma sederajat</option>
                                <option value="s1">S1</option>
                                <option value="s2">S2</option>
                                <option value="s3">S3</option>
                            </select>
                        </div>

                        <div>
                            <label>Pekerjaan Ibu</label>
                            <select name="pekerjaan_ibu" required>
                                <option value="TIDAK BEKERJA">TIDAK BEKERJA</option>
                                <option value="NELAYAN">NELAYAN</option>
                                <option value="PETANI">PETANI</option>
                                <option value="PETERNAK">PETERNAK</option>
                                <option value="PNS TNI POLRI">PNS TNI POLRI</option>
                                <option value="KARYAWAN SWASTA">KARYAWAN SWASTA</option>
                                <option value="PEDAGANG KECIL">PEDAGANG KECIL</option>
                                <option value="PEDAGANG BESAR">PEDAGANG BESAR</option>
                                <option value="WIRASWASTA">WIRASWASTA</option>
                                <option value="WIRAUSAHA">WIRAUSAHA</option>
                                <option value="BURUH">BURUH</option>
                                <option value="PENSIUNAN">PENSIUNAN</option>
                                <option value="LAINNYA">LAINNYA</option>
                            </select>
                        </div>

                        <div>
                            <label>Domisili Ibu</label>
                            <select name="domisili_ibu" required>
                                <option value="dalam negeri">Dalam Negeri</option>
                                <option value="luar negeri">Luar Negeri</option>
                            </select>
                        </div>

                        <div>
                            <label>No HP Ibu</label>
                            <input type="text" name="no_hp_ibu">
                        </div>

                        <div>
                            <label>Penghasilan Ibu</label>
                            <select name="penghasilan_ibu" required>
                                <option value="KURANG DARI 500.000">KURANG DARI 500.000</option>
                                <option value="500.000 - 999.000">500.000 - 999.000</option>
                                <option value="1 JUTA - 10 JUTA">1 JUTA - 10 JUTA</option>
                                <option value="10 JUTA - 20 JUTA">10 JUTA - 20 JUTA</option>
                                <option value="LEBIH DARI 20 JUTA">LEBIH DARI 20 JUTA</option>
                                <option value="TIDAK ADA PENGHASILAN">TIDAK ADA PENGHASILAN</option>
                            </select>
                        </div>

                        <div>
                            <label>Alamat Ibu</label>
                            <textarea name="alamat_ibu" required></textarea>
                        </div>

                        <div>
                            <label>Status Tempat Tinggal Ibu</label>
                            <select name="status_tempat_tinggal_ibu" required>
                                <option value="milik sendiri">Milik Sendiri</option>
                                <option value="sewa">Sewa</option>
                            </select>
                        </div>

                        <div>
                            <button type="submit" class="submit-btn">Kirim Formulir</button>
                        </div>
                    </div>
                </form>
  
            </div>
        </div>
    </div>
    <!-- JS Bootstrap (pastikan menambahkan sebelum penutupan body) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</x-layout>