@extends('layouts.app')

@section('title', config('app.name') . ' — Dashboard Petugas')

@section('content')
<div class="container-fluid px-0 py-2">

    <!-- 1. BANNER UTAMA (Clean Professional Dark Gradient) -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4 text-white" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);">
        <div class="card-body p-4 p-md-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div>
                    <span class="badge bg-warning text-dark rounded-pill px-3 py-1.5 mb-2 fw-bold shadow-sm">
                        <i class="bi bi-shield-check me-1"></i> Panel Petugas Operasional
                    </span>
                    <h3 class="fw-bold mb-1">Selamat Datang, {{ $user->username ?? 'Petugas' }}! 👋</h3>
                    <p class="mb-0 text-white-50 small" style="max-width: 600px;">
                        Pusat kendali operasional peminjaman. Pantau antrean verifikasi, status barang dipinjam, dan cetak laporan rekapitulasi.
                    </p>
                </div>
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <a href="{{ route('petugas.pengembalian.cetak') }}" target="_blank" class="btn btn-outline-light rounded-pill px-3.5 py-2 fw-medium small">
                        <i class="bi bi-printer me-1"></i> Cetak Laporan
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. RINGKASAN STATISTIK (Clean & Soft Icons) -->
    <div class="row g-3 mb-4">
        <!-- Menunggu Verifikasi -->
        <div class="col-6 col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-3 h-100 bg-body">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-warning bg-opacity-10 text-warning p-3 rounded-4 fs-4">
                        <i class="bi bi-hourglass-split"></i>
                    </div>
                    <div>
                        <span class="text-uppercase fw-semibold text-muted d-block fs-8 mb-1">Menunggu Verifikasi</span>
                        <h4 class="fw-bold mb-0 text-body">{{ $totalPending ?? 0 }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- Barang Dipinjam -->
        <div class="col-6 col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-3 h-100 bg-body">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-info bg-opacity-10 text-info p-3 rounded-4 fs-4">
                        <i class="bi bi-box-seam-fill"></i>
                    </div>
                    <div>
                        <span class="text-uppercase fw-semibold text-muted d-block fs-8 mb-1">Barang Dipinjam</span>
                        <h4 class="fw-bold mb-0 text-body">{{ $totalDipinjam ?? 0 }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Selesai -->
        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-3 h-100 bg-body">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-success bg-opacity-10 text-success p-3 rounded-4 fs-4">
                        <i class="bi bi-database-check"></i>
                    </div>
                    <div>
                        <span class="text-uppercase fw-semibold text-muted d-block fs-8 mb-1">Total Selesai</span>
                        <h4 class="fw-bold mb-0 text-body">{{ $totalSelesai ?? 0 }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 3. MENU AKSES CEPAT (Grid Rapi & Profesional) -->
    <h5 class="fw-bold mb-3 text-body"><i class="bi bi-grid-fill me-2 text-primary"></i>Menu Akses Cepat</h5>

    <div class="row g-3 mb-4">
        <!-- Persetujuan Peminjaman -->
        <div class="col-md-6">
            <a href="{{ route('petugas.peminjaman.index') }}" class="card custom-menu-card h-100 text-decoration-none border shadow-sm rounded-4 p-3">
                <div class="d-flex align-items-start justify-content-between mb-3">
                    <div class="menu-icon-wrapper rounded-3 p-3 d-flex align-items-center justify-content-center">
                        <i class="bi bi-check-circle fs-4"></i>
                    </div>
                    <i class="bi bi-arrow-up-right text-muted fs-6"></i>
                </div>
                <div>
                    <h6 class="fw-bold text-body mb-1 fs-5">Persetujuan Peminjaman</h6>
                    <small class="text-muted d-block mb-2 fw-medium">Verifikasi pengajuan siswa</small>
                    <p class="text-muted small mb-0 fs-8">Proses persetujuan atau penolakan pengajuan peminjaman alat olahraga dari siswa.</p>
                </div>
            </a>
        </div>

        <!-- Pantau Pengembalian -->
        <div class="col-md-6">
            <a href="{{ route('petugas.pengembalian.index') }}" class="card custom-menu-card h-100 text-decoration-none border shadow-sm rounded-4 p-3">
                <div class="d-flex align-items-start justify-content-between mb-3">
                    <div class="menu-icon-wrapper rounded-3 p-3 d-flex align-items-center justify-content-center">
                        <i class="bi bi-arrow-return-left fs-4"></i>
                    </div>
                    <i class="bi bi-arrow-up-right text-muted fs-6"></i>
                </div>
                <div>
                    <h6 class="fw-bold text-body mb-1 fs-5">Pantau Pengembalian</h6>
                    <small class="text-muted d-block mb-2 fw-medium">Pencatatan barang & denda</small>
                    <p class="text-muted small mb-0 fs-8">Konfirmasi pengembalian alat, periksa tenggat waktu, dan kalkulasi denda keterlambatan.</p>
                </div>
            </a>
        </div>
    </div>

</div>

<style>
    .custom-menu-card {
        background-color: var(--bs-card-bg);
        border-color: var(--bs-border-color) !important;
        transition: all 0.2s ease-in-out;
    }

    .menu-icon-wrapper {
        background-color: var(--bs-tertiary-bg);
        color: var(--bs-body-color);
        width: 48px;
        height: 48px;
        transition: all 0.2s ease-in-out;
    }

    .custom-menu-card:hover {
        border-color: var(--bs-primary) !important;
        transform: translateY(-3px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.06) !important;
    }

    .custom-menu-card:hover .menu-icon-wrapper {
        background-color: var(--bs-primary);
        color: #ffffff;
    }

    .fs-8 {
        font-size: 0.8125rem;
    }
</style>
@endsection