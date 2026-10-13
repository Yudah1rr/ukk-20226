@extends('layouts.app')

@section('title', 'Kembalikan Alat')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="fw-bold">Kembalikan Alat</h2>
            <p class="text-muted">Silakan isi form di bawah ini untuk mengembalikan alat yang telah selesai dipinjam.</p>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            
            {{-- Jika tidak ada barang yang sedang dipinjam/disetujui --}}
            @if(empty($peminjamanAktif) || count($peminjamanAktif) === 0)
                <div class="alert alert-info border-0 shadow-sm rounded-3 d-flex align-items-center gap-3 p-3 mb-0">
                    <i class="bi bi-info-circle-fill fs-4 text-primary"></i>
                    <div>
                        Kamu tidak memiliki alat yang berstatus <strong>Sedang Dipinjam</strong> saat ini. Pastikan peminjamanmu sudah disetujui oleh admin/petugas.
                    </div>
                </div>
            @else
                {{-- Form Pengembalian --}}
                <form action="{{ route('peminjam.pengembalian.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="id_peminjaman" class="form-label fw-semibold">Pilih Alat yang Ingin Dikembalikan <span class="text-danger">*</span></label>
                        <select name="id_peminjaman" id="id_peminjaman" class="form-select @error('id_peminjaman') is-invalid @enderror" required>
                            <option value="">-- Pilih Alat dari Daftar Pinjaman --</option>
                            @foreach($peminjamanAktif as $p)
                                <option value="{{ $p->id_peminjaman ?? $p->id }}">
                                    📦 {{ $p->alat->nama_alat ?? ($p->alat->nama ?? ($p->nama_alat ?? 'Alat ID: ' . $p->id_alat)) }} (Status: {{ ucfirst($p->status) }})
                                </option>
                            @endforeach
                        </select>
                        @error('id_peminjaman')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_pengembalian" class="form-label fw-semibold">Tanggal Pengembalian <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_pengembalian" id="tanggal_pengembalian" class="form-control" value="{{ date('Y-m-d') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="kondisi_barang" class="form-label fw-semibold">Kondisi Barang Saat Dikembalikan</label>
                        <select name="kondisi_barang" id="kondisi_barang" class="form-select">
                            <option value="Baik">Baik (Normal)</option>
                            <option value="Ringan Rusak">Ada Kerusakan Ringan</option>
                            <option value="Rusak">Rusak / Tidak Berfungsi</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="catatan" class="form-label fw-semibold">Catatan Tambahan (Opsional)</label>
                        <textarea name="catatan" id="catatan" rows="3" class="form-control" placeholder="Tuliskan keterangan tambahan jika diperlukan..."></textarea>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('peminjam.dashboard') }}" class="btn btn-light px-4">Batal</a>
                        <button type="submit" class="btn btn-primary px-4">Kirim Pengembalian</button>
                    </div>
                </form>
            @endif

        </div>
    </div>
</div>
@endsection