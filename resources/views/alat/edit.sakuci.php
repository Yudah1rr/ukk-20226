@extends('layouts.app')

@section('title', config('app.name') . ' -- Edit Alat Lab')

@section('content')
<div class="container-xxl py-4">
    
    <!-- Top Header Banner -->
    <div class="row align-items-center mb-4">
        <div class="col-md-7">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1 small">
                    <li class="breadcrumb-item"><a href="{{ route('alat.index') }}" class="text-decoration-none text-muted">Inventaris Alat</a></li>
                    <li class="breadcrumb-item active text-primary fw-semibold" aria-current="page">Edit Alat</li>
                </ol>
            </nav>
            <h2 class="fw-bold mb-0">Edit Data Alat Laboratorium</h2>
        </div>
        <div class="col-md-5 text-md-end mt-3 mt-md-0">
            <a href="{{ route('alat.index') }}" class="btn btn-outline-secondary px-4 py-2.5 rounded-3 shadow-sm d-inline-flex align-items-center gap-2 fw-semibold">
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
                    <div class="bg-warning bg-opacity-10 text-warning p-2 rounded-3">
                        <i class="bi bi-pencil-square fs-5"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0">Formulir Perubahan Alat</h6>
                        <span class="text-muted small">Perbarui informasi perangkat lab ID: #{{ $datal->id_alat }}</span>
                    </div>
                </div>

                <!-- Form Body -->
                <div class="card-body p-4">
                    <form action="{{ route('alat.update', ['id_alat' => $datal->id_alat]) }}" method="POST" class="d-flex flex-column gap-3">
                        @csrf
                        @method('PUT')

                        <!-- Nama Alat -->
                        <div>
                            <label for="nama_alat" class="form-label fw-semibold small text-uppercase">Nama Alat</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted border-end-0"><i class="bi bi-cpu"></i></span>
                                <input type="text" name="nama_alat" id="nama_alat" class="form-control border-start-0 ps-0" value="{{ $datal->nama_alat }}" placeholder="Contoh: Oscilloscope Digital" required>
                            </div>
                        </div>
                        
                        <!-- Kode Alat -->
                        <div>
                            <label for="kode_alat" class="form-label fw-semibold small text-uppercase">Kode Perangkat</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted border-end-0"><i class="bi bi-code-slash"></i></span>
                                <input type="text" name="kode_alat" id="kode_alat" class="form-control border-start-0 ps-0" value="{{ $datal->kode_alat }}" placeholder="Contoh: LAB-ELC-001" required>
                            </div>
                        </div>

                        <!-- Kategori -->
                        <div>
                            <label for="id_kategori" class="form-label fw-semibold small text-uppercase">Kategori Lab</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted border-end-0"><i class="bi bi-tag"></i></span>
                                <select name="id_kategori" id="id_kategori" class="form-select border-start-0 ps-0" required>
                                    <option value="">-- Pilih Kategori Lab --</option>
                                    @foreach ($kategori as $k)
                                        <option value="{{ $k->id_kategori }}" {{ $datal->id_kategori == $k->id_kategori ? 'selected' : '' }}>
                                            {{ $k->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                            <a href="{{ route('alat.index') }}" class="btn btn-light px-4 py-2.5 rounded-3 fw-semibold border">Batal</a>
                            <button type="submit" class="btn btn-primary px-4 py-2.5 rounded-3 shadow-sm fw-semibold d-inline-flex align-items-center gap-2">
                                <i class="bi bi-check-circle-fill"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection