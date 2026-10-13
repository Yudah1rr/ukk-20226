@extends('layouts.app')

@section('title', config('app.name') . ' -- Edit Pengembalian')

@section('content')
<div class="container-fluid py-4 px-4">
    
    <!-- Header Halaman & Tombol Kembali -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <h3 class="fw-bold mb-1 tracking-tight">Edit Data Pengembalian</h3>
            <p class="text-body-secondary small mb-0">Perbarui informasi pengembalian alat dan denda.</p>
        </div>
        <a href="{{ route('pengembalian.index') }}" class="btn btn-outline-secondary btn-sm px-3 py-2 rounded-3 d-inline-flex align-items-center gap-2">
            <i class="bi bi-arrow-left"></i>
            <span class="fw-medium">Kembali</span>
        </a>
    </div>

    <!-- Card Form Edit -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <form action="{{ route('pengembalian.update', [$datap->id_pengembalian]) }}" method="POST">
                @csrf

                <div class="row g-3">
                    <!-- Peminjaman Locked / Readonly -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold fs-7 text-body-secondary">Data Peminjaman</label>
                        <!-- Hidden input agar id_peminjaman tetap terkirim saat form disimpan -->
                        <input type="hidden" name="id_peminjaman" value="{{ $datap->id_peminjaman }}">
                        <!-- Display Input Readonly -->
                        <input type="text" class="form-control rounded-3 bg-dark-subtle text-body border-secondary-subtle opacity-75" value="ID #{{ $datap->id_peminjaman }} - {{ $peminjamName }} ({{ $alatName }})" readonly disabled>
                    </div>

                    <!-- Tanggal Pengembalian -->
                    <div class="col-md-6">
                        <label for="tanggal_pengembalian" class="form-label fw-semibold fs-7">Tanggal Pengembalian</label>
                        <input type="datetime-local" name="tanggal_pengembalian" id="tanggal_pengembalian" class="form-control rounded-3" value="{{ old('tanggal_pengembalian', date('Y-m-d\TH:i', strtotime($datap->tanggal_pengembalian))) }}" required>
                    </div>

                    <!-- Terlambat (Hari) -->
                    <div class="col-md-4">
                        <label for="terlambat_hari" class="form-label fw-semibold fs-7">Terlambat (Hari)</label>
                        <input type="number" min="0" name="terlambat_hari" id="terlambat_hari" class="form-control rounded-3" value="{{ old('terlambat_hari', $datap->terlambat_hari ?? 0) }}">
                    </div>

                    <!-- Denda -->
                    <div class="col-md-4">
                        <label for="denda" class="form-label fw-semibold fs-7">Denda (Rp)</label>
                        <input type="number" min="0" name="denda" id="denda" class="form-control rounded-3" value="{{ old('denda', $datap->denda ?? 0) }}">
                    </div>

                    <!-- Kondisi Barang -->
                    <div class="col-md-4">
                        <label for="kondisi_barang" class="form-label fw-semibold fs-7">Kondisi Barang</label>
                        <select name="kondisi_barang" id="kondisi_barang" class="form-select rounded-3">
                            <option value="Baik" {{ old('kondisi_barang', $datap->kondisi_barang) == 'Baik' ? 'selected' : '' }}>Baik</option>
                            <option value="Rusak Ringan" {{ old('kondisi_barang', $datap->kondisi_barang) == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                            <option value="Rusak Berat" {{ old('kondisi_barang', $datap->kondisi_barang) == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                            <option value="Hilang" {{ old('kondisi_barang', $datap->kondisi_barang) == 'Hilang' ? 'selected' : '' }}>Hilang</option>
                        </select>
                    </div>

                    <!-- Catatan -->
                    <div class="col-12">
                        <label for="catatan" class="form-label fw-semibold fs-7">Catatan</label>
                        <textarea name="catatan" id="catatan" rows="3" class="form-control rounded-3" placeholder="Tambahkan catatan jika ada...">{{ old('catatan', $datap->catatan) }}</textarea>
                    </div>

                    <!-- Tombol Simpan -->
                    <div class="col-12 d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('pengembalian.index') }}" class="btn btn-light px-4 py-2 rounded-3 fw-medium">Batal</a>
                        <button type="submit" class="btn btn-primary px-4 py-2 rounded-3 shadow-sm fw-medium">Simpan Perubahan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection