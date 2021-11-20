@extends('heydrown.dashboard.layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-0 pb-2 mb-3 border-bottom">
        <h1 class="h2">Data Kategori</h1>
    </div>

    <div class="row">
        <div class="col">
            <a href="{{ route('dashboard.kategori.create') }}" class="btn btn-sm btn-primary mb-4">Tambah Data</a>
            <table class="table" id="datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>Slug</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kategori as $k)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $k->nama }}</td>
                            <td>{{ $k->slug }}</td>
                            <td>
                                <a class="btn btn-success btn-sm d-inline"
                                    href="{{ route('dashboard.kategori.edit', $k) }}">Edit</a>
                                <form class="d-inline" action="{{ route('dashboard.kategori.destroy', $k) }}"
                                    method="POST">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-sm btn-danger"
                                        onclick="confirm('Yakin ingin hapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
        })
    </script>
@endpush
