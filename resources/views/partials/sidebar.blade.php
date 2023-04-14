<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link m-auto">
      <span class="brand-text font-weight-light">TOEFL | UBP Karawang</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('assets/dist/img/avatar.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{ Auth::user()->role == 'mahasiswa' ? route('user.profile', Auth::user()->id) : '#' }}" class="d-block">{{ ucwords(Auth::user()->nama) }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          @if(Auth::user()->role == 'admin')
          <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.periode') }}" class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Master periode
              </p>
            </a>
          </li>

          {{-- Toefl English start --}}
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                TOEFL English
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
                <a href="{{ route('admin.english.pelatihan') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pelatihan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.english.test') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Test</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.english.pelatihan_test') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pelatihan & Test</p>
                </a>
              </li>
            </ul>
          </li>
          {{-- Toefl English end --}}

          {{-- Toefl Japan start --}}
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                TOEFL Jepang
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
                <a href="{{ route('admin.japan.pelatihan') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pelatihan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.japan.test') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Test</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.japan.pelatihan_test') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pelatihan & Test</p>
                </a>
              </li>
            </ul>
          </li>
          {{-- Toefl Japan end --}}
          @endif

          @if(Auth::user()->role == 'mahasiswa')
          <li class="nav-item">
            <a href="{{ route('user.dashboard') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('user.pendaftaran') }}" class="nav-link">
              <i class="nav-icon fas fa-pen"></i>
              <p>
                Daftar TOEFL
              </p>
            </a>
          </li>
          @endif
        </ul>
      </nav>
    </div>
  </aside>