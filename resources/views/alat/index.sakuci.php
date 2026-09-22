@extends ('layouts.app')

@section ('content')

<div class="container">
    <h1>Data alat</h1>
    <a href="{{ route('alat.create') }}" class="btn btn-primary mb-3 btn-sm">Tambah alat</a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama alat</th>
                <th>Kode alat</th>
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
                     <td>{{ $d->nama_alat }}</td>
                    <td>{{ $d->kode_alat }}</td>
                    <td>
                        <a href="{{ route('alat.edit', ['alat' => $d->id_alat]) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('alat.destroy', ['alat' => $d->id_alat]) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus alat ini?')">Hapus</button>
                        </form>
                    </td>
    
                </tr>
            @endforeach
        </tbody>
    </table>
    {!! $data->links() !!}
</div>
@endsection