<x-layout title="Edit Timeline">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
    <style>
        trix-editor {
            min-height: 200px;
            overflow-y: hidden;
        }
        trix-toolbar [data-trix-button-group="file-tools"] {
            display: none !important;
        }
    </style>
    <div class="col-md-10 m-auto">
        <div class="card card-primary mb-5">
            <div class="card-header">
                <h3 class="card-title">Edit Timeline</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('update_timeline', $timeline->id) }}">
                    @csrf
                    <div class="card-body">
                        {{-- Judul --}}
                        <div class="mb-3">
                            <label for="judul">Judul</label>
                            <input type="text" id="judul" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul', $timeline->judul) }}">
                            @error('judul')
                                <div class="invalid-feedback">{{ $errors->first('judul') }}</div>
                            @enderror
                        </div>

                        {{-- Konten --}}
                        <div class="mb-3">
                            <label for="konten">Isi</label>
                            <textarea id="konten" name="konten" class="form-control summernote @error('konten') is-invalid @enderror" rows="6">{{ old('konten', $timeline->konten) }}</textarea>
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
                                <option value="fas fa-bullhorn" {{ old('icon', $timeline->icon) == 'fas fa-bullhorn' ? 'selected' : '' }}>📢 Pendaftaran Dibuka</option>
                                <option value="fas fa-user-plus" {{ old('icon', $timeline->icon) == 'fas fa-user-plus' ? 'selected' : '' }}>👤 Akun Baru</option>
                                <option value="fas fa-check-circle" {{ old('icon', $timeline->icon) == 'fas fa-check-circle' ? 'selected' : '' }}>✔️ Verifikasi Berhasil</option>
                                <option value="fas fa-times-circle" {{ old('icon', $timeline->icon) == 'fas fa-times-circle' ? 'selected' : '' }}>❌ Verifikasi Ditolak</option>
                                <option value="fas fa-calendar-alt" {{ old('icon', $timeline->icon) == 'fas fa-calendar-alt' ? 'selected' : '' }}>🗓️ Jadwal</option>
                                <option value="fas fa-envelope" {{ old('icon', $timeline->icon) == 'fas fa-envelope' ? 'selected' : '' }}>✉️ Pengumuman</option>
                                <option value="fas fa-user-graduate" {{ old('icon', $timeline->icon) == 'fas fa-user-graduate' ? 'selected' : '' }}>🎓 Dinyatakan Lulus</option>
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
                                <option value="bg-blue" {{ old('color', $timeline->color) == 'bg-blue' ? 'selected' : '' }}>Biru (Informasi)</option>
                                <option value="bg-green" {{ old('color', $timeline->color) == 'bg-green' ? 'selected' : '' }}>Hijau (Berhasil)</option>
                                <option value="bg-yellow" {{ old('color', $timeline->color) == 'bg-yellow' ? 'selected' : '' }}>Kuning (Peringatan)</option>
                                <option value="bg-red" {{ old('color', $timeline->color) == 'bg-red' ? 'selected' : '' }}>Merah (Gagal)</option>
                                <option value="bg-purple" {{ old('color', $timeline->color) == 'bg-purple' ? 'selected' : '' }}>Ungu (Ujian)</option>
                                <option value="bg-gray" {{ old('color', $timeline->color) == 'bg-gray' ? 'selected' : '' }}>Abu-abu (Netral)</option>
                            </select>
                            @error('color')
                                <div class="invalid-feedback">{{ $errors->first('color') }}</div>
                            @enderror
                        </div>

                        {{-- Submit --}}
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('timeline') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Summernote textarea
        $(document).ready(function() {
            let formSubmitted = false;
            $('form').on('submit', function() {
                formSubmitted = true;
            });
            $(window).on('beforeunload', function() {
                if (!formSubmitted) {
                    let tempImages = $('#temp_images').val();
                    if (tempImages) {
                        $.ajax({
                            url: '{{ route("timeline.cleanup-temp") }}',
                            type: 'POST',
                            data: {
                                temp_images: tempImages,
                                _token: '{{ csrf_token() }}'
                            },
                            async: false
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