<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    @if (isset(Auth::user()->name))
    <ul class="navbar-nav ml-auto">
        @else
        <ul class="navbar-nav ml-auto d-none">
        @endif
  <li class="nav-item dropdown mr-5">
    <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
      <i class="fas fa-user-circle"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right">
      <span class="dropdown-item dropdown-header">
        {{ Auth::user()->name ?? 'User' }}
      </span>
      <div class="dropdown-divider"></div>

      <!-- Link ke edit profil -->
      <a href="/" class="dropdown-item">
        <i class="fas fa-user-edit mr-2"></i> Edit Profil
      </a>

      <div class="dropdown-divider"></div>

      <!-- Tombol logout -->
      <a href="/logout" class="dropdown-item">
        <i class="fas fa-sign-out-alt mr-2"></i> Logout
      </a>

      <form id="logout-form" action="/" method="get" style="display: none;">
        @csrf
      </form>
    </div>
  </li>
</ul>

  </nav>