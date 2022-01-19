@extends('heydrown.layouts.app')

@section('content')
    <div class="heydrown-banner banner-empty d-flex justify-content-center align-items-center" style="min-height: 20vh;">

    </div>

    @include('heydrown.layouts.offcanvas-member-area')

    <div class="container" style="min-height: 100vh">
        <div class="row heydrown-member-area ">
            @include('heydrown.layouts.sidebar-member-area')
            <div class="col content">
                <h3 class="heading pb-2">Orders</h3>

                <div class="row row-cols-1 row-cols-md-2 row-lg-cols-2 mt-3">
                    @foreach ($pesanan as $p)
                        <div class="col mb-4">
                            <div class="card h-100 heydrown-alamat">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between header">
                                        <h5 class="card-title pr-3">{{ $p->kode }}</h5>
                                        <h5 class="font-weight-bold font-italic">{{ $p->status }}</h5>
                                    </div>
                                    <div class="card-text">
                                        <strong>Customer :</strong> {{ $p->user->name }} <br>
                                        <strong>Product :</strong> {{ $p->detailPesanan->count() }} Item<br>
                                        <strong>Total :</strong> Rp. {{ rupiah($p->grand_total) }}
                                        <hr>
                                        <strong>Created :</strong> {{ $p->created_at->isoFormat('LLLL') }} <br>
                                        <strong>Expired :</strong> {{ $p->expired_at->isoFormat('LLLL') }} <br>
                                    </div>
                                </div>
                                <div class="card-footer p-2 border">

                                    <a class="btn btn-heydrown-hover btn-sm float-right mr-2" href="{{ route('pelanggan.pesanan.show',$p) }}">Detail</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>



            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="/css/style2.css">
@endpush


@push('scripts')
    <script>
        $('.btn-canvas').on('click', function() {
            $('.heydrown-offcanvas').toggleClass('slide');

        });
    </script>
@endpush
