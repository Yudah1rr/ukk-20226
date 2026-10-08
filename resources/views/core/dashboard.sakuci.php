@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="py-4">
        <!-- Welcome Banner / Header Section -->
        <div class="row align-items-center mb-4">
            <div class="col">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <span class="badge rounded-pill bg-light text-dark border px-3 py-1.5 fw-semibold shadow-sm">
                        <i class="bi bi-shield-check text-primary me-1"></i> Role: {{ ucfirst($user->role) }}
                    </span>
                </div>
                <h1 class="h3 fw-bold text-dark mb-1">Halo, {{ $user->username }} 👋</h1>
                <p class="text-muted mb-0">Selamat datang kembali! Ini adalah halaman dashboard umum untuk semua pengguna.</p>
            </div>
        </div>

        <!-- Quick Info / Accent Divider -->
        <hr class="text-muted opacity-25 my-4">

        <!-- Optional: Tambahan Card Minimalis untuk Statistik Cepat atau Informasi -->
        <div class="row g-3">
            <div class="col-md-6 col-lg-4">
                <div class="p-3 rounded-4 bg-white border border-light shadow-sm d-flex align-items-center gap-3">
                    <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-3">
                        <i class="bi bi-person-badge fs-4"></i>
                    </div>
                    <div>
                        <small class="text-muted d-block">Status Akun</small>
                        <span class="fw-semibold text-dark">Aktif & Terverifikasi</span>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4">
                <div class="p-3 rounded-4 bg-white border border-light shadow-sm d-flex align-items-center gap-3">
                    <div class="bg-success bg-opacity-10 text-success p-3 rounded-3">
                        <i class="bi bi-clock-history fs-4"></i>
                    </div>
                    <div>
                        <small class="text-muted d-block">Login Terakhir</small>
                        <span class="fw-semibold text-dark">Hari ini</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection