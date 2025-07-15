<x-layout title="Pengumuman">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
    <style>
        trix-editor {
            min-height: 200px;
            overflow-y: hidden; /* penting agar tidak muncul scroll internal */
        }
        trix-toolbar [data-trix-button-group="file-tools"] {
            display: none !important;
        }       

    </style>
    <div class="col-md-12">
        @if (auth()->user()->role == 'admin')
            <div class="col-md-10 m-auto">
                <!-- general form elements -->
                <div class="card card-primary {{ $errors->any() ? '' : 'collapsed-card' }} mb-5"> 
                    <div class="card-header">
                        <h3 class="card-title">Tambah Timeline</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas {{ $errors->any() ? 'fa-minus' : 'fa-plus' }}"></i>
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
                                        <div class="invalid-feedback">{{ $errors->first('judul') }}</div>
                                    @enderror
                                </div>
    
                                {{-- Konten --}}
                                <div class="mb-3">
                                    <label for="konten">Isi</label>
                                    <textarea id="konten" name="konten" 
                                        class="form-control summernote @error('konten') is-invalid @enderror" 
                                        rows="6">{{ old('konten') }}</textarea>
                                    
                                    {{-- Hidden input untuk menyimpan gambar sementara --}}
                                    {{-- Gambar akan disimpan di folder temp terlebih dahulu, baru dipindahkan ke folder permanen saat form disubmit --}}
                                    <input type="hidden" id="temp_images" name="temp_images" value="{{ old('temp_images') }}">

                                    @error('konten')
                                        <div class="invalid-feedback d-block">{{ $errors->first('konten') }}</div>
                                    @enderror
                                </div>

    
                                {{-- Icon --}}
                                <div class="mb-3">
                                    <label for="icon">Ikon</label>
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
                                        <div class="invalid-feedback">{{ $errors->first('icon') }}</div>
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
                                        <div class="invalid-feedback">{{ $errors->first('color') }}</div>
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
                            <div class="timeline-footer {{ auth()->user()->role == 'admin' ? '' : 'd-none' }}" >
                                <a class="btn btn-primary btn-sm" href="{{ route('edit_timeline', $timeline->id) }}">Edit</a>
                                <a class="btn btn-danger btn-sm" data-id="{{ $timeline->id }}" onclick="hapus(this)">Hapus</a>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>

        function hapus(hapus) {
            let id = hapus.getAttribute('data-id');
            Swal.fire({
                title: "Tindakan ini tidak dapat dibatalkan.",
                html: 'Apakah anda yakin ingin menghapus timeline ini?',
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Terhapus!",
                        text: "Timeline telah dihapus dengan sukses.",
                        icon: "success",
                        timer: 1500, 
                        timerProgressBar: true,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = '/hapus_timeline/' + id;
                    });
                }

            });
        }
        

        // Summernote textarea
        $(document).ready(function() {
            // Flag untuk menandai form sudah disubmit
            let formSubmitted = false;

            // Event listener untuk form submit
            $('form').on('submit', function() {
                formSubmitted = true;
                // Form akan disubmit, gambar sementara akan dipindahkan ke folder permanen
            });

            // Event listener untuk sebelum halaman unload (refresh/close)
            $(window).on('beforeunload', function() {
                // Jika form belum disubmit dan ada gambar sementara, hapus gambar sementara
                if (!formSubmitted) {
                    let tempImages = $('#temp_images').val();
                    if (tempImages) {
                        // Kirim request untuk menghapus gambar sementara
                        $.ajax({
                            url: '{{ route("timeline.cleanup-temp") }}',
                            type: 'POST',
                            data: {
                                temp_images: tempImages,
                                _token: '{{ csrf_token() }}'
                            },
                            async: false // Pastikan request selesai sebelum halaman unload
                        });
                    }
                }
            });

            $('.summernote').summernote({
                placeholder: 'Tulis isi konten di sini...',
                tabsize: 2,
                height: 200,
                theme: 'monokai',
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture', 'table',]], 
                    ['view', ['fullscreen',]]
                ],
                callbacks: {
                    onImageUpload: function(files) {
                        for (let i = 0; i < files.length; i++) {
                            uploadImage(files[i]);
                        }
                    }
                }
            });

            function uploadImage(file) {
                let data = new FormData();
                data.append("file", file);
                data.append("_token", "{{ csrf_token() }}");

                $.ajax({
                    url: '{{ route("timeline.upload-temp-image") }}',
                    type: 'POST',
                    data: data,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $('.summernote').summernote('insertImage', response.location);
                        
                        // Simpan path gambar sementara ke hidden input
                        let currentTempImages = $('#temp_images').val();
                        let tempImagesArray = currentTempImages ? currentTempImages.split(',') : [];
                        tempImagesArray.push(response.location);
                        $('#temp_images').val(tempImagesArray.join(','));
                    },
                    error: function() {
                        alert('Gagal mengupload gambar');
                    }
                });
            }
        });
    </script>
</x-layout>