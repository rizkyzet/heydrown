@extends('heydrown.dashboard.layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-0 pb-2 mb-3 border-bottom">
        <h1 class="h2">Data Diskon</h1>
    </div>

    <div class="row">
        <div class="col">

            <table class="table" id="datatable">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Diskon</th>
                        <th>Berlaku</th>
                        <th>Harga Asli</th>
                        <th>Harga Diskon</th>

                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($produk as $p)
                        <tr>
                            <td><img class="img-thumbnail" src="{{ asset('storage/' . $p->foto) }}" alt="" width="100"
                                    height="100"></td>
                            <td>{{ $p->nama }}</td>
                            <td>{{ $p->kategori->nama }}</td>
                            <td>{{ $p->diskon ? $p->diskon->potongan . '%' : '-' }} </td>
                            <td>{{ $p->diskon->berlaku ?? '-' }}</td>
                            <td>{{ rupiah($p->harga) }}</td>
                            <td>{{ $p->diskon ? $p->diskon->harga_diskon : '-' }}</td>
                            <td>

                                @if ($p->diskon)
                                    <a class="btn btn-success btn-sm d-inline"
                                        href="{{ route('dashboard.diskon.edit', $p) }}">Ubah</a>
                                    <form class="d-inline" action="{{ route('dashboard.diskon.destroy', $p) }}"
                                        method="POST">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-sm btn-danger" onclick="confirm('Yakin ingin hapus?')">Hapus
                                        </button>
                                    </form>
                                @else
                                    <a class="btn btn-primary btn-sm d-inline"
                                        href="{{ route('dashboard.diskon.create', $p) }}">Buat</a>
                                @endif


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
