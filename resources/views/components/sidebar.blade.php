<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="/" class="brand-link">
    <img src="{{ asset('image/quantum.jpg') }}" alt="Logo Quantum" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span style="font-size: 0.8em" class="brand-text font-weight-light">PPDB Quantum IDEA</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    @if(Auth::check())
    <!-- Sidebar user panel -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('image/icon-quantum.png') }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
      </div>
    </div>
    @endif

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <!-- Menu Umum -->
        <li class="nav-item">
          <x-sidelink href="/" :active="request()->is('/')">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </x-sidelink>
        </li>

        <!-- Menu untuk Role Siswa -->
        @if(Auth::user() && Auth::user()->role === 'siswa')
        <li class="nav-item">
          <x-sidelink href="/form" :active="request()->is('form')">
            <i class="nav-icon fas fa-edit"></i>
            <p>Isi Formulir</p>
          </x-sidelink>
        </li>
        <li class="nav-item">
          <x-sidelink href="/berkas" :active="request()->is('berkas')">
            <i class="nav-icon fas fa-upload"></i>
            <p>Upload Berkas</p>
          </x-sidelink>
        </li>
        <li class="nav-item">
          <x-sidelink href="/timeline" :active="request()->is('timeline')">
            <i class="nav-icon fas fa-bullhorn"></i>
            <p>Pengumuman</p>
          </x-sidelink>
        </li>
        @php
            $formulirActive = request()->is('formulir_*');
        @endphp
        <li class="nav-item {{ $formulirActive ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ $formulirActive ? 'active' : '' }}">
            <i class="nav-icon fas fa-file-alt"></i>
            <p>Formulir <i class="fas fa-angle-left right"></i></p>
          </a>
          <ul class="nav nav-treeview">
              <li class="nav-item">
                <x-sidelink href="/formulir_pribadi" :active="request()->is('formulir_pribadi')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Siswa</p>
                </x-sidelink>
              </li>
              <li class="nav-item">
                <x-sidelink href="/formulir_ortu" :active="request()->is('formulir_ortu')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Orang Tua</p>
                </x-sidelink>
              </li>
              <li class="nav-item">
                <x-sidelink href="/formulir_alamat" :active="request()->is('formulir_alamat')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Alamat</p>
                </x-sidelink>
              </li>
          </ul>
        </li>
        @endif

        <!-- Menu untuk Role Admin -->
        @if(Auth::user() && Auth::user()->role === 'admin')
        <li class="nav-item">
          <x-sidelink href="{{ route('pendaftar') }}" :active="request()->is('pendaftar')">
            <i class="nav-icon fas fa-users"></i>
            <p>Data Pendaftar</p>
          </x-sidelink>
        </li>
        <li class="nav-item">
          <x-sidelink href="{{ route('verifikasi') }}" :active="request()->is('verifikasi')">
            <i class="nav-icon fas fa-check-circle"></i>
            <p>Verifikasi</p>
          </x-sidelink>
        </li>
        <li class="nav-item">
          <x-sidelink href="/timeline" :active="request()->is('timeline')">
            <i class="nav-icon fas fa-bullhorn"></i>
            <p>Pengumuman</p>
          </x-sidelink>
        </li>
        @endif

        <!-- Logout -->
        <li class="nav-item">
          <form method="get" action="/logout">
            @csrf
            <button type="submit" class="nav-link btn btn-link" style="color: #c2c7d0; text-align: left;">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>Logout</p>
            </button>
          </form>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
