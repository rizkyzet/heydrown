<div>
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
                            <td>
                                <input type="number" class="form-control text-center"
                                    wire:change="ubahStok($event.target.value,{{ $p->id }},{{ $u->id }})"
                                    value="{{ $cek->stok->jumlah }}">

                            </td>
                        @else
                            <td>
                                <input type="number" class="form-control text-center"
                                    wire:change="ubahStok($event.target.value,{{ $p->id }},{{ $u->id }})"
                                    value="0">
                            </td>
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
