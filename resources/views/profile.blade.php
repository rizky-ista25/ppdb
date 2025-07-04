<x-layout title="Profile">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profil Saya</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Edit Profil
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card card-info card-outline">
            <div class="card-body d-flex align-items-center">
                {{-- Foto Profil --}}
                <div class="mr-4 text-center">
                    @if(auth()->user()->profile_photo)
                        <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" 
                             alt="Foto Profil" 
                             class="img-circle elevation-2" 
                             style="width: 120px; height: 120px; object-fit: cover;">
                    @else
                        <img src="{{ asset('image/icon-quantum.png') }}" 
                             alt="Default Foto Profil" 
                             class="img-circle elevation-2" 
                             style="width: 120px; height: 120px; object-fit: cover;">
                    @endif
                </div>

                {{-- Detail User --}}
                <div>
                    <h4 class="mb-1">{{ auth()->user()->name }}</h4>
                    <p class="mb-1 text-muted"><i class="fas fa-envelope"></i> {{ auth()->user()->email }}</p>
                    <p class="mb-0 text-muted"><i class="fas fa-calendar-alt"></i> Bergabung sejak {{ auth()->user()->created_at->format('d M Y') }}</p>
                </div>
            </div>
        </div>
    </div>
</x-layout>
