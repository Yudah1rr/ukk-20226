@extends ('layouts.app')

@section ('content')

<div class="container">
    <h1>Tambah Kategori</h1>
    <form action="{{ route('kategori.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
        <label for="nama">Nama Kategori</label>
            <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" required>

            <label for="nama">Kode Kategori</label>
            <input type="text" name="kode_kategori" id="kode_kategori" class="form-control" required>

            <label for="nama">Keterangan</label>
            <input type="text" name="keterangan" id="keterangan" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <button type="button" class="btn btn-secondary" onclick="window.location='{{ route('kategori.index') }}'">Batal</button>
    </form>
@endsection