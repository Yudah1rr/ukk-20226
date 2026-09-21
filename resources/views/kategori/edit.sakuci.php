@extends('layouts.app')
@section('content')
    <h1>Edit Kategori</h1>
    <form action="{{ route('kategori.update', ['id' => $kategori->id_kategori]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nama_kategori">Keterangan</label>
            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="{{ $kategori->nama_kategori }}" required>
        </div>
        <button type="submit" class="btn btn-primary m-3">Update</button>
    </form>
    @endsection