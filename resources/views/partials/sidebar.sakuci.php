@php
    $currentUri = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH);

    $currentUser = $user ?? \App\Models\User::current();
    $role = $currentUser->role ?? 'siswa';

    $logoUrl = route('dashboard');
    if ($currentUser) {
        if ($role === 'admin') {
            $logoUrl = route('admin.dashboard');
        } elseif ($role === 'petugas') {
            $logoUrl = route('petugas.dashboard');
        } elseif ($role === 'peminjam') {
            $logoUrl = route('peminjam.dashboard');
        }
    } else {
        $logoUrl = route('home');
    }

    $isActive = function(...$paths) use ($currentUri) {
        foreach ($paths as $path) {
            if (empty($path)) continue;
            if ($path === '/' && ($currentUri === '/' || str_ends_with($currentUri, '/public/'))) return true;
            if ($path !== '/' && str_contains($currentUri, $path)) return true;
        }
        return false;
    };
@endphp

<!-- CSS Murni untuk Mengubah Ikon Bulan/Matahari Berdasarkan Tema Bootstrap -->
<style>
    /* Default: Tampilkan Bulan (Untuk Mode Gelap) / Sembunyikan Matahari */
    #themeToggle .icon-sun {
        display: none;
    }
    #themeToggle .icon-moon {
        display: inline-block;
    }

    /* Jika Tema Terang (Light Mode aktif pada root html), balik ikonsnya */
    [data-bs-theme="light"] #themeToggle .icon-sun {
        display: inline-block;
    }
    [data-bs-theme="light"] #themeToggle .icon-moon {
        display: none;
    }
</style>

<!-- Sidebar dibungkus agar tingginya pas 1 layar dan posisi tetap (sticky) -->
<div id="appSidebar" class="app-sidebar d-flex flex-column p-3 bg-body border-end vh-100 position-sticky top-0">
    
    <!-- Bagian Atas (Logo, Tombol Tema Dinamis, & Tombol Tutup) -->
    <div class="d-flex align-items-center justify-content-between mb-3 pb-3 border-bottom flex-shrink-0 px-1">
        <div class="d-flex align-items-center gap-2 overflow-hidden">
            <button id="themeToggle" type="button" class="btn btn-link p-0 text-decoration-none text-body"
                    aria-label="Ganti tema terang/gelap" title="Ganti tema terang/gelap">
                <!-- Ikon Bulan (Tampil saat mode gelap) -->
                <svg class="icon-moon" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                </svg>
                <!-- Ikon Matahari (Tampil saat mode terang) -->
                <svg class="icon-sun" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <circle cx="12" cy="12" r="5"></circle>
                    <line x1="12" y1="1" x2="12" y2="3"></line>
                    <line x1="12" y1="21" x2="12" y2="23"></line>
                    <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                    <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                    <line x1="1" y1="12" x2="3" y2="12"></line>
                    <line x1="21" y1="12" x2="23" y2="12"></line>
                    <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                    <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                </svg>
            </button>
            <a href="{{ $logoUrl }}" class="fs-6 fw-bold text-uppercase tracking-wider text-decoration-none text-body text-truncate m-0">
                {{ config('app.name', 'PINVERA') }}
            </a>
        </div>

        <div class="d-flex align-items-center gap-2">
            <button id="sidebarToggleClose" class="btn btn-sm btn-link text-body p-0 d-lg-none" aria-label="Tutup Menu">
                <i class="bi bi-x-lg fs-5"></i>
            </button>
        </div>
    </div>

    <!-- Bagian Tengah (Menu Navigasi) -->
    <div class="flex-grow-1 overflow-y-auto pe-1" style="scrollbar-width: thin;">
        <ul class="nav nav-pills flex-column gap-1.5 mb-3">
            
            <li>
                @php 
                    $active = (function_exists('is_route') && is_route('home')) || $currentUri === '/' || str_ends_with($currentUri, '/public/'); 
                @endphp
                <a href="{{ route('home') }}" class="sidebar-link {{ $active ? 'active' : '' }}">
                    <i class="bi bi-house-door-fill"></i>
                    <span>Beranda</span>
                </a>
            </li>

            {{-- ==================== MENU ADMIN ==================== --}}
            @if($role === 'admin')
                <li class="nav-item">
                    <small class="sidebar-heading text-body-secondary px-2 my-2 d-block">Utama</small>
                </li>
                <li>
                    @php $active = $isActive('/admin/dashboard') || $currentUri === '/admin' || $currentUri === '/admin/'; @endphp
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ $active ? 'active' : '' }}">
                        <i class="bi bi-grid-1x2-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <small class="sidebar-heading text-body-secondary px-2 my-2 d-block">Pengguna</small>
                </li>
                <li>
                    @php $active = $isActive('/admin/users'); @endphp
                    <a href="{{ route('admin.users.index') }}" class="sidebar-link {{ $active ? 'active' : '' }}">
                        <i class="bi bi-people-fill"></i>
                        <span>Manage User</span>
                    </a>
                </li>
                <li>
                    @php $active = $isActive('/admin/roles'); @endphp
                    <a href="{{ route('admin.roles.index') }}" class="sidebar-link {{ $active ? 'active' : '' }}">
                        <i class="bi bi-shield-check"></i>
                        <span>Manage Role</span>
                    </a>
                </li>
                <li class="nav-item">
                    <small class="sidebar-heading text-body-secondary px-2 my-2 d-block">Inventaris</small>
                </li>
                <li>
                    @php $active = $isActive('/admin/kategori'); @endphp
                    <a href="{{ route('kategori.index') }}" class="sidebar-link {{ $active ? 'active' : '' }}">
                        <i class="bi bi-tags-fill"></i>
                        <span>Kategori Alat</span>
                    </a>
                </li>
                <li>
                    @php $active = $isActive('/admin/alat'); @endphp
                    <a href="{{ route('alat.index') }}" class="sidebar-link {{ $active ? 'active' : '' }}">
                        <i class="bi bi-box-seam-fill"></i>
                        <span>Data Alat</span>
                    </a>
                </li>
                <li class="nav-item">
                    <small class="sidebar-heading text-body-secondary px-2 my-2 d-block">Transaksi</small>
                </li>
                <li>
                    @php $active = $isActive('/admin/peminjaman'); @endphp
                    <a href="{{ route('peminjaman.index') }}" class="sidebar-link {{ $active ? 'active' : '' }}">
                        <i class="bi bi-arrow-up-right-circle-fill"></i>
                        <span>Peminjaman</span>
                    </a>
                </li>
                <li>
                    @php $active = $isActive('/admin/pengembalian'); @endphp
                    <a href="{{ route('pengembalian.index') }}" class="sidebar-link {{ $active ? 'active' : '' }}">
                        <i class="bi bi-arrow-down-left-circle-fill"></i>
                        <span>Pengembalian</span>
                    </a>
                </li>
                <li class="nav-item">
                    <small class="sidebar-heading text-body-secondary px-2 my-2 d-block">Sistem</small>
                </li>
                <li>
                    @php $active = $isActive('/admin/log-aktifitas'); @endphp
                    <a href="{{ route('admin.log.index') }}" class="sidebar-link {{ $active ? 'active' : '' }}">
                        <i class="bi bi-journal-text"></i>
                        <span>Log Aktifitas</span>
                    </a>
                </li>
                <li>
                    @php $active = $isActive('/admin/database/export'); @endphp
                    <a href="{{ route('admin.database.export') }}" class="sidebar-link {{ $active ? 'active' : '' }}">
                        <i class="bi bi-database-fill-down"></i>
                        <span>Backup Database</span>
                    </a>
                </li>

            {{-- ==================== MENU PEMINJAM ==================== --}}
            @elseif($role === 'peminjam')
                <li class="nav-item">
                    <small class="sidebar-heading text-body-secondary px-2 my-2 d-block">Menu Peminjam</small>
                </li>
                <li>
                    @php $active = $currentUri === '/peminjam' || $currentUri === '/peminjam/' || $isActive('/peminjam/dashboard'); @endphp
                    <a href="{{ route('peminjam.dashboard') }}" class="sidebar-link {{ $active ? 'active' : '' }}">
                        <i class="bi bi-grid-1x2-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    @php $active = $isActive('/peminjam/daftar-alat', '/peminjam/alat'); @endphp
                    <a href="{{ route('peminjam.alat') }}" class="sidebar-link {{ $active ? 'active' : '' }}">
                        <i class="bi bi-box-seam-fill"></i>
                        <span>Daftar Alat</span>
                    </a>
                </li>
                <li>
                    @php $active = $isActive('/peminjam/ajukan', '/peminjam/create', '/peminjam/peminjam/ajukan'); @endphp
                    <a href="{{ route('peminjam.createPeminjam') }}" class="sidebar-link {{ $active ? 'active' : '' }}">
                        <i class="bi bi-plus-circle-fill"></i>
                        <span>Ajukan Peminjaman</span>
                    </a>
                </li>
                <li>
                    @php $active = $isActive('/peminjam/pengembalian'); @endphp
                    <a href="{{ route('peminjam.pengembalian.create') }}" class="sidebar-link {{ $active ? 'active' : '' }}">
                        <i class="bi bi-arrow-down-left-circle-fill"></i>
                        <span>Kembalikan Alat</span>
                    </a>
                </li>
                <li>
                    @php $active = $isActive('/riwayat-peminjaman'); @endphp
                    <a href="{{ route('peminjam.riwayat') }}" class="sidebar-link {{ $active ? 'active' : '' }}">
                        <i class="bi bi-clock-history"></i>
                        <span>Riwayat Peminjaman</span>
                    </a>
                </li>

            {{-- ==================== MENU PETUGAS ==================== --}}
            @elseif($role === 'petugas')
                <li class="nav-item">
                    <small class="sidebar-heading text-body-secondary px-2 my-2 d-block">Menu Petugas</small>
                </li>
                <li>
                    @php 
                        $active = $currentUri === '/petugas' || 
                                  $currentUri === '/petugas/' || 
                                  $isActive('/petugas/dashboard'); 
                    @endphp
                    <a href="{{ route('petugas.dashboard') }}" class="sidebar-link {{ $active ? 'active' : '' }}">
                        <i class="bi bi-grid-1x2-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    @php $active = $isActive('/petugas/peminjaman'); @endphp
                    <a href="{{ route('petugas.peminjaman.index') }}" class="sidebar-link {{ $active ? 'active' : '' }}">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>Persetujuan Peminjaman</span>
                    </a>
                </li>
                <li>
                    @php $active = $isActive('/petugas/pengembalian'); @endphp
                    <a href="{{ route('petugas.pengembalian.index') }}" class="sidebar-link {{ $active ? 'active' : '' }}">
                        <i class="bi bi-arrow-return-left"></i>
                        <span>Pantau Pengembalian</span>
                    </a>
                </li>
            @endif

        </ul>
    </div>

    <hr class="my-2 border-secondary opacity-15 flex-shrink-0">

    <!-- BAGIAN BAWAH SIDEBAR (Profil / Tombol Login & Register) -->
    @if ($currentUser)
        <!-- Tampil Jika Sudah Login -->
        <div class="d-flex flex-column gap-2 px-1 flex-shrink-0 pt-1">
            <div class="d-flex align-items-center gap-2 p-2 rounded-3 bg-body-tertiary">
                <div class="bg-primary text-white rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; flex-shrink: 0;">
                    <i class="bi bi-person-fill fs-6"></i>
                </div>
                <div class="overflow-hidden">
                    <h6 class="mb-0 text-truncate fw-semibold" style="font-size: 0.85rem;">{{ $currentUser->username ?? 'User' }}</h6>
                    <small class="text-body-secondary d-block text-truncate text-capitalize" style="font-size: 0.75rem;">{{ $role }}</small>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}" class="m-0 w-100">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-danger w-100 rounded-3 d-flex align-items-center justify-content-center gap-2 py-2">
                    <i class="bi bi-box-arrow-right"></i>
                    <span class="fw-medium">Logout</span>
                </button>
            </form>
        </div>
    @else
        <!-- Tampil Jika Belum Login (Guest) -->
        <div class="d-flex flex-column gap-2 px-1 flex-shrink-0 pt-1">
            <a href="{{ route('login') }}" class="btn btn-sm btn-outline-primary w-100 rounded-3 d-flex align-items-center justify-content-center gap-2 py-2">
                <i class="bi bi-box-arrow-in-right"></i>
                <span class="fw-medium">Masuk</span>
            </a>
            <a href="{{ route('register') }}" class="btn btn-sm btn-primary w-100 rounded-3 d-flex align-items-center justify-content-center gap-2 py-2 shadow-sm">
                <i class="bi bi-person-plus"></i>
                <span class="fw-medium">Daftar Akun</span>
            </a>
        </div>
    @endif

</div>