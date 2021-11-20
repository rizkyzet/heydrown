@extends('heydrown.dashboard.layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-0 pb-2 mb-3 border-bottom">
        <h1 class="h2">Data Produk</h1>
    </div>

    <div class="row">
        <div class="col">
            <table class="table" id="datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        @foreach ($ukuran as $u)
                            <th>{{ $u->tipe }}</th>
                        @endforeach
                        {{-- <th>Action</th> --}}
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

                            @foreach ($ukuran as $u)
                                <?php
                                $cek = $u->produk->where('id', $p->id)->first();
                                ?>
                                @if ($cek)
                                    <td>{{ $cek->stok->jumlah }}</td>
                                @else
                                    <td>0</td>
                                @endif
                            @endforeach

                            {{-- <td>
                                <a href="{{ route('dashboard.stok.edit', $p) }}" class="btn btn-success btn-sm">Update
                                    Stok</a>
                                <form class="d-inline" action="" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-sm btn-danger"
                                        onclick="confirm('Yakin ingin hapus?')">Hapus</button>
                                </form>
                            </td> --}}

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
