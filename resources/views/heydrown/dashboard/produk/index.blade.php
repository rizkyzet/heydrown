@extends('heydrown.dashboard.layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-0 pb-2 mb-3 border-bottom">
        <h1 class="h2">Data Produk</h1>
    </div>

    <div class="row">
        <div class="col">
            <a href="{{ route('dashboard.produk.create') }}" class="btn btn-sm btn-primary mb-4">Tambah Data</a>
            <table class="table" id="datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Created at</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($produk as $p)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><img class="img-thumbnail" src="{{ asset('storage/' . $p->foto) }}" alt="" width="100"
                                    height="100"></td>
                            <td>{{ $p->nama }}</td>
                            <td>{{ $p->kategori->nama }}</td>
                            <td>{{ rupiah($p->harga) }}</td>
                            <td>{{ $p->created_at }}</td>
                            <td>
                                <a href="{{ route('dashboard.produk.show', $p) }}"
                                    class="btn btn-warning btn-sm text-white">Detail
                                    Produk</a>
                                <a class="btn btn-success btn-sm d-inline"
                                    href="{{ route('dashboard.produk.edit', $p) }}">Edit</a>
                                <form class="d-inline" action="{{ route('dashboard.produk.destroy', $p) }}"
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
