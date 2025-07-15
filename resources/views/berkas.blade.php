<x-layout>
<div class="row m-3">
    <div class="col-12 col-sm-12 m-auto">
        @if(!$siswa)
            <div class="card border-warning shadow-lg">
                <div class="card-header bg-warning text-dark d-flex align-items-center">
                    <i class="fas fa-exclamation-triangle fa-2x mr-3"></i>
                    <h3 class="card-title mb-0">Lengkapi Data Formulir Terlebih Dahulu</h3>
                </div>
                <div class="card-body text-center">
                    <img src="{{ asset('image/formulir.svg') }}" alt="Isi Formulir" style="max-width:180px;" class="mb-4 mt-2">
                    <h4 class="mb-3 font-weight-bold">Oops! Data Formulir Belum Ditemukan</h4>
                    <p class="mb-4" style="font-size:1.1em;">
                        Sebelum mengunggah berkas, silakan lengkapi <span class="font-weight-bold text-primary">Formulir Pendaftaran</span> terlebih dahulu.<br>
                        Data formulir diperlukan agar proses upload berkas dapat dilakukan.
                    </p>
                    <a href="{{ url('/form') }}" class="btn btn-lg btn-primary px-5 shadow">
                        <i class="fas fa-edit mr-2"></i> Isi Formulir Sekarang
                    </a>
                </div>
            </div>
        @else
            @if($berkas)
                <div class="card border-info shadow-lg">
                    <div class="card-header bg-info text-white d-flex align-items-center">
                        <i class="fas fa-hourglass-half fa-2x mr-3"></i>
                        <h3 class="card-title mb-0">Berkas Sedang Ditinjau</h3>
                    </div>
                    <div class="card-body text-center">
                        <img src="{{ asset('image/reviewing.svg') }}" alt="Berkas Ditinjau" style="max-width:180px;" class="mb-4 mt-2">
                        <h4 class="mb-3 font-weight-bold">Terima kasih telah mengunggah berkas!</h4>
                        <p class="mb-4" style="font-size:1.1em;">
                            Berkas yang Anda unggah sedang dalam proses peninjauan oleh tim admin.<br>
                            Mohon menunggu hingga proses verifikasi selesai.<br>
                            Pantau terus status Pendaftaran Anda melalui halaman ini <strong style="cursor: pointer; color: #007bff;" onclick="window.location.href='{{ url('/timeline') }}'">Pengumuman</strong>.
                        </p>
                        <div class="row justify-content-center mb-3">
                            <div class="col-md-8">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm bg-white">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Berkas</th>
                                                <th>Status</th>
                                                <th>File</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Akta Kelahiran</td>
                                                <td>
                                                    @if($berkas->akta_kelahiran)
                                                        <span class="badge badge-success">Terkirim</span>
                                                    @else
                                                        <span class="badge badge-secondary">Belum Ada</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($berkas->akta_kelahiran)
                                                        <a href="{{ asset('storage/uploads/berkas_' . ($siswa->nisn ?? 'tanpa_nisn') . '/' . $berkas->akta_kelahiran) }}" target="_blank" class="btn btn-sm btn-outline-primary">Lihat</a>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Kartu Keluarga (KK)</td>
                                                <td>
                                                    @if($berkas->kk)
                                                        <span class="badge badge-success">Terkirim</span>
                                                    @else
                                                        <span class="badge badge-secondary">Belum Ada</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($berkas->kk)
                                                        <a href="{{ asset('storage/uploads/berkas_' . ($siswa->nisn ?? 'tanpa_nisn') . '/' . $berkas->kk) }}" target="_blank" class="btn btn-sm btn-outline-primary">Lihat</a>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Ijazah</td>
                                                <td>
                                                    @if($berkas->ijazah)
                                                        <span class="badge badge-success">Terkirim</span>
                                                    @else
                                                        <span class="badge badge-secondary">Belum Ada</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($berkas->ijazah)
                                                        <a href="{{ asset('storage/uploads/berkas_' . ($siswa->nisn ?? 'tanpa_nisn') . '/' . $berkas->ijazah) }}" target="_blank" class="btn btn-sm btn-outline-primary">Lihat</a>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>SKTM</td>
                                                <td>
                                                    @if($berkas->sktm)
                                                        <span class="badge badge-success">Terkirim</span>
                                                    @else
                                                        <span class="badge badge-secondary">Belum Ada</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($berkas->sktm)
                                                        <a href="{{ asset('storage/uploads/berkas_' . ($siswa->nisn ?? 'tanpa_nisn') . '/' . $berkas->sktm) }}" target="_blank" class="btn btn-sm btn-outline-primary">Lihat</a>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>KTP Ayah</td>
                                                <td>
                                                    @if($berkas->ktp_ayah)
                                                        <span class="badge badge-success">Terkirim</span>
                                                    @else
                                                        <span class="badge badge-secondary">Belum Ada</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($berkas->ktp_ayah)
                                                        <a href="{{ asset('storage/uploads/berkas_' . ($siswa->nisn ?? 'tanpa_nisn') . '/' . $berkas->ktp_ayah) }}" target="_blank" class="btn btn-sm btn-outline-primary">Lihat</a>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>KTP Ibu</td>
                                                <td>
                                                    @if($berkas->ktp_ibu)
                                                        <span class="badge badge-success">Terkirim</span>
                                                    @else
                                                        <span class="badge badge-secondary">Belum Ada</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($berkas->ktp_ibu)
                                                        <a href="{{ asset('storage/uploads/berkas_' . ($siswa->nisn ?? 'tanpa_nisn') . '/' . $berkas->ktp_ibu) }}" target="_blank" class="btn btn-sm btn-outline-primary">Lihat</a>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>KTP Wali</td>
                                                <td>
                                                    @if($berkas->ktp_wali)
                                                        <span class="badge badge-success">Terkirim</span>
                                                    @else
                                                        <span class="badge badge-secondary">Belum Ada</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($berkas->ktp_wali)
                                                        <a href="{{ asset('storage/uploads/berkas_' . ($siswa->nisn ?? 'tanpa_nisn') . '/' . $berkas->ktp_wali) }}" target="_blank" class="btn btn-sm btn-outline-primary">Lihat</a>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div>
                            <i class="fas fa-info-circle text-info"></i>
                            <span class="text-muted" style="font-size:0.95em;">
                                Jika ada kesalahan pada berkas, Anda dapat menghubungi admin untuk melakukan perbaikan.
                            </span>
                        </div>
                    </div>
                </div>
            @else
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Upload Berkas</h3>
                    </div>
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <form action="{{ 'upload_berkas' }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <input type="hidden" name="berkas_siswa_id" value="{{ Auth::user()->id }}"> 
                            <div class="form-group">
                                <label for="akta_kelahiran">Akta Kelahiran <span class="text-danger">*</span></label>
                                <input type="file" class="form-control @error('akta_kelahiran') is-invalid @enderror" id="akta_kelahiran" name="akta_kelahiran" accept=".pdf,.jpg,.jpeg,.png">
                                <small class="form-text text-muted">File dapat berupa jpg, jpeg, png, dan pdf</small>
                                @error('akta_kelahiran')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="kk">Kartu Keluarga (KK) <span class="text-danger">*</span></label>
                                <input type="file" class="form-control @error('kk') is-invalid @enderror" id="kk" name="kk" accept=".pdf,.jpg,.jpeg,.png">
                                <small class="form-text text-muted">File dapat berupa jpg, jpeg, png, dan pdf</small>
                                @error('kk')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="ijazah">Ijazah <span class="text-danger">*</span></label>
                                <input type="file" class="form-control @error('ijazah') is-invalid @enderror" id="ijazah" name="ijazah" accept=".pdf,.jpg,.jpeg,.png">
                                <small class="form-text text-muted">File dapat berupa jpg, jpeg, png, dan pdf</small>
                                @error('ijazah')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="sktm">Surat Keterangan Tidak Mampu (SKTM)</label>
                                <input type="file" class="form-control @error('sktm') is-invalid @enderror" id="sktm" name="sktm" accept=".pdf,.jpg,.jpeg,.png">
                                <small class="form-text text-muted">File dapat berupa jpg, jpeg, png, dan pdf</small>
                                @error('sktm')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="ktp_ayah">KTP Ayah <span class="text-danger">*</span></label>
                                <input type="file" class="form-control @error('ktp_ayah') is-invalid @enderror" id="ktp_ayah" name="ktp_ayah" accept=".pdf,.jpg,.jpeg,.png">
                                <small class="form-text text-muted">File dapat berupa jpg, jpeg, png, dan pdf</small>
                                @error('ktp_ayah')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="ktp_ibu">KTP Ibu <span class="text-danger">*</span></label>
                                <input type="file" class="form-control @error('ktp_ibu') is-invalid @enderror" id="ktp_ibu" name="ktp_ibu" accept=".pdf,.jpg,.jpeg,.png">
                                <small class="form-text text-muted">File dapat berupa jpg, jpeg, png, dan pdf</small>
                                @error('ktp_ibu')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="ktp_wali">KTP Wali</label>
                                <input type="file" class="form-control @error('ktp_wali') is-invalid @enderror" id="ktp_wali" name="ktp_wali" accept=".pdf,.jpg,.jpeg,.png">
                                <small class="form-text text-muted">File dapat berupa jpg, jpeg, png, dan pdf</small>
                                @error('ktp_wali')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Upload Berkas</button>
                        </div>
                    </form>
                </div>
            @endif
        @endif
    </div>
</div>
</x-layout>