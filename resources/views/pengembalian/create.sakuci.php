@extends('layouts.app')

@section('title', config('app.name') . ' -- Tambah Pengembalian')

@section('content')
<div class="container-fluid py-4 px-4">
    
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <h3 class="fw-bold mb-1 tracking-tight">Tambah Pengembalian</h3>
            <p class="text-body-secondary small mb-0">Catat transaksi pengembalian alat baru.</p>
        </div>
        <a href="{{ route('pengembalian.index') }}" class="btn btn-outline-secondary btn-sm px-3 py-2 rounded-3 d-inline-flex align-items-center gap-2">
            <i class="bi bi-arrow-left"></i>
            <span class="fw-medium">Kembali</span>
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <form action="{{ route('pengembalian.store') }}" method="POST">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="id_peminjaman" class="form-label fw-semibold fs-7">Pilih Peminjaman</label>
                        <select name="id_peminjaman" id="id_peminjaman" class="form-select rounded-3 shadow-2xs" required>
                            <option value="" disabled selected>-- Pilih Data Peminjaman --</option>
                            @foreach($peminjaman as $p)
                                @php
                                    $pid = $p->id_peminjaman ?? $p->id;
                                    $uname = $userList[$p->id_user] ?? 'User #'.$p->id_user;
                                    $alatName = $alatList[$p->id_alat] ?? 'Alat #'.$p->id_alat;
                                @endphp
                                <option value="{{ $pid }}" {{ old('id_peminjaman') == $pid ? 'selected' : '' }}>
                                    ID #{{ $pid }} - {{ $uname }} ({{ $alatName }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="tanggal_pengembalian" class="form-label fw-semibold fs-7">Tanggal Pengembalian</label>
                        <input type="datetime-local" name="tanggal_pengembalian" id="tanggal_pengembalian" class="form-control rounded-3" value="{{ old('tanggal_pengembalian', date('Y-m-d\TH:i')) }}" required>
                    </div>

                    <div class="col-md-4">
                        <label for="terlambat_hari" class="form-label fw-semibold fs-7">Terlambat (Hari)</label>
                        <input type="number" min="0" name="terlambat_hari" id="terlambat_hari" class="form-control rounded-3" value="{{ old('terlambat_hari', 0) }}">
                    </div>

                    <div class="col-md-4">
                        <label for="denda" class="form-label fw-semibold fs-7">Denda (Rp)</label>
                        <input type="number" min="0" name="denda" id="denda" class="form-control rounded-3" value="{{ old('denda', 0) }}">
                    </div>

                    <div class="col-md-4">
                        <label for="kondisi_barang" class="form-label fw-semibold fs-7">Kondisi Barang</label>
                        <select name="kondisi_barang" id="kondisi_barang" class="form-select rounded-3">
                            <option value="Baik" {{ old('kondisi_barang') == 'Baik' ? 'selected' : '' }}>Baik</option>
                            <option value="Rusak Ringan" {{ old('kondisi_barang') == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                            <option value="Rusak Berat" {{ old('kondisi_barang') == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                            <option value="Hilang" {{ old('kondisi_barang') == 'Hilang' ? 'selected' : '' }}>Hilang</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label for="catatan" class="form-label fw-semibold fs-7">Catatan</label>
                        <textarea name="catatan" id="catatan" rows="3" class="form-control rounded-3" placeholder="Tambahkan catatan jika ada...">{{ old('catatan') }}</textarea>
                    </div>

                    <div class="col-12 d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('pengembalian.index') }}" class="btn btn-light px-4 py-2 rounded-3 fw-medium">Batal</a>
                        <button type="submit" class="btn btn-primary px-4 py-2 rounded-3 shadow-sm fw-medium">Simpan Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection