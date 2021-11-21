@extends('heydrown.dashboard.layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-0 pb-2 mb-3 border-bottom">
        <h1 class="h2">Data Ukuran</h1>
    </div>

    <div class="row">
        <div class="col">
            <a href="{{ route('dashboard.ukuran.create') }}" class="btn btn-sm btn-primary mb-4">Tambah Data</a>
            <table class="table" id="datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tipe Ukuran</th>
                        <th>Slug</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ukuran as $u)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $u->tipe }}</td>
                            <td>{{ $u->slug }}</td>
                            <td>
                                <a class="btn btn-success btn-sm d-inline"
                                    href="{{ route('dashboard.ukuran.edit', $u) }}">Edit</a>
                                <form class="d-inline" action="{{ route('dashboard.ukuran.destroy', $u) }}"
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
