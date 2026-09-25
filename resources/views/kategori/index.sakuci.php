@extends('layouts.app')

@section('title', config('app.name') . ' -- Daftar Kategori Lab')

@section('content')
<div class="container-xxl py-4">
    
    <!-- Top Header Banner -->
    <div class="row align-items-center mb-4">
        <div class="col-md-7">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1 small">
                    <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-muted">Dashboard</a></li>
                    <li class="breadcrumb-item active text-primary fw-semibold" aria-current="page">Kategori Lab</li>
                </ol>
            </nav>
            <h2 class="fw-bold mb-0">Manajemen Kategori Laboratorium</h2>
        </div>
        <div class="col-md-5 text-md-end mt-3 mt-md-0">
            <a href="{{ route('kategori.create') }}" class="btn btn-primary px-4 py-2.5 rounded-3 shadow-sm d-inline-flex align-items-center gap-2 fw-semibold">
                <i class="bi bi-plus-circle-fill fs-5"></i> Tambah Kategori Baru
            </a>
        </div>
    </div>

    <!-- Main Card Container -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        
        <!-- Filter / Search Mini Header -->
        <div class="card-header py-3 px-4 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div class="d-flex align-items-center gap-2">
                <div class="bg-primary bg-opacity-10 text-primary p-2 rounded-3">
                    <i class="bi bi-tags fs-5"></i>
                </div>
                <div>
                    <h6 class="fw-bold mb-0">Total Kategori Lab</h6>
                    <span class="text-muted small">Kelompok klasifikasi perangkat dan bahan laboratorium</span>
                </div>
            </div>
            <div class="badge bg-secondary bg-opacity-10 text-body border px-3 py-2 rounded-pill fw-medium">
                <i class="bi bi-database me-1 text-primary"></i> {{ $data->total() }} Kategori Tersedia
            </div>
        </div>

        <!-- Table Wrapper -->
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="text-uppercase fs-7 text-muted fw-bold">
                        <tr>
                            <th class="py-3 px-4" style="width: 7%;">No</th>
                            <th class="py-3">Nama Kategori</th>
                            <th class="py-3">Kode Kategori</th>
                            <th class="py-3">Keterangan</th>
                            <th class="py-3 text-center" style="width: 20%;">Aksi Cepat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $index => $kategoris)
                        <tr>
                            <!-- Nomor (Mendukung Paginator Laravel) -->
                            <td class="px-4 py-3">
                                <span class="badge bg-secondary bg-opacity-10 text-body fw-bold px-2.5 py-2 rounded-2">
                                    {{ $data->firstItem() + $index }}
                                </span>
                            </td>
                            
                            <!-- Nama Kategori -->
                            <td class="py-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; min-width: 38px;">
                                        <i class="bi bi-tag-fill fs-6"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-0">{{ $kategoris->nama_kategori }}</h6>
                                        <span class="text-muted" style="font-size: 0.75rem;">ID Kategori: #{{ $kategoris->id_kategori }}</span>
                                    </div>
                                </div>
                            </td>

                            <!-- Kode Kategori -->
                            <td class="py-3">
                                <code class="text-primary bg-primary bg-opacity-10 px-2.5 py-1 rounded-2 fw-semibold">
                                    {{ $kategoris->kode_kategori }}
                                </code>
                            </td>

                            <!-- Keterangan -->
                            <td class="py-3 text-muted">
                                {{ $kategoris->keterangan ?: 'Tidak ada keterangan tambahan.' }}
                            </td>

                            <!-- Tombol Aksi -->
                            <td class="text-center py-3">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('kategori.edit', ['kategori' => $kategoris->id_kategori]) }}" class="btn btn-outline-warning btn-sm px-3 py-1.5 rounded-2 fw-semibold d-inline-flex align-items-center gap-1" title="Edit Data">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <form action="{{ route('kategori.delete', ['id' => $kategoris->id_kategori]) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm px-3 py-1.5 rounded-2 fw-semibold d-inline-flex align-items-center gap-1" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')" title="Hapus Data">
                                            <i class="bi bi-trash3"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="py-4">
                                    <div class="mb-3 text-muted opacity-50">
                                        <i class="bi bi-folder2-open display-4"></i>
                                    </div>
                                    <h5 class="fw-bold text-secondary">Belum Ada Data Kategori</h5>
                                    <p class="text-muted small mb-3">Silakan tambahkan data kategori terlebih dahulu melalui tombol di atas.</p>
                                    <a href="{{ route('kategori.create') }}" class="btn btn-sm btn-primary px-3 rounded-pill">Tambah Sekarang</a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination Footer -->
        @if($data->hasPages())
        <div class="card-footer py-3 px-4 d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 border-top">
            <div class="text-muted small">
                Menampilkan <span class="fw-bold text-body">{{ $data->firstItem() ?? 0 }}</span> sampai <span class="fw-bold text-body">{{ $data->lastItem() ?? 0 }}</span> dari total <span class="fw-bold text-body">{{ $data->total() }}</span> data
            </div>
            <div>
                {!! $data->links() !!}
            </div>
        </div>
        @endif
    </div>
</div>
@endsection