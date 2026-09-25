@extends('layouts.app')

@section('title', config('app.name') . ' -- Tambah Kategori Lab')

@section('content')
<div class="container-xxl py-4">
    
    <!-- Top Header Banner -->
    <div class="row align-items-center mb-4">
        <div class="col-md-7">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1 small">
                    <li class="breadcrumb-item"><a href="{{ route('kategori.index') }}" class="text-decoration-none text-muted">Kategori Lab</a></li>
                    <li class="breadcrumb-item active text-primary fw-semibold" aria-current="page">Tambah Kategori</li>
                </ol>
            </nav>
            <h2 class="fw-bold mb-0">Tambah Data Kategori Laboratorium</h2>
        </div>
        <div class="col-md-5 text-md-end mt-3 mt-md-0">
            <a href="{{ route('kategori.index') }}" class="btn btn-outline-secondary px-4 py-2.5 rounded-3 shadow-sm d-inline-flex align-items-center gap-2 fw-semibold">
                <i class="bi bi-arrow-left fs-5"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Main Card Container -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                
                <!-- Card Header -->
                <div class="card-header py-3 px-4 border-bottom d-flex align-items-center gap-3">
                    <div class="bg-primary bg-opacity-10 text-primary p-2 rounded-3">
                        <i class="bi bi-plus-circle-fill fs-5"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0">Formulir Penambahan Kategori Baru</h6>
                        <span class="text-muted small">Masukkan informasi kelompok kategori lab yang ingin didaftarkan</span>
                    </div>
                </div>

                <!-- Form Body -->
                <div class="card-body p-4">
                    <form action="{{ route('kategori.store') }}" method="POST" class="d-flex flex-column gap-3">
                        @csrf

                        <!-- Nama Kategori -->
                        <div>
                            <label for="nama_kategori" class="form-label fw-semibold small text-uppercase">Nama Kategori</label>
                            <div class="input-group">
                                <span class="input-group-text bg-secondary bg-opacity-10 text-muted border-end-0"><i class="bi bi-tag"></i></span>
                                <input type="text" name="nama_kategori" id="nama_kategori" class="form-control border-start-0 ps-0" value="{{ old('nama_kategori') }}" placeholder="Contoh: Elektronika & Mikrokontroler" required>
                            </div>
                        </div>
                        
                        <!-- Kode Kategori -->
                        <div>
                            <label for="kode_kategori" class="form-label fw-semibold small text-uppercase">Kode Kategori</label>
                            <div class="input-group">
                                <span class="input-group-text bg-secondary bg-opacity-10 text-muted border-end-0"><i class="bi bi-code-slash"></i></span>
                                <input type="text" name="kode_kategori" id="kode_kategori" class="form-control border-start-0 ps-0" value="{{ old('kode_kategori') }}" placeholder="Contoh: CAT-ELC" required>
                            </div>
                        </div>

                        <!-- Keterangan -->
                        <div>
                            <label for="keterangan" class="form-label fw-semibold small text-uppercase">Keterangan</label>
                            <div class="input-group">
                                <span class="input-group-text bg-secondary bg-opacity-10 text-muted border-end-0"><i class="bi bi-card-text"></i></span>
                                <input type="text" name="keterangan" id="keterangan" class="form-control border-start-0 ps-0" value="{{ old('keterangan') }}" placeholder="Contoh: Peralatan praktikum berbasis perangkat keras" required>
                            </div>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                            <a href="{{ route('kategori.index') }}" class="btn btn-light px-4 py-2.5 rounded-3 fw-semibold border">Batal</a>
                            <button type="submit" class="btn btn-primary px-4 py-2.5 rounded-3 shadow-sm fw-semibold d-inline-flex align-items-center gap-2">
                                <i class="bi bi-save-fill"></i> Simpan Kategori Baru
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection