@extends('heydrown.layouts.app')

@section('content')
    <div class="heydrown-banner banner-empty d-flex justify-content-center align-items-center" style="min-height: 20vh;">

    </div>

    @include('heydrown.layouts.offcanvas-member-area')

    <div class="container" style="min-height: 100vh">
        <div class="row heydrown-member-area ">
            @include('heydrown.layouts.sidebar-member-area')
            <div class="col content">
                <h3 class="heading pb-2">Order #{{ $pesanan->kode }} ({{ucfirst($pesanan->status)}})</h3>

                <div class="row row-cols-1 row-cols-md-2 row-lg-cols-2 mt-3">
                    <div class="col">
                        <h5 class="lsp-5">Order</h5>
                        <table class="table-sm table table-borderless text-white">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <td>{{ $pesanan->kode }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>{{ $pesanan->status }}</td>
                                </tr>
                                <tr>
                                    <th>Created</th>
                                    <td>{{ $pesanan->created_at->isoFormat('LLLL') }}</td>
                                </tr>
                                <tr>
                                    <th>Expired</th>
                                    <td>{{ $pesanan->expired_at->isoFormat('LLLL') }}</td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="col">
                        <h5 class="lsp-5">Shipment</h5>
                        <table class="table-sm table table-borderless text-white">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <td>{{ $pesanan->pengiriman->nama }}</td>
                                </tr>
                                <tr>
                                    <th class="align-middle">Alamat</th>
                                    <td>{{ $pesanan->pengiriman->detail_alamat }} <br>
                                        {{ 'Provinsi ' . $pesanan->pengiriman->provinsi->nama . ' - ' . $pesanan->pengiriman->kota->type . ' ' . $pesanan->pengiriman->kota->nama . ' ' . $pesanan->pengiriman->kota->kode_pos }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Kurir</th>
                                    <td>{{ strtoupper($pesanan->pengiriman->kurir) . ' ' . $pesanan->pengiriman->servis . ' (' . $pesanan->pengiriman->etd . ')' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td>{{ $pesanan->pengiriman->phone }}</td>
                                </tr>

                            </thead>
                        </table>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col">
                        <h5 class="lsp-5">Detail Order</h5>
                        <table class="table table-sm text-white mt-3">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Foto</th>
                                    <th>Nama</th>
                                    <th>Qty</th>
                                    <th>Harga Satuan</th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pesanan->detailPesanan as $p)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <img src="{{ asset('storage/' . $p->produk->foto) }}" alt="foto produk"
                                                width="50" height="50">
                                        </td>
                                        <td>
                                            {{ $p->produk->nama }}
                                            @if ($p->diskon)
                                                <small
                                                    class="heydrown-bg-black px-2 py-1 ml-2">{{ '-' . $p->diskon . ' OFF' }}</small>
                                            @endif
                                        </td>
                                        <td>{{ $p->qty }}</td>
                                        <td>{{ $p->diskon ? rupiah($p->harga_diskon) : rupiah($p->harga) }}</td>
                                        <td>{{ rupiah($p->total_harga) }}</td>
                                    </tr>
                                @endforeach
                                <tr class="table-borderless">
                                    <td colspan="5" class="text-right">Total</td>
                                    <td class="text-right">{{ rupiah($pesanan->total) }}</td>
                                </tr>
                                <tr class="table-borderless">
                                    <td colspan="5" class="text-right">Shipping</td>
                                    <td class="text-right">{{ rupiah($pesanan->pengiriman->biaya) }}</td>
                                </tr>
                                <tr class="table-borderless">
                                    <td colspan="5" class="text-right">Grand Total</td>
                                    <td class="text-right">{{ rupiah($pesanan->grand_total) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>

                <div class="row mt-5">
                    <div class="col-6">
                        <h5 class="lsp-5">Informasi Pesanan</h5>
                        <table class="table table-sm table-bordered text-white">
                            @foreach ($pesanan->logPesanan as $log)
                                <tr>
                                    <td>{{ $log->created_at }}</td>
                                    <td>{{ $log->info }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col">
                        <h5 class="lsp-5">Bukti Pembayaran</h5>

                        @livewire('pelanggan.index-bukti-transfer',['pesanan'=>$pesanan])

                    </div>
                </div>

            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade modal-heydrown" id="modalCreateBuktiTransfer" tabindex="-1"
        aria-labelledby="modalCreateBuktiTransfer" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCreateBuktiTransfer">Upload Bukti Transfer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                @livewire('pelanggan.create-bukti-transfer',['pesanan'=>$pesanan])

            </div>
        </div>
    </div>

@endsection

@push('css')
    <link rel="stylesheet" href="/css/style2.css">
    <link rel="stylesheet" href="/css/slick.css">
    <link rel="stylesheet" href="/css/slick-theme.css">
@endpush


@push('scripts')
    <script type="text/javascript" src="/js/slick.min.js"></script>
    <script>
        $(document).ready(function() {

            $('.btn-canvas').on('click', function() {
                $('.heydrown-offcanvas').toggleClass('slide');

            });



            $('.slider-bukti').slick({
                dots: true,
                infinite: false,
                speed: 300,
                slidesToShow: 5,
                slidesToScroll: 5,
                centerMode: false,
                responsive: [{
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                            infinite: true,
                            dots: true
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                    // You can unslick at a given breakpoint now by adding:
                    // settings: "unslick"
                    // instead of a settings object
                ]
            });
        })
    </script>
@endpush
