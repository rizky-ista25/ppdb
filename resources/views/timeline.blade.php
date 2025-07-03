<x-layout>
    <div class="col-md-12">
        @if (auth()->user()->role == 'admin')
            <div class="col-md-10 m-auto">
                <!-- general form elements -->
                <div class="card card-primary collapsed-card mb-5"> 
                    <div class="card-header">
                        <h3 class="card-title">Tambah Timeline</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- form start -->
                    <div class="card-body">

                        <form method="POST" action="{{ route('input_timeline') }}">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @csrf
                            <div class="card-body">
                                {{-- Judul --}}
                                <div class="mb-3">
                                    <label for="judul">Judul</label>
                                    <input type="text" id="judul" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul') }}">
                                    @error('judul')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
    
                                {{-- Konten --}}
                                <div class="mb-3">
                                    <label for="konten">Isi</label>
                                    <textarea id="konten" name="konten" class="form-control @error('konten') is-invalid @enderror" rows="4">{{ old('konten') }}</textarea>
                                    @error('konten')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
    
                                {{-- Icon --}}
                                <div class="mb-3">
                                    <label for="icon">Icon (Font Awesome Class)</label>
                                    <select id="icon" name="icon" class="form-control @error('icon') is-invalid @enderror">
                                        <option value="">-- Pilih Ikon --</option>
                                        <option value="fas fa-bullhorn" {{ old('icon') == 'fas fa-bullhorn' ? 'selected' : '' }}>📢 Pendaftaran Dibuka</option>
                                        <option value="fas fa-user-plus" {{ old('icon') == 'fas fa-user-plus' ? 'selected' : '' }}>👤 Akun Baru</option>
                                        <option value="fas fa-check-circle" {{ old('icon') == 'fas fa-check-circle' ? 'selected' : '' }}>✔️ Verifikasi Berhasil</option>
                                        <option value="fas fa-times-circle" {{ old('icon') == 'fas fa-times-circle' ? 'selected' : '' }}>❌ Verifikasi Ditolak</option>
                                        <option value="fas fa-calendar-alt" {{ old('icon') == 'fas fa-calendar-alt' ? 'selected' : '' }}>🗓️ Jadwal</option>
                                        <option value="fas fa-envelope" {{ old('icon') == 'fas fa-envelope' ? 'selected' : '' }}>✉️ Pengumuman</option>
                                        <option value="fas fa-user-graduate" {{ old('icon') == 'fas fa-user-graduate' ? 'selected' : '' }}>🎓 Dinyatakan Lulus</option>
                                    </select>
                                    @error('icon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
    
                                {{-- Warna Latar Ikon --}}
                                <div class="mb-3">
                                    <label for="color">Warna Latar Ikon</label>
                                    <select id="color" name="color" class="form-control @error('color') is-invalid @enderror">
                                        <option value="">-- Pilih Warna --</option>
                                        <option value="bg-blue" {{ old('color') == 'bg-blue' ? 'selected' : '' }}>Biru (Informasi)</option>
                                        <option value="bg-green" {{ old('color') == 'bg-green' ? 'selected' : '' }}>Hijau (Berhasil)</option>
                                        <option value="bg-yellow" {{ old('color') == 'bg-yellow' ? 'selected' : '' }}>Kuning (Peringatan)</option>
                                        <option value="bg-red" {{ old('color') == 'bg-red' ? 'selected' : '' }}>Merah (Gagal)</option>
                                        <option value="bg-purple" {{ old('color') == 'bg-purple' ? 'selected' : '' }}>Ungu (Ujian)</option>
                                        <option value="bg-gray" {{ old('color') == 'bg-gray' ? 'selected' : '' }}>Abu-abu (Netral)</option>
                                    </select>
                                    @error('color')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
    
                                {{-- Submit --}}
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
    
                            </div>
                        </form>
                    </div>

                </div>
            </div>
            @endif

        <div class="timeline">
            @if($timelines->pluck('judul')->filter()->isEmpty())
                <!-- Timeline Kosong -->
                <div class="text-center my-5">
                    <i class="fas fa-history fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">Belum ada aktivitas yang tercatat.</h4>
                    <p class="text-muted">Silakan kembali nanti untuk melihat informasi terbaru di sini.</p>
                </div>

                <!-- Penutup timeline (icon jam) -->
                <div>
                    <i class="fas fa-clock bg-gray"></i>
                </div>
            @else
                {{-- LOOP TIMELINE --}}
                @foreach($timelines as $timeline)
                    <div class="time-label">
                        <span class="{{ $timeline->color }}">{{ \Carbon\Carbon::parse($timeline->tanggal)->translatedFormat('d M Y') }}</span>
                    </div>

                    <div>
                        <i class="{{ $timeline->icon ?? 'fas fa-info-circle' }} {{ $timeline->color ?? 'bg-primary' }}"></i>
                        <div class="timeline-item">
                            <span class="time">
                                <i class="fas fa-clock"></i>
                                {{ \Carbon\Carbon::parse($timeline->waktu)->format('H:i') }}
                            </span>
                            <h3 class="timeline-header">
                                {!! $timeline->judul !!}
                            </h3>
                            <div class="timeline-body">
                                {!! $timeline->konten !!}
                            </div>
                        </div>
                    </div>
                @endforeach

                <div>
                    <i class="fas fa-clock bg-gray"></i>
                </div>
            @endif

        </div>
    </div>
</x-layout>


{{-- form timeline --}}

{{-- | Warna Class | Tujuan / Kesan             | --}}
{{-- | ----------- | -------------------------- | --}}
{{-- | `bg-blue`   | Informasi umum             | --}}
{{-- | `bg-green`  | Berhasil / diterima        | --}}
{{-- | `bg-red`    | Error / ditolak            | --}}
{{-- | `bg-yellow` | Peringatan / menunggu aksi | --}}
{{-- | `bg-purple` | Aktivitas spesial / ujian  | --}}
{{-- | `bg-gray`   | Tidak aktif / selesai      | --}}

{{-- <x-layout>
    <h2>Buat Timeline Baru</h2>

    <form method="POST" action="{{ route('timeline.store') }}">
        @csrf

        <div>
            <label for="tanggal">Tanggal</label>
            <input type="date" id="tanggal" name="tanggal" class="form-control" required>
        </div>

        <div>
            <label for="waktu">Waktu</label>
            <input type="time" id="waktu" name="waktu" class="form-control" required>
        </div>

        <div>
            <label for="judul">Judul</label>
            <input type="text" id="judul" name="judul" class="form-control" required>
        </div>

        <div>
            <label for="isi">Isi</label>
            <textarea id="isi" name="isi" class="form-control" rows="4"></textarea>
        </div>

        <div>
            <label for="ikon">Ikon (Font Awesome Class)</label>
            <select id="ikon" name="ikon" class="form-control" required>
                <option value="fas fa-bullhorn">📢 Pendaftaran Dibuka</option>
                <option value="fas fa-user-plus">👤 Akun Baru</option>
                <option value="fas fa-check-circle">✔️ Verifikasi Berhasil</option>
                <option value="fas fa-times-circle">❌ Verifikasi Ditolak</option>
                <option value="fas fa-calendar-alt">🗓️ Jadwal</option>
                <option value="fas fa-envelope">✉️ Pengumuman</option>
                <option value="fas fa-user-graduate">🎓 Dinyatakan Lulus</option>
            </select>
        </div>

        <div>
            <label for="warna_bg">Warna Latar Ikon</label>
            <select id="warna_bg" name="warna_bg" class="form-control" required>
                <option value="bg-blue">Biru (Informasi)</option>
                <option value="bg-green">Hijau (Berhasil)</option>
                <option value="bg-yellow">Kuning (Peringatan)</option>
                <option value="bg-red">Merah (Gagal)</option>
                <option value="bg-purple">Ungu (Ujian)</option>
                <option value="bg-gray">Abu-abu (Netral)</option>
            </select>
        </div>

        <div>
            <label for="link_aksi_1">Tombol Aksi 1 (opsional)</label>
            <input type="text" id="link_aksi_1" name="link_aksi_1" class="form-control" placeholder="Contoh: Lihat Detail">
        </div>

        <div>
            <label for="link_aksi_2">Tombol Aksi 2 (opsional)</label>
            <input type="text" id="link_aksi_2" name="link_aksi_2" class="form-control" placeholder="Contoh: Hapus">
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Simpan Timeline</button>
        </div>
    </form>
</x-layout> --}}
