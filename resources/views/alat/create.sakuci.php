@extends ('layouts.app')

@section ('content')

<div class="container">
    <h1>Tambah alat</h1>
    <form action="{{ route('alat.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
        <label for="nama">Nama alat</label>
            <input type="text" name="nama_alat" id="nama_alat" class="form-control" required>

            <label for="nama">Kode alat</label>
            <input type="text" name="kode_alat" id="kode_alat" class="form-control" required>

        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <button type="button" class="btn btn-secondary" onclick="window.location='{{ route('alat.index') }}'">Batal</button>
    </form>
@endsection