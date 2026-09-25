<nav class="navbar navbar-expand-lg bg-body border-bottom sticky-top">
    <div class="container">
        <div class="d-flex align-items-center gap-2">
            @php
                $dbConnected = false;
                try {
                    \Sakuci\Database\Connection::pdo();
                    $dbConnected = true;
                } catch (\Throwable $e) {
                    $dbConnected = false;
                }
            @endphp
            <!-- Tombol Theme Toggle dengan Ikon Bulan -->
            <button id="themeToggle" type="button" class="logo-toggle btn btn-link p-0 text-decoration-none"
                    aria-label="Ganti tema terang/gelap"
                    title="Ganti tema terang/gelap">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-body" aria-hidden="true">
                    <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                </svg>
            </button>
            <a class="navbar-brand fw-semibold m-0" href="{{ route('home') }}">{{ config('app.name') }}</a>
        </div>

        <button class="navbar-toggler border-0" type="button"
                data-bs-toggle="collapse" data-bs-target="#menuUtama"
                aria-controls="menuUtama" aria-expanded="false" aria-label="Buka menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Tambahkan menu aplikasi Anda di sini --}}
        <div class="collapse navbar-collapse" id="menuUtama">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">
                <li class="nav-item">
                    <a class="nav-link {{ is_route('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ is_route('peminjaman.index') ? 'active' : '' }}" href="{{ route('peminjaman.index') }}">Ydh1rr</a>
                </li>
                @php
                    $currentUser = \App\Models\User::current();
                @endphp
                @if ($currentUser)
                    <li class="nav-item">
                        <a class="nav-link {{ is_route('admin.dashboard', 'dashboard') ? 'active' : '' }}"
                           href="{{ $currentUser->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-lg-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-secondary w-100 mt-2 mt-lg-0">Logout ({{ $currentUser->username }})</button>
                        </form>
                    </li>
                @else
                    @php
                        $canRegister = false;
                        if ($dbConnected) {
                            try {
                                $canRegister = \App\Models\Role::where('can_register', 1)->exists();
                            } catch (\Throwable $e) {
                                $canRegister = false;
                            }
                        }
                    @endphp
                    @if ($canRegister)
                        <li class="nav-item">
                            <a class="nav-link {{ is_route('register') ? 'active' : '' }}" href="{{ route('register') }}">Daftar</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="btn btn-sm btn-brand rounded-pill px-3 d-inline-flex align-items-center gap-2 mt-2 mt-lg-0" href="{{ route('login') }}">
                            <svg width="14" height="14" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <circle cx="8" cy="5" r="3" fill="currentColor" stroke="none"/>
                                <path d="M2.5 14c0-3.6 2.9-5.8 5.5-5.8s5.5 2.2 5.5 5.8"/>
                            </svg>
                            Masuk
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>