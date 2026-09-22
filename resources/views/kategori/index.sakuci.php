@extends ('layouts.app')

@section ('content')

<div class="container">
    <h1>Data Kategori</h1>
    <a href="{{ route('kategori.create') }}" class="btn btn-primary mb-3 btn-sm">Tambah Kategori</a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Kode Kategori</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($data as $d)
                <tr>
                    <td>{{ $no++ }}</td>
                     <td>{{ $d->nama_kategori }}</td>
                    <td>{{ $d->kode_kategori }}</td>
                     <td>{{ $d->keterangan }}</td>
                    <td>
                        <a href="{{ route('kategori.edit', ['kategori' => $d->id_kategori]) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('kategori.destroy', ['kategori' => $d->id_kategori]) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">Hapus</button>
                        </form>
                    </td>
    
                </tr>
            @endforeach
        </tbody>
    </table>
    {!! $data->links() !!}
</div>
@endsection