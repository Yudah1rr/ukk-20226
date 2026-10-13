@extends('layouts.app')

@section('title', config('app.name') . ' -- Daftar Kategori')

@section('content')
<div class="container-fluid py-4 px-4">
    
    <!-- Header Halaman & Tombol Tambah -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <h3 class="fw-bold mb-1 tracking-tight">Daftar Kategori</h3>
            <p class="text-body-secondary small mb-0">Kelola data kategori alat inventaris.</p>
        </div>
        <a href="{{ route('kategori.create') }}" class="btn btn-primary btn-sm px-3 py-2 rounded-3 shadow-sm d-inline-flex align-items-center gap-2 fw-medium">
            <i class="bi bi-plus-lg"></i>
            <span>Tambah Kategori Baru</span>
        </a>
    </div>

    <!-- Card Pembungkus Tabel yang Seragam -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-body-tertiary border-bottom text-body-secondary text-uppercase fs-8 tracking-wider">
                        <tr>
                            <th class="py-3 px-4 text-center" style="width: 5%;">No</th>
                            <th class="py-3 px-3">Nama Kategori</th>
                            <th class="py-3 px-3">Kode Kategori</th>
                            <th class="py-3 px-3">Keterangan</th>
                            <th class="py-3 px-4 text-center" style="width: 180px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @forelse ($data as $kategoris)
                        <tr>
                            <td class="px-4 text-center text-body-secondary fw-medium fs-7">{{ $no++ }}</td>
                            
                            <td class="px-3">
                                <div class="fw-semibold text-body fs-7">{{ $kategoris->nama_kategori }}</div>
                            </td>

                            <td class="px-3">
                                <span class="badge bg-primary-subtle text-primary-emphasis border border-primary-subtle font-monospace fw-semibold px-2.5 py-1.5 rounded-2 fs-8">
                                    {{ $kategoris->kode_kategori }}
                                </span>
                            </td>

                            <td class="px-3">
                                <span class="text-body-secondary fs-7">{{ $kategoris->keterangan ?? '-' }}</span>
                            </td>

                            <td class="px-4 text-center">
                                <div class="d-inline-flex align-items-center justify-content-center gap-2">
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('kategori.edit', ['kategori' => $kategoris->id_kategori]) }}" class="btn btn-sm btn-outline-warning fw-semibold px-3 py-1.5 rounded-3 d-inline-flex align-items-center gap-1.5 fs-7 shadow-2xs" title="Edit">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>

                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('kategori.delete', ['id' => $kategoris->id_kategori]) }}" method="POST" class="d-inline m-0" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger fw-semibold px-3 py-1.5 rounded-3 d-inline-flex align-items-center gap-1.5 fs-7 shadow-2xs" title="Hapus">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-body-secondary">
                                <div class="d-flex flex-column align-items-center gap-2">
                                    <i class="bi bi-inbox fs-2 opacity-50"></i>
                                    <span class="fs-7">Belum ada data kategori yang ditambahkan.</span>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Bagian Pagination -->
        @if(method_exists($data, 'hasPages') && $data->hasPages())
        <div class="card-footer bg-transparent py-3 border-top-0 d-flex justify-content-end">
            {!! $data->links() !!}
        </div>
        @endif
    </div>

</div>
@endsection