<x-layout title="Edit Profile">
    <div class="container-fluid col-md-9">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Form Edit Profil</h3>
            </div>

            <form method="POST" action="" enctype="multipart/form-data">
                @csrf

                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', auth()->user()->name) }}" required>
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Alamat Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email', auth()->user()->email) }}" required>
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="profile_photo">Foto Profil (opsional)</label>
                        <input type="file" name="profile_photo" class="form-control-file @error('profile_photo') is-invalid @enderror">
                        @error('profile_photo')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        @if(auth()->user()->profile_photo)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" alt="Foto Profil" class="img-thumbnail" width="120">
                            </div>
                        @endif
                    </div>
                </div>

                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
