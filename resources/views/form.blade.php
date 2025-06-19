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

        <div class="collapse" id="collapseSiswa">
            <form method="POST" action="/upload" enctype="multipart/form-data">
                @csrf
                
                <div class="section-title">Data Siswa</div>
                    <div>
        
                        <div>
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" required>
                        </div>
            
                        <div>
                            <label>NIK</label>
                            <input type="text" name="nik" required>
                        </div>
            
                        <div>
                            <label>NISN</label>
                            <input type="text" name="nisn">
                        </div>
            
                        <div>
                            <label>Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" required>
                        </div>
            
                        <div>
                            <label>Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" required>
                        </div>
            
                        <div>
                            <label>Agama</label>
                            <input type="text" name="agama" required>
                        </div>
            
                        <div>
                            <label>Jenis Kelamin</label>
                            <select name="jenis_kelamin" required>
                                <option value="laki-laki">Laki-laki</option>
                                <option value="perempuan">Perempuan</option>
                            </select>
                        </div>
            
                        <div>
                            <label>Jumlah Saudara</label>
                            <input type="number" name="jumlah_sodara" required>
                        </div>
            
                        <div>
                            <label>Anak Ke</label>
                            <input type="number" name="anakke" required>
                        </div>
            
                        <div>
                            <label>Hobi</label>
                            <input type="text" name="hobi" required>
                        </div>
            
                        <div>
                            <label>Cita-Cita</label>
                            <input type="text" name="cita_cita" required>
                        </div>
            
                        <div>
                            <label>No HP</label>
                            <input type="text" name="no_hp" required>
                        </div>
            
                        <div>
                            <label>Email</label>
                            <input type="email" name="email" required>
                        </div>
            
                        <div>
                            <label>Kebutuhan Disabilitas</label>
                            <select name="kebutuhan_disabillitas" required>
                                <option value="ada">Ada</option>
                                <option value="tidak ada">Tidak Ada</option>
                            </select>
                        </div>
            
                        <div>
                            <label>Kebutuhan Khusus</label>
                            <select name="kebutuhan_khusus" required>
                                <option value="ada">Ada</option>
                                <option value="tidak ada">Tidak Ada</option>
                            </select>
                        </div>
            
                        <div>
                            <label>Alamat</label>
                            <textarea name="alamat" required></textarea>
                        </div>
            
                        <div>
                            <label>Status Tempat Tinggal</label>
                            <select name="status_tempat_tinggal" required>
                                @foreach(['BERSAMA ORANG TUA','WALI','ASRAMA','KOST','PANTI ASUHAN','LAINNYA'] as $status)
                                    <option value="{{ $status }}">{{ $status }}</option>
                                @endforeach
                            </select>
                        </div>
            
                        <div>
                            <label>Jarak Tempat Tinggal</label>
                            <select name="jarak_tempat_tinggal" required>
                                @foreach(['KURANG DARI 1 KM','ANTARA 1 3 KM','ANTARA 3 5 KM','ANTARA 5 10 KM','LEBIH DARI 10 KM'] as $jarak)
                                    <option value="{{ $jarak }}">{{ $jarak }}</option>
                                @endforeach
                            </select>
                        </div>
            
                        <div>
                            <label>Waktu Tempuh</label>
                            <select name="waktu_tempuh" required>
                                @foreach(['KURANG DARI 15 MENIT','ANTARA 15 30 MENIT','ANTARA 30 60 MENIT','LEBIH DARI 60 MENIT'] as $waktu)
                                    <option value="{{ $waktu }}">{{ $waktu }}</option>
                                @endforeach
                            </select>
                        </div>
            
                        <div>
                            <label>Transportasi</label>
                            <select name="transportasi" required>
                                @foreach(['JALAN KAKI','SEPEDA','MOTOR','MOBIL PRIBADI','ANGKOT','BUS','KERETA','LAINNYA'] as $trans)
                                    <option value="{{ $trans }}">{{ $trans }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <button type="submit" class="submit-btn">Kirim Formulir</button>
                        </div>
                    </div>
            </form>
        </div>
        <div class="collapse" id="collapseAyah">
            <form method="POST" action="/upload" enctype="multipart/form-data">
                @csrf
                
                <div class="section-title">Data Ayah</div>
                    <div>
        
                        <div>
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" required>
                        </div>
            
                        <div>
                            <label>NIK</label>
                            <input type="text" name="nik" required>
                        </div>
            
                        <div>
                            <label>NISN</label>
                            <input type="text" name="nisn">
                        </div>
            
                        <div>
                            <label>Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" required>
                        </div>
            
                        <div>
                            <label>Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" required>
                        </div>
            
                        <div>
                            <label>Agama</label>
                            <input type="text" name="agama" required>
                        </div>
            
                        <div>
                            <label>Jenis Kelamin</label>
                            <select name="jenis_kelamin" required>
                                <option value="laki-laki">Laki-laki</option>
                                <option value="perempuan">Perempuan</option>
                            </select>
                        </div>
            
                        <div>
                            <label>Jumlah Saudara</label>
                            <input type="number" name="jumlah_sodara" required>
                        </div>
            
                        <div>
                            <label>Anak Ke</label>
                            <input type="number" name="anakke" required>
                        </div>
            
                        <div>
                            <label>Hobi</label>
                            <input type="text" name="hobi" required>
                        </div>
            
                        <div>
                            <label>Cita-Cita</label>
                            <input type="text" name="cita_cita" required>
                        </div>
            
                        <div>
                            <label>No HP</label>
                            <input type="text" name="no_hp" required>
                        </div>
            
                        <div>
                            <label>Email</label>
                            <input type="email" name="email" required>
                        </div>
            
                        <div>
                            <label>Kebutuhan Disabilitas</label>
                            <select name="kebutuhan_disabillitas" required>
                                <option value="ada">Ada</option>
                                <option value="tidak ada">Tidak Ada</option>
                            </select>
                        </div>
            
                        <div>
                            <label>Kebutuhan Khusus</label>
                            <select name="kebutuhan_khusus" required>
                                <option value="ada">Ada</option>
                                <option value="tidak ada">Tidak Ada</option>
                            </select>
                        </div>
            
                        <div>
                            <label>Alamat</label>
                            <textarea name="alamat" required></textarea>
                        </div>
            
                        <div>
                            <label>Status Tempat Tinggal</label>
                            <select name="status_tempat_tinggal" required>
                                @foreach(['BERSAMA ORANG TUA','WALI','ASRAMA','KOST','PANTI ASUHAN','LAINNYA'] as $status)
                                    <option value="{{ $status }}">{{ $status }}</option>
                                @endforeach
                            </select>
                        </div>
            
                        <div>
                            <label>Jarak Tempat Tinggal</label>
                            <select name="jarak_tempat_tinggal" required>
                                @foreach(['KURANG DARI 1 KM','ANTARA 1 3 KM','ANTARA 3 5 KM','ANTARA 5 10 KM','LEBIH DARI 10 KM'] as $jarak)
                                    <option value="{{ $jarak }}">{{ $jarak }}</option>
                                @endforeach
                            </select>
                        </div>
            
                        <div>
                            <label>Waktu Tempuh</label>
                            <select name="waktu_tempuh" required>
                                @foreach(['KURANG DARI 15 MENIT','ANTARA 15 30 MENIT','ANTARA 30 60 MENIT','LEBIH DARI 60 MENIT'] as $waktu)
                                    <option value="{{ $waktu }}">{{ $waktu }}</option>
                                @endforeach
                            </select>
                        </div>
            
                        <div>
                            <label>Transportasi</label>
                            <select name="transportasi" required>
                                @foreach(['JALAN KAKI','SEPEDA','MOTOR','MOBIL PRIBADI','ANGKOT','BUS','KERETA','LAINNYA'] as $trans)
                                    <option value="{{ $trans }}">{{ $trans }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <button type="submit" class="submit-btn">Kirim Formulir</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
    <!-- JS Bootstrap (pastikan menambahkan sebelum penutupan body) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</x-layout>