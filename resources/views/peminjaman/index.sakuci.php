@extends('layouts.app')

@section('title', config('app.name') . ' -- Daftar Peminjaman')

@section('content')
<div class="container-fluid py-4 px-4">
    
    <!-- Header Halaman & Tombol Tambah -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <h3 class="fw-bold mb-1 tracking-tight">Daftar Peminjaman Alat</h3>
            <p class="text-body-secondary small mb-0">Kelola data peminjaman dan status pengembalian alat inventaris.</p>
        </div>
        <a href="{{ route('peminjaman.create') }}" class="btn btn-primary btn-sm px-3 py-2 rounded-3 shadow-sm d-inline-flex align-items-center gap-2">
            <i class="bi bi-plus-lg"></i>
            <span class="fw-medium">Tambah Peminjaman Baru</span>
        </a>
    </div>

    <!-- Alert Notifikasi Sukses -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-check-circle-fill text-success fs-5"></i>
                <div class="small fw-medium">{{ session('success') }}</div>
            </div>
            <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Card Pembungkus Tabel -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-body-tertiary border-bottom text-body-secondary text-uppercase fs-8 tracking-wider">
                        <tr>
                            <th class="py-3 px-4 text-center" style="width: 5%;">No</th>
                            <th class="py-3 px-3">Peminjam</th>
                            <th class="py-3 px-3">Nama Alat</th>
                            <th class="py-3 px-3">Jumlah</th>
                            <th class="py-3 px-3">Tgl Pinjam</th>
                            <th class="py-3 px-3">Tgl Kembali</th>
                            <th class="py-3 px-3">Status</th>
                            <th class="py-3 px-3">Denda</th>
                            <th class="py-3 px-4 text-center" style="width: 200px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @forelse ($datap as $peminjaman)
                        <tr>
                            <td class="px-4 text-center text-body-secondary fw-medium fs-7">{{ $no++ }}</td>
                            <td class="px-3">
                                <div class="fw-semibold text-body fs-7">{{ $peminjaman->user->nama ?? 'User ID: ' . $peminjaman->id_user }}</div>
                            </td>
                            <td class="px-3">
                                <div class="fw-medium text-body-secondary fs-7">{{ $peminjaman->alat->nama_alat ?? 'Alat ID: ' . $peminjaman->id_alat }}</div>
                            </td>
                            <td class="px-3">
                                <span class="badge bg-body-tertiary text-body border fw-semibold px-2.5 py-1.5 rounded-2 fs-8">{{ $peminjaman->jumlah }} Unit</span>
                            </td>
                            <td class="px-3">
                                <span class="text-body-secondary fs-7">{{ $peminjaman->tanggal_pinjam }}</span>
                            </td>
                            <td class="px-3">
                                <span class="text-body-secondary fs-7">{{ $peminjaman->tanggal_kembali ?? '-' }}</span>
                            </td>
                            <td class="px-3">
                                @if($peminjaman->status == 'Pending')
                                    <span class="badge bg-warning-subtle text-warning-emphasis fw-semibold px-2.5 py-1.5 rounded-pill fs-8">Pending</span>
                                @elseif($peminjaman->status == 'Disetujui')
                                    <span class="badge bg-info-subtle text-info-emphasis fw-semibold px-2.5 py-1.5 rounded-pill fs-8">Disetujui</span>
                                @elseif($peminjaman->status == 'Ditolak')
                                    <span class="badge bg-danger-subtle text-danger-emphasis fw-semibold px-2.5 py-1.5 rounded-pill fs-8">Ditolak</span>
                                @elseif($peminjaman->status == 'Dipinjam')
                                    <span class="badge bg-primary-subtle text-primary-emphasis fw-semibold px-2.5 py-1.5 rounded-pill fs-8">Dipinjam</span>
                                @else
                                    <span class="badge bg-success-subtle text-success-emphasis fw-semibold px-2.5 py-1.5 rounded-pill fs-8">Dikembalikan</span>
                                @endif
                            </td>
                            <td class="px-3">
                                <span class="text-danger fw-semibold fs-7">Rp {{ number_format($peminjaman->denda ?? 0, 0, ',', '.') }}</span>
                            </td>
                            <td class="px-4 text-center">
                                <div class="d-inline-flex align-items-center justify-content-center gap-2">
                                    <a href="{{ route('peminjaman.edit', ['id_peminjaman' => $peminjaman->id_peminjaman]) }}" class="btn btn-sm btn-outline-warning fw-semibold px-3 py-1.5 rounded-3 d-inline-flex align-items-center gap-1.5 fs-7 shadow-2xs">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <form action="{{ route('peminjaman.delete', ['id_peminjaman' => $peminjaman->id_peminjaman]) }}" method="POST" class="d-inline m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger fw-semibold px-3 py-1.5 rounded-3 d-inline-flex align-items-center gap-1.5 fs-7 shadow-2xs" onclick="return confirm('Apakah Anda yakin ingin menghapus data peminjaman ini?')">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-5 text-body-secondary">
                                <div class="d-flex flex-column align-items-center gap-2">
                                    <i class="bi bi-inbox fs-2 opacity-50"></i>
                                    <span class="fs-7">Belum ada data peminjaman alat yang ditambahkan.</span>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Bagian Pagination di Bawah Card -->
        @if(method_exists($datap, 'hasPages') && $datap->hasPages())
        <div class="card-footer bg-transparent py-3 border-top-0 d-flex justify-content-end">
            {!! $datap->links() !!}
        </div>
        @endif
    </div>

</div>
@endsection