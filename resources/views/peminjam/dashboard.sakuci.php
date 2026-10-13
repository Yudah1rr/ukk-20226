@extends('layouts.app')

@section('title', config('app.name') . ' — Dashboard Siswa')

@section('content')
<div class="container-fluid px-0 py-3">

    <!-- 🌟 BANNER UTAMA SISWA (Kompleks, Elegan & Nuansa Kuning Emas) -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4 text-white position-relative gold-banner">
        <div class="banner-pattern"></div>
        <div class="banner-glow"></div>
        <div class="card-body p-4 p-md-5 position-relative z-1">
            <div class="row align-items-center justify-content-between g-4">
                
                <div class="col-lg-7">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="d-inline-flex align-items-center bg-white bg-opacity-15 rounded-pill px-3 py-1 border border-white border-opacity-20 backdrop-blur">
                            <span class="badge bg-white text-warning-emphasis rounded-pill me-2 px-2 py-1 fw-bold fs-7">
                                <i class="bi bi-person-badge-fill"></i>
                            </span>
                            <span class="small fw-semibold text-white tracking-wide">Role: {{ $user->role ?? 'Siswa' }}</span>
                        </div>
                        <div class="d-inline-flex align-items-center bg-success bg-opacity-25 text-white rounded-pill px-3 py-1 border border-success border-opacity-30 backdrop-blur fs-7">
                            <i class="bi bi-circle-fill text-success fs-9 me-1.5 animate-pulse"></i> Status Akun: Aktif
                        </div>
                    </div>
                    
                    <!-- Sapaan & Deskripsi -->
                    <h1 class="fw-bold mb-2 tracking-tight text-white display-6">
                        Halo, {{ $user->username ?? 'User' }}! 👋
                    </h1>
                    <p class="mb-4 text-white-50 fs-6 lh-relaxed" style="max-width: 560px;">
                        Selamat datang kembali di Sistem Inventaris Alat. Pantau status peminjaman, tenggat waktu pengembalian, serta tagihan denda Anda secara real-time di bawah ini.
                    </p>

                    <!-- Tombol Aksi Cepat -->
                    <div class="d-flex flex-wrap align-items-center gap-2">
                        <a href="{{ route('peminjam.createPeminjam') }}" class="btn btn-light text-warning-emphasis fw-bold px-4 py-2.5 rounded-pill shadow-sm d-inline-flex align-items-center gap-2 hover-lift">
                            <i class="bi bi-plus-lg fs-5"></i>
                            <span>Ajukan Peminjaman Baru</span>
                        </a>
                        <a href="#riwayat-section" class="btn btn-outline-light fw-semibold px-4 py-2.5 rounded-pill backdrop-blur d-inline-flex align-items-center gap-2">
                            <i class="bi bi-clock-history"></i>
                            <span>Cek Aktivitas</span>
                        </a>
                    </div>
                </div>

                <!-- 🎨 ILUSTRASI / ICON BOX DEKORATIF MULTI-LAYER -->
                <div class="col-lg-5 text-lg-end d-none d-lg-block">
                    <div class="position-relative d-inline-block p-4">
                        <div class="banner-icon-box shadow-lg">
                            <i class="bi bi-box-seam-fill"></i>
                            <div class="floating-badge-1 shadow-sm">
                                <i class="bi bi-shield-check text-success fs-5"></i>
                            </div>
                            <div class="floating-badge-2 shadow-sm">
                                <i class="bi bi-lightning-charge-fill text-warning fs-5"></i>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- 📊 4 KARTU STATISTIK UTAMA (Sinkron Controller) -->
    <div class="row g-3 mb-4">
        
        <!-- Kartu Menunggu -->
        <div class="col-6 col-xl-3">
            <div class="card stat-card border-0 shadow-sm rounded-4 p-4 h-100 bg-body position-relative">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="stat-icon-box bg-warning-subtle text-warning-emphasis">
                        <i class="bi bi-hourglass-split"></i>
                    </div>
                    <span class="badge bg-warning-subtle text-warning-emphasis rounded-pill px-2 py-1 fs-8 fw-semibold">Pending</span>
                </div>
                <div>
                    <span class="text-muted text-uppercase fw-bold fs-8 tracking-wider d-block mb-1">Menunggu</span>
                    <h2 class="fw-bold mb-1 text-body tracking-tight text-warning">{{ $pendingCount ?? 0 }}</h2>
                    <small class="text-muted fs-7">Persetujuan admin</small>
                </div>
            </div>
        </div>

        <!-- Kartu Dipinjam -->
        <div class="col-6 col-xl-3">
            <div class="card stat-card border-0 shadow-sm rounded-4 p-4 h-100 bg-body position-relative">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="stat-icon-box bg-warning-subtle text-warning-emphasis">
                        <i class="bi bi-box-seam-fill"></i>
                    </div>
                    <span class="badge bg-warning-subtle text-warning-emphasis rounded-pill px-2 py-1 fs-8 fw-semibold">Aktif</span>
                </div>
                <div>
                    <span class="text-muted text-uppercase fw-bold fs-8 tracking-wider d-block mb-1">Dipinjam</span>
                    <h2 class="fw-bold mb-1 text-body tracking-tight text-warning-emphasis">{{ $activeCount ?? 0 }}</h2>
                    <small class="text-muted fs-7">Alat di tangan Anda</small>
                </div>
            </div>
        </div>

        <!-- Kartu Selesai -->
        <div class="col-6 col-xl-3">
            <div class="card stat-card border-0 shadow-sm rounded-4 p-4 h-100 bg-body position-relative">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="stat-icon-box bg-success-subtle text-success">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <span class="badge bg-success-subtle text-success rounded-pill px-2 py-1 fs-8 fw-semibold">Selesai</span>
                </div>
                <div>
                    <span class="text-muted text-uppercase fw-bold fs-8 tracking-wider d-block mb-1">Selesai</span>
                    <h2 class="fw-bold mb-1 text-body tracking-tight text-success">{{ $completedCount ?? 0 }}</h2>
                    <small class="text-muted fs-7">Riwayat peminjaman</small>
                </div>
            </div>
        </div>

        <!-- Kartu Total Denda -->
        <div class="col-6 col-xl-3">
            <div class="card stat-card border-0 shadow-sm rounded-4 p-4 h-100 bg-body position-relative">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="stat-icon-box bg-danger-subtle text-danger">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                    </div>
                    <span class="badge bg-danger-subtle text-danger rounded-pill px-2 py-1 fs-8 fw-semibold">Tagihan</span>
                </div>
                <div>
                    <span class="text-muted text-uppercase fw-bold fs-8 tracking-wider d-block mb-1">Total Denda</span>
                    <h2 class="fw-bold mb-1 text-body tracking-tight text-danger fs-5">Rp {{ number_format($totalDenda ?? 0, 0, ',', '.') }}</h2>
                    <small class="text-muted fs-7">Keterlambatan</small>
                </div>
            </div>
        </div>

    </div>

    <!-- ⚡ GRID KOMPLEKS: INFORMASI & STATUS KUOTA -->
    <div class="row g-3 mb-4">
        
        <!-- Informasi Sistem & Panduan -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 h-100 bg-body p-4">
                <h5 class="fw-bold mb-3 text-body d-flex align-items-center gap-2">
                    <i class="bi bi-info-circle-fill text-warning"></i> Panduan & Kebijakan Peminjaman
                </h5>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="p-3 rounded-3 bg-light-subtle border border-light-subtle h-100 d-flex gap-3">
                            <div class="bg-warning-subtle text-warning-emphasis p-2.5 rounded-3 fs-4 d-flex align-items-center justify-content-center" style="width: 46px; height: 46px; flex-shrink: 0;">
                                <i class="bi bi-journal-check"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1 text-body fs-7">Prosedur Pengajuan</h6>
                                <p class="text-muted fs-8 mb-0">Isi formulir peminjaman dengan lengkap dan tunggu verifikasi persetujuan dari petugas/admin.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 rounded-3 bg-light-subtle border border-light-subtle h-100 d-flex gap-3">
                            <div class="bg-warning-subtle text-warning-emphasis p-2.5 rounded-3 fs-4 d-flex align-items-center justify-content-center" style="width: 46px; height: 46px; flex-shrink: 0;">
                                <i class="bi bi-clock-history"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1 text-body fs-7">Batas Waktu & Denda</h6>
                                <p class="text-muted fs-8 mb-0">Kembalikan alat tepat waktu untuk menghindari akumulasi denda harian yang tercatat di sistem.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ringkasan Kuota Peminjaman -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 bg-body p-4 d-flex flex-column justify-content-between">
                <div>
                    <h5 class="fw-bold mb-2 text-body d-flex align-items-center gap-2">
                        <i class="bi bi-speedometer2 text-warning"></i> Status Kuota Anda
                    </h5>
                    <p class="text-muted fs-8 mb-3">Batas maksimal alat yang aktif dipinjam secara bersamaan.</p>
                </div>
                <div>
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="fs-8 fw-semibold text-muted">Kapasitas Digunakan</span>
                        <span class="fs-8 fw-bold text-warning-emphasis">{{ $activeCount ?? 0 }} / 3 Alat</span>
                    </div>
                    <div class="progress rounded-pill mb-3" style="height: 10px;">
                        @php
                            $active = $activeCount ?? 0;
                            $percentage = min(($active / 3) * 100, 100);
                        @endphp
                        <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $percentage }}%;" aria-valuenow="{{ $active }}" aria-valuemin="0" aria-valuemax="3"></div>
                    </div>
                    <div class="d-flex align-items-center gap-2 text-muted fs-8">
                        <i class="bi bi-shield-fill-check text-success"></i>
                        <span>Akun anda terverifikasi dan aman.</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- 📋 TABEL AKTIVITAS TERBARU (SINKRON DENGAN DATABASE & CONTROLLER) -->
    <div class="card border-0 shadow-sm rounded-4 bg-body p-4" id="riwayat-section">
        <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
            <div>
                <h5 class="fw-bold mb-1 text-body">Aktivitas Peminjaman Terbaru</h5>
                <p class="text-muted fs-8 mb-0">Daftar transaksi peminjaman alat terakhir yang tercatat atas akun Anda.</p>
            </div>
            <a href="{{ route('peminjam.indexPeminjam') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3 fw-semibold fs-8">Lihat Semua Riwayat</a>
        </div>
        
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light fs-8 text-uppercase tracking-wider">
                    <tr>
                        <th class="py-3 rounded-start">ID / Kode</th>
                        <th class="py-3">Nama Alat</th>
                        <th class="py-3">Tanggal Pinjam</th>
                        <th class="py-3">Status</th>
                    </tr>
                </thead>
                <tbody class="fs-7">
                    @forelse($riwayatTerbaru ?? [] as $item)
                        <tr>
                            <td class="fw-bold text-warning-emphasis">{{ str_pad($item->id_peminjaman, 4, '0', STR_PAD_LEFT) }}</td>
                            <td>
                                <div class="fw-semibold text-body">{{ $item->data_alat->nama_alat ?? 'Alat tidak ditemukan' }}</div>
                                <small class="text-muted fs-8">Jumlah: {{ $item->jumlah ?? 1 }} unit</small>
                            </td>
                            <td class="text-muted">{{ $item->tanggal_pinjam ?? $item->created_at ?? '-' }}</td>
                            <td>
                                @if($item->status === 'Pending')
                                    <span class="badge bg-warning-subtle text-warning-emphasis rounded-pill px-2.5 py-1 fw-semibold fs-8">Menunggu</span>
                                @elseif($item->status === 'Dipinjam' || $item->status === 'Disetujui')
                                    <span class="badge bg-warning-subtle text-warning-emphasis rounded-pill px-2.5 py-1 fw-semibold fs-8">Dipinjam</span>
                                @elseif($item->status === 'Dikembalikan')
                                    <span class="badge bg-success-subtle text-success rounded-pill px-2.5 py-1 fw-semibold fs-8">Selesai</span>
                                @else
                                    <span class="badge bg-secondary-subtle text-secondary rounded-pill px-2.5 py-1 fw-semibold fs-8">{{ $item->status }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted fs-7">
                                Belum ada riwayat peminjaman alat. Silakan ajukan peminjaman baru di atas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<style>
    /* Styling Banner Nuansa Kuning Emas / Amber */
    .gold-banner {
        background: linear-gradient(135deg, #b45309 0%, #d97706 50%, #92400e 100%);
        position: relative;
        overflow: hidden;
    }

    .banner-pattern {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background-image: radial-gradient(rgba(255, 255, 255, 0.12) 1px, transparent 1px);
        background-size: 20px 20px;
        opacity: 0.6;
        pointer-events: none;
    }

    .banner-glow {
        position: absolute;
        top: -60px;
        right: -60px;
        width: 220px;
        height: 220px;
        background: rgba(254, 240, 138, 0.25);
        filter: blur(60px);
        border-radius: 50%;
        pointer-events: none;
    }

    /* Icon Box Dekoratif Multi-Layer di Banner */
    .banner-icon-box {
        position: relative;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 110px;
        height: 110px;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 28px;
        font-size: 3rem;
        color: #ffffff;
        transform: rotate(6deg);
        transition: transform 0.3s ease;
    }

    .banner-icon-box:hover {
        transform: rotate(0deg) scale(1.05);
    }

    .floating-badge-1 {
        position: absolute;
        bottom: -10px;
        right: -10px;
        width: 38px;
        height: 38px;
        background: #ffffff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .floating-badge-2 {
        position: absolute;
        top: -10px;
        left: -10px;
        width: 34px;
        height: 34px;
        background: #ffffff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .backdrop-blur {
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
    }

    /* Stat Cards */
    .stat-card {
        border: 1px solid var(--bs-border-color-translucent) !important;
        transition: all 0.25s ease;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        border-color: #d97706 !important;
        box-shadow: 0 0.75rem 1.5rem rgba(217, 119, 6, 0.1) !important;
    }

    .stat-icon-box {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
    }

    .hover-lift {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .hover-lift:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }

    @keyframes pulseAnimation {
        0% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.4; transform: scale(1.2); }
        100% { opacity: 1; transform: scale(1); }
    }
    .animate-pulse {
        animation: pulseAnimation 2s infinite ease-in-out;
    }

    .fs-7 { font-size: 0.875rem; line-height: 1.4; }
    .fs-8 { font-size: 0.75rem; }
    .fs-9 { font-size: 0.55rem; }
    .tracking-wider { letter-spacing: 0.06em; }
    .tracking-wide { letter-spacing: 0.04em; }
</style>
@endsection