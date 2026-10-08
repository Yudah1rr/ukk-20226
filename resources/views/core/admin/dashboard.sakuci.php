@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

    <!-- Background Gradasi Lembut untuk Mendukung Efek Glass -->
    <div class="position-absolute top-0 start-0 w-100 h-100 overflow-hidden pointer-events-none" style="z-index: -1; opacity: 0.6;">
        <div class="position-absolute top-0 start-25 bg-primary rounded-circle blur-3xl opacity-10" style="width: 400px; height: 400px; filter: blur(80px);"></div>
        <div class="position-absolute top-50 end-25 bg-danger rounded-circle blur-3xl opacity-10" style="width: 400px; height: 400px; filter: blur(80px);"></div>
    </div>

    <div class="py-4 position-relative">
        <!-- Header Banner dengan Glass Style -->
        <div class="glass-card p-4 rounded-4 mb-4">
            <div class="row align-items-center">
                <div class="col">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="badge rounded-pill bg-danger bg-opacity-20 text-danger border border-danger border-opacity-25 px-3 py-1.5 fw-semibold shadow-sm">
                            <i class="bi bi-shield-lock-fill me-1"></i> Area Admin
                        </span>
                    </div>
                    <h1 class="h3 fw-bold text-dark mb-1">Halo, {{ $user->username }} 🛡️</h1>
                    <p class="text-secondary mb-0">Halaman khusus kontrol sistem yang dilindungi oleh middleware <code class="text-danger fw-semibold bg-danger bg-opacity-10 px-2 py-0.5 rounded">admin</code>.</p>
                </div>
            </div>
        </div>

        <!-- Grid Menu Aksi Admin dengan Glass Style -->
        <div class="row g-4">
            <!-- Manage Role -->
            <div class="col-md-6 col-lg-4">
                <a href="{{ route('admin.roles.index') }}" class="glass-card card border-0 rounded-4 text-decoration-none h-100 transition-hover p-1">
                    <div class="card-body p-4 d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="bg-primary bg-opacity-20 text-primary p-3 rounded-3 backdrop-blur">
                                    <i class="bi bi-diagram-3-fill fs-4"></i>
                                </div>
                                <i class="bi bi-arrow-right text-muted arrow-icon"></i>
                            </div>
                            <h2 class="h6 fw-bold text-dark mb-1">Manage Role</h2>
                            <p class="text-secondary small mb-0">Tambah role baru untuk dipakai saat membuat user.</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Manage User -->
            <div class="col-md-6 col-lg-4">
                <a href="{{ route('admin.users.index') }}" class="glass-card card border-0 rounded-4 text-decoration-none h-100 transition-hover p-1">
                    <div class="card-body p-4 d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="bg-success bg-opacity-20 text-success p-3 rounded-3 backdrop-blur">
                                    <i class="bi bi-people-fill fs-4"></i>
                                </div>
                                <i class="bi bi-arrow-right text-muted arrow-icon"></i>
                            </div>
                            <h2 class="h6 fw-bold text-dark mb-1">Manage User</h2>
                            <p class="text-secondary small mb-0">Tambah user baru dan tentukan role-nya.</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Download Database -->
            <div class="col-md-6 col-lg-4">
                <a href="{{ route('admin.database.export') }}" class="glass-card card border-0 rounded-4 text-decoration-none h-100 transition-hover p-1">
                    <div class="card-body p-4 d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="bg-warning bg-opacity-20 text-warning p-3 rounded-3 backdrop-blur">
                                    <i class="bi bi-database-down fs-4"></i>
                                </div>
                                <i class="bi bi-arrow-right text-muted arrow-icon"></i>
                            </div>
                            <h2 class="h6 fw-bold text-dark mb-1">Download Database</h2>
                            <p class="text-secondary small mb-0">Unduh seluruh isi database jadi satu file .sql, siap diimpor di server.</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- CSS Khusus untuk Efek Glassmorphism -->
    <style>
        .glass-card {
            background: rgba(255, 255, 255, 0.75) !important;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.6) !important;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.07);
        }
        .transition-hover {
            transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
        }
        .transition-hover:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.95) !important;
            box-shadow: 0 12px 40px 0 rgba(31, 38, 135, 0.12) !important;
            border-color: rgba(255, 255, 255, 1) !important;
        }
        .transition-hover:hover .arrow-icon {
            transform: translateX(4px);
            color: var(--bs-primary) !important;
        }
        .arrow-icon {
            transition: transform 0.2s ease, color 0.2s ease;
        }
    </style>

@endsection