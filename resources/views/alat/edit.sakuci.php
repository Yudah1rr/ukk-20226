@extends('layouts.app')
@section('content')
        <h1>Edit alat</h1>
        <form action="{{ route('alat.update', ['alat' => $datal->id_alat]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nama_alat" class="form-label">Nama alat</label>
                <input type="text" class="form-control" id="nama_alat" name="nama_alat" value="{{ $datal->nama_alat }}" required>
                <label for="kode_alat" class="form-label">Kode alat</label>
                <input type="text" class="form-control" id="kode_alat" name="kode_alat" value="{{ $datal->kode_alat }}" required>
               
            </div>
            <button type="submit" class="btn btn-primary m-3">Update</button>
        </form>
    @endsection