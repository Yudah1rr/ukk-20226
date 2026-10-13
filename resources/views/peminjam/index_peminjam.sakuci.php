@extends('layouts.app')

@section('title', config('app.name') . ' -- Riwayat Pengajuan Peminjaman')

@section('content')
<div class="container-fluid py-4 px-4">
    
    <!-- Header Halaman & Tombol Ajukan Baru -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <h3 class="fw-bold mb-1 tracking-tight">Riwayat Peminjaman Alat</h3>
            <p class="text-body-secondary small mb-0">Daftar pengajuan peminjaman alat yang telah Anda kirimkan.</p>
        </div>
        <a href="{{ route('peminjam.createPeminjam') }}" class="btn btn-primary btn-sm px-3 py-2 rounded-3 shadow-sm d-inline-flex align-items-center gap-2">
            <i class="bi bi-plus-lg"></i>
            <span class="fw-medium">Ajukan Peminjaman Baru</span>
        </a>
    </div>

    <!-- Card Pembungkus Tabel -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-body-tertiary border-bottom text-body-secondary text-uppercase fs-8 tracking-wider">
                        <tr>
                            <th class="py-3 px-4 text-center" style="width: 5%;">No</th>
                            <th class="py-3 px-3">Nama Alat</th>
                            <th class="py-3 px-3">Jumlah</th>
                            <th class="py-3 px-3">Tgl Pinjam</th>
                            <th class="py-3 px-3">Tgl Kembali</th>
                            <th class="py-3 px-3">Status</th>
                            <th class="py-3 px-3">Denda</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @forelse ($datap as $peminjaman)
                        @php
                            // Ambil nama alat dengan aman (melalui relasi atau cari manual berdasarkan id_alat)
                            $alatObj = $peminjaman->alat ?? \App\Models\Alat::find($peminjaman->id_alat ?? null);
                            $namaAlatFinal = $alatObj->nama_alat ?? $alatObj->nama ?? $alatObj->name ?? ('Alat #' . ($peminjaman->id_alat ?? ''));
                        @endphp
                        <tr>
                            <td class="px-4 text-center text-body-secondary fw-medium fs-7">{{ $no++ }}</td>
                            <td class="px-3">
                                <div class="fw-semibold text-body fs-7"> {{ $namaAlatFinal }}</div>
                            </td>
                            <td class="px-3">
                                <span class="badge bg-body-tertiary text-body border font-monospace fw-semibold px-2.5 py-1.5 rounded-2 fs-8">
                                    {{ $peminjaman->jumlah }} Unit
                                </span>
                            </td>
                            <td class="px-3">
                                <span class="text-body-secondary fs-7">{{ $peminjaman->tanggal_pinjam }}</span>
                            </td>
                            <td class="px-3">
                                <span class="text-body-secondary fs-7">{{ $peminjaman->tanggal_kembali ?? '-' }}</span>
                            </td>
                            <td class="px-3">
                                @if($peminjaman->status == 'Pending')
                                    <span class="badge bg-warning-subtle text-warning-emphasis fw-semibold px-2.5 py-1.5 rounded-2 fs-8">Pending (Menunggu)</span>
                                @elseif($peminjaman->status == 'Disetujui')
                                    <span class="badge bg-info-subtle text-info-emphasis fw-semibold px-2.5 py-1.5 rounded-2 fs-8">Disetujui</span>
                                @elseif($peminjaman->status == 'Ditolak')
                                    <span class="badge bg-danger-subtle text-danger-emphasis fw-semibold px-2.5 py-1.5 rounded-2 fs-8">Ditolak</span>
                                @elseif($peminjaman->status == 'Dipinjam')
                                    <span class="badge bg-primary-subtle text-primary-emphasis fw-semibold px-2.5 py-1.5 rounded-2 fs-8">Sedang Dipinjam</span>
                                @else
                                    <span class="badge bg-success-subtle text-success-emphasis fw-semibold px-2.5 py-1.5 rounded-2 fs-8">Dikembalikan</span>
                                @endif
                            </td>
                            <td class="px-3">
                                <span class="text-danger fw-semibold fs-7">Rp {{ number_format($peminjaman->denda ?? 0, 0, ',', '.') }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-body-secondary">
                                <div class="d-flex flex-column align-items-center gap-2">
                                    <i class="bi bi-inbox fs-2 opacity-50"></i>
                                    <span class="fs-7">Belum ada riwayat pengajuan peminjaman alat.</span>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Bagian Pagination -->
        @if(method_exists($datap, 'hasPages') && $datap->hasPages())
        <div class="card-footer bg-transparent py-3 border-top-0 d-flex justify-content-end">
            {!! $datap->links() !!}
        </div>
        @endif
    </div>

</div>
@endsection