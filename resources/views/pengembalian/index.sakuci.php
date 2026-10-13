@extends('layouts.app')

@section('title', config('app.name') . ' -- Data Pengembalian')

@section('content')
<div class="container-fluid py-4 px-4">

    <!-- Flash Alert -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4 d-flex align-items-center" role="alert">
            <i class="bi bi-check-circle-fill me-2 fs-5"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Header Halaman & Tombol Tambah -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <h3 class="fw-bold mb-1 tracking-tight">Data Pengembalian</h3>
            <p class="text-body-secondary small mb-0">Kelola riwayat pengembalian barang dan denda keterlambatan.</p>
        </div>
        <a href="{{ route('pengembalian.create') }}" class="btn btn-primary btn-sm px-3 py-2 rounded-3 shadow-sm d-inline-flex align-items-center gap-2 fw-medium">
            <i class="bi bi-plus-lg"></i>
            <span>Tambah Pengembalian</span>
        </a>
    </div>

    <!-- Tabel Data Pengembalian -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-body-tertiary border-bottom text-body-secondary text-uppercase fs-8 tracking-wider">
                        <tr>
                            <th class="py-3 px-4 text-center" style="width: 5%;">No</th>
                            <th class="py-3 px-3">Peminjam & Alat</th>
                            <th class="py-3 px-3">Tgl Pengembalian</th>
                            <th class="py-3 px-3">Terlambat</th>
                            <th class="py-3 px-3">Denda</th>
                            <th class="py-3 px-3">Kondisi Barang</th>
                            <th class="py-3 px-3">Catatan</th>
                            <th class="py-3 px-4 text-center" style="width: 180px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($datap as $index => $d)
                            @php
                                $p = $peminjamanList[$d->id_peminjaman] ?? null;
                                $uname = $p ? ($userList[$p->id_user] ?? '-') : '-';
                                $alatName = $p ? ($alatList[$p->id_alat] ?? '-') : '-';

                                $kondisi = $d->kondisi_barang ?? 'Baik';
                                // Menggunakan -emphasis agar otomatis kontras dan pas di Mode Terang maupun Gelap
                                $badgeKondisi = match($kondisi) {
                                    'Baik' => 'bg-success-subtle text-success-emphasis border border-success-subtle',
                                    'Rusak Ringan' => 'bg-warning-subtle text-warning-emphasis border border-warning-subtle',
                                    'Rusak Berat', 'Hilang' => 'bg-danger-subtle text-danger-emphasis border border-danger-subtle',
                                    default => 'bg-secondary-subtle text-secondary-emphasis border border-secondary-subtle'
                                };
                            @endphp
                            <tr>
                                <td class="px-4 text-center text-body-secondary fw-medium fs-7">{{ $index + 1 }}</td>
                                
                                <td class="px-3">
                                    <div class="fw-semibold text-body fs-7">{{ $uname }}</div>
                                    <div class="small text-body-secondary">{{ $alatName }} <span class="badge bg-secondary-subtle text-secondary rounded-pill">#{{ $d->id_peminjaman }}</span></div>
                                </td>

                                <td class="px-3">
                                    <span class="text-body-secondary fs-7">{{ $d->tanggal_pengembalian }}</span>
                                </td>

                                <td class="px-3">
                                    @if($d->terlambat_hari > 0)
                                        <span class="badge bg-danger-subtle text-danger-emphasis border border-danger-subtle rounded-2 px-2.5 py-1.5 fs-8 fw-semibold">
                                            {{ $d->terlambat_hari }} Hari
                                        </span>
                                    @else
                                        <span class="badge bg-success-subtle text-success-emphasis border border-success-subtle rounded-2 px-2.5 py-1.5 fs-8 fw-semibold">
                                            Tepat Waktu
                                        </span>
                                    @endif
                                </td>

                                <td class="px-3">
                                    <span class="text-danger fw-semibold fs-7">Rp {{ number_format($d->denda, 0, ',', '.') }}</span>
                                </td>

                                <td class="px-3">
                                    <span class="badge {{ $badgeKondisi }} px-2.5 py-1.5 rounded-2 fs-8 fw-semibold">
                                        {{ $kondisi }}
                                    </span>
                                </td>

                                <td class="px-3">
                                    <span class="text-body-secondary fs-7">{{ $d->catatan ?? '-' }}</span>
                                </td>

                                <td class="px-4 text-center">
                                    <div class="d-inline-flex align-items-center justify-content-center gap-2">
                                        <!-- Tombol Edit -->
                                        <a href="{{ route('pengembalian.edit', [$d->id_pengembalian]) }}" class="btn btn-sm btn-outline-warning fw-semibold px-3 py-1.5 rounded-3 d-inline-flex align-items-center gap-1.5 fs-7 shadow-2xs" title="Edit">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>

                                        <!-- Tombol Hapus -->
                                        <form action="{{ route('pengembalian.delete', [$d->id_pengembalian]) }}" method="POST" class="d-inline m-0" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-danger fw-semibold px-3 py-1.5 rounded-3 d-inline-flex align-items-center gap-1.5 fs-7 shadow-2xs" title="Hapus">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-body-secondary">
                                    <div class="d-flex flex-column align-items-center gap-2">
                                        <i class="bi bi-inbox fs-2 opacity-50"></i>
                                        <span class="fs-7">Belum ada data pengembalian.</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection