<x-layout>
    <h1>hai</h1>
    <div class="col-md-12">
        <!-- The time line -->
        <div class="timeline">
            <!-- timeline time label -->
            <div class="time-label">
                <span class="bg-red">10 Feb. 2014</span>
            </div>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <div>
                <i class="fas fa-envelope bg-blue"></i>
            <div class="timeline-item">
                <span class="time"><i class="fas fa-clock"></i> 12:05</span>
                <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                <div class="timeline-body">
                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                    weebly ning heekya handango imeem plugg dopplr jibjab, movity
                    jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                    quora plaxo ideeli hulu weebly balihoo...
                </div>
                <div class="timeline-footer">
                <a class="btn btn-primary btn-sm">Read more</a>
                <a class="btn btn-danger btn-sm">Delete</a>
                </div>
            </div>
            </div>
            <!-- END timeline item -->
            <!-- timeline item -->
            <div>
                <i class="fas fa-user bg-green"></i>
            <div class="timeline-item">
                <span class="time"><i class="fas fa-clock"></i> 5 mins ago</span>
                <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request</h3>
            </div>
            </div>
            <!-- END timeline item -->
            <!-- timeline item -->
            <div>
                <i class="fas fa-comments bg-yellow"></i>
            <div class="timeline-item">
                <span class="time"><i class="fas fa-clock"></i> 27 mins ago</span>
                <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>
                <div class="timeline-body">
                    Take me to your leader!
                    Switzerland is small and neutral!
                    We are more like Germany, ambitious and misunderstood!
                </div>
                <div class="timeline-footer">
                    <a class="btn btn-warning btn-sm">View comment</a>
                </div>
            </div>
            </div>
            <div>
                <i class="fas fa-clock bg-gray"></i>
            </div>
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
