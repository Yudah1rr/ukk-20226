@extends('layouts.app')

@section('title', config('app.name') . ' — Daftar Alat Tersedia')

@section('content')
<div class="container-fluid px-0 py-3">

    <!-- 🌟 BANNER HEADER HALAMAN ALAT (Selaras dengan Tema Dashboard) -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4 text-white position-relative gold-banner">
        <div class="banner-pattern"></div>
        <div class="banner-glow"></div>
        <div class="card-body p-4 p-md-5 position-relative z-1">
            <div class="row align-items-center justify-content-between g-4">
                
                <div class="col-lg-7">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="d-inline-flex align-items-center bg-white bg-opacity-15 rounded-pill px-3 py-1 border border-white border-opacity-20 backdrop-blur">
                            <span class="small fw-semibold text-white tracking-wide">
                                <i class="bi bi-box-seam me-1"></i> Inventaris Sekolah
                            </span>
                        </div>
                    </div>
                    
                    <h1 class="fw-bold mb-2 tracking-tight text-white display-6">
                        Katalog Alat Tersedia 🛠️
                    </h1>
                    <p class="mb-0 text-white-50 fs-6 lh-relaxed" style="max-width: 540px;">
                        Jelajahi berbagai peralatan laboratorium dan praktik yang tersedia. Pilih alat yang Anda butuhkan dan ajukan peminjaman secara online dengan mudah.
                    </p>
                </div>

                <!-- Kolom Search Bar di dalam Banner (Opsional / Akses Cepat) -->
                <div class="col-lg-5">
                    <form action="{{ route('peminjam.alat') }}" method="GET" class="card bg-white bg-opacity-10 border border-white border-opacity-20 p-3 rounded-4 backdrop-blur shadow-sm">
                        <label class="form-label text-white fw-semibold fs-8 mb-2 tracking-wider text-uppercase">Cari Peralatan</label>
                        <div class="input-group">
                            <input type="text" name="q" class="form-control form-control-lg bg-white border-0 text-dark fs-7 shadow-none" placeholder="Masukkan nama atau kode alat..." value="{{ request('q') }}">
                            <button class="btn btn-light text-warning-emphasis fw-bold px-4 shadow-none" type="submit">
                                <i class="bi bi-search"></i> Cari
                            </button>
                        </div>
                        @if(request('q'))
                            <div class="d-flex justify-content-between align-items-center mt-2 pt-2 border-top border-white border-opacity-10">
                                <span class="fs-8 text-white-50">Filter aktif: "{{ request('q') }}"</span>
                                <a href="{{ route('peminjam.alat') }}" class="fs-8 text-white text-decoration-underline">Reset Pencarian</a>
                            </div>
                        @endif
                    </form>
                </div>

            </div>
        </div>
    </div>

    @php
        // Ambil data alat mentah
        $rawAlats = $alats ?? $alat ?? [];
        $searchQuery = trim(request('q') ?? '');

        // Filter data menggunakan PHP murni
        $filteredAlats = [];
        foreach ($rawAlats as $item) {
            $namaAlat = $item->nama_alat ?? $item->nama ?? $item->name ?? '';
            $kodeAlat = $item->kode_alat ?? $item->kode ?? '';

            if (!empty($searchQuery)) {
                if (stripos($namaAlat, $searchQuery) !== false || stripos($kodeAlat, $searchQuery) !== false) {
                    $filteredAlats[] = $item;
                }
            } else {
                $filteredAlats[] = $item;
            }
        }
    @endphp

    <!-- Informasi Hasil Filter -->
    <div class="d-flex justify-content-between align-items-center mb-3 px-1">
        <span class="text-muted fs-7">
            Menampilkan <strong class="text-body">{{ count($filteredAlats) }}</strong> alat yang siap dipinjam
        </span>
    </div>

    <!-- 📦 GRID CARD DAFTAR ALAT (Desain Modern & Clean) -->
    <div class="row g-4 mb-4">
        @forelse($filteredAlats as $item)
            @php
                $namaKategori = $kategoriMap[$item->id_kategori] ?? 'Umum';
                $alatId       = $item->id_alat ?? $item->id;
                $namaAlat     = $item->nama_alat ?? $item->nama ?? $item->name ?? 'Alat #' . $alatId;
                $kodeAlat     = $item->kode_alat ?? $item->kode ?? 'ALT';
                $stokAlat     = $item->stok ?? $item->jumlah ?? null;
            @endphp
            <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                <div class="card h-100 border-0 shadow-sm rounded-4 bg-body alat-card position-relative overflow-hidden">
                    
                    <!-- Aksen Garis Atas Kartu -->
                    <div class="card-top-accent bg-warning"></div>

                    <div class="card-body d-flex flex-column justify-content-between p-4">
                        <div>
                            <!-- Badge Kode Alat & Kategori -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-2.5 py-1 rounded-pill fw-semibold fs-8">
                                    <i class="bi bi-tag-fill me-1"></i> {{ $kodeAlat }}
                                </span>
                                <span class="badge bg-secondary-subtle text-secondary px-2.5 py-1 rounded-pill fs-8">
                                    {{ $namaKategori }}
                                </span>
                            </div>

                            <!-- Ilustrasi Ikon Mini & Nama Alat -->
                            <div class="d-flex align-items-start gap-3 mb-3">
                                <div class="alat-icon-box bg-light text-warning flex-shrink-0 shadow-sm">
                                    <i class="bi bi-tools"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold fs-6 mb-1 text-body line-clamp-2">
                                        {{ $namaAlat }}
                                    </h5>
                                    @if(isset($stokAlat))
                                        <small class="text-muted fs-8">Stok tersedia: <strong>{{ $stokAlat }} unit</strong></small>
                                    @else
                                        <small class="text-success fs-8"><i class="bi bi-check-circle-fill"></i> Status: Ready</small>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Ajukan Pinjam -->
                        <div class="mt-3 pt-3 border-top border-light">
                            <a href="{{ route('peminjam.createPeminjam') . '?id_alat=' . $alatId }}" 
                               class="btn btn-warning w-100 rounded-pill py-2.5 fw-bold text-dark d-flex align-items-center justify-content-center gap-2 hover-lift shadow-sm">
                                <i class="bi bi-handbag-fill"></i>
                                <span>Ajukan Pinjam</span>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4 p-5 text-center bg-body">
                    <div class="py-4">
                        <div class="display-4 text-muted mb-3 opacity-50">
                            <i class="bi bi-search"></i>
                        </div>
                        <h5 class="fw-bold text-body mb-1">Peralatan Tidak Ditemukan</h5>
                        <p class="text-muted fs-7 mb-3">Maaf, alat yang Anda cari dengan kata kunci "{{ request('q') }}" tidak tersedia.</p>
                        <a href="{{ route('peminjam.alat') }}" class="btn btn-outline-warning text-dark fw-semibold rounded-pill px-4">
                            Lihat Semua Alat
                        </a>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

</div>

<style>
    /* Styling Banner Tema Kuning Emas */
    .gold-banner {
        background: linear-gradient(135deg, #b45309 0%, #d97706 50%, #92400e 100%);
        position: relative;
        overflow: hidden;
    }

    .banner-pattern {
        position: absolute;
        top: 0; right: 0; bottom: 0; left: 0;
        background-image: radial-gradient(rgba(255, 255, 255, 0.12) 1px, transparent 1px);
        background-size: 20px 20px;
        opacity: 0.6;
        pointer-events: none;
    }

    .banner-glow {
        position: absolute;
        top: -60px; right: -60px;
        width: 220px; height: 220px;
        background: rgba(254, 240, 138, 0.25);
        filter: blur(60px);
        border-radius: 50%;
        pointer-events: none;
    }

    .backdrop-blur {
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
    }

    /* Kartu Alat / Katalog */
    .alat-card {
        border: 1px solid var(--bs-border-color-translucent) !important;
        transition: all 0.25s ease;
    }

    .alat-card:hover {
        transform: translateY(-5px);
        border-color: #d97706 !important;
        box-shadow: 0 0.75rem 1.5rem rgba(217, 119, 6, 0.12) !important;
    }

    .card-top-accent {
        height: 4px;
        width: 100%;
        background: #d97706;
    }

    .alat-icon-box {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        background: rgba(217, 119, 6, 0.1);
        color: #b45309;
    }

    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .hover-lift {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .hover-lift:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }

    .fs-7 { font-size: 0.875rem; line-height: 1.4; }
    .fs-8 { font-size: 0.75rem; }
    .tracking-wider { letter-spacing: 0.06em; }
    .tracking-wide { letter-spacing: 0.04em; }
</style>
@endsection