@extends('heydrown.dashboard.layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-0 pb-2 mb-3 border-bottom">
        <h1 class="h2">Data Stok Produk</h1>
    </div>

    <div class="row">
        <div class="col">
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
                                            <input type="number" class="form-control text-center input-stok"
                                                value="{{ $cek->stok->jumlah }}" data-produk="{{ $p->id }}"
                                                data-ukuran="{{ $u->id }}" min="0">

                                        </td>
                                    @else
                                        <td>
                                            <input type="number" class="form-control text-center input-stok" value="0"
                                                data-produk="{{ $p->id }}" data-ukuran="{{ $u->id }}" min="0">
                                        </td>
                                    @endif
                                @endforeach

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

@endsection

@push('scripts')
    <script>
        // Datatable
        $(document).ready(function() {
            $('#datatable').DataTable();
        })

        // Toast
        function alertToast(message) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
            Toast.fire({
                icon: 'success',
                title: message
            })
        }

        // update stok
        $('.input-stok').on('change', function(e) {

            let jumlah;

            if ($(this).val() == '') {
                jumlah = 0;
            } else {
                jumlah = $(this).val();
            }

            let produk_id = $(this).data('produk');
            let ukuran_id = $(this).data('ukuran');
            let element = $(this);

            $(this).prop('disabled', true);

            $.ajax({
                url: "{{ route('dashboard.stok.ajax') }}",
                data: {
                    jumlah: jumlah,
                    produk_id: produk_id,
                    ukuran_id: ukuran_id,
                    _token: "{{ csrf_token() }}"
                },
                method: "POST",

                success: function(data) {
                    element.removeAttr('disabled');
                    element.val(jumlah);
                    alertToast(data);
                },

            });
        });
    </script>
@endpush
