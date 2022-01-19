@extends('heydrown.layouts.app')

@section('content')
    <div class="loadingio-container">
        <div class="spinner">
            <div></div>
        </div>
    </div>
    {{-- Caraousel --}}
    <div id="carouselExampleControls" class="carousel slide carousel-fade" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="carousel-hd-img-1 d-flex justify-content-center align-items-center">
                    <h5 class="font-weight-bold text-white heading font-italic">
                        EXCLUSIVE & AUTHENTIC</h5>
                </div>
            </div>
            <div class="carousel-item">
                <div class="carousel-hd-img-2 d-flex justify-content-center align-items-center">
                    <h5 class="font-weight-bold text-white heading font-italic">
                        EXCLUSIVE &
                        AUTHENTIC
                    </h5>
                </div>
            </div>
            <div class="carousel-item">
                <div class="carousel-hd-img-3 d-flex justify-content-center align-items-center">
                    <h5 class="font-weight-bold text-white heading font-italic">
                        EXCLUSIVE &
                        AUTHENTIC
                    </h5>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-target="#carouselExampleControls" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-target="#carouselExampleControls" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </button>
    </div>




    <div class="container py-3">
        {{-- New Produk --}}
        <h2 class="font-weight-bold p-2">Latest Products</h2>
        <div class="row row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-2 mb-5">
            @forelse ($newProduk as $produk)
                <div class="col px-4">
                    <div class="card bg-transparent heydrown-card border-0">
                        <div class="position-absolute top-0 d-flex" style="z-index:2;">
                            {{-- <div class="text-white font-weight-bold px-3 mr-1 heydrown-bg-black">New</div> --}}
                            @if ($produk->diskon)
                                <div class="text-white font-weight-bold px-3 mr-1 heydrown-bg-black">
                                    {{ $produk->diskon->potongan . '% Off' }}</div>
                            @endif
                        </div>
                        @if ($produk->ukuran->count() > 0)
                            <a href="{{ route('outside.product', $produk) }}" class="product-photo-click">
                                <img src="{{ asset('storage/' . $produk->foto) }}" class="card-img-top product-photo"
                                    alt="{{ $produk->nama }}">
                            </a>
                        @else

                            <div class="position-relative">
                                <img src="{{ asset('storage/' . $produk->foto) }}" class="card-img-top product-photo"
                                    alt="{{ $produk->nama }}">
                                <span class="text-center p-2 out-of-stock">
                                    OUT OF
                                    STOCK</span>
                            </div>

                        @endif
                        <div class="card-body px-0 py-1">
                            @if ($produk->ukuran->count() > 0)
                                <a href="{{ route('outside.product', $produk) }}"
                                    class="text-decoration-none font-weight-bold text-white product-name card-title">
                                    {{ $produk->nama }}
                                </a>
                            @else
                                <span class="text-decoration-none font-weight-bold text-white product-name card-title">
                                    {{ $produk->nama }}
                                </span>
                            @endif
                            <div class="product-harga">
                                @if ($produk->diskon)
                                    <small class="mr-2 text-muted" style="text-decoration: line-through">Rp.
                                        {{ rupiah($produk->harga) }}</small>
                                    <p>Rp. {{ rupiah($produk->diskon->harga_diskon) }}</p>
                                @else
                                    <p>Rp. {{ rupiah($produk->harga) }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col text-center d-flex">
                    <p style="letter-spacing: 5px" class="px-5">Products Empty</p>
                </div>
            @endforelse
        </div>



        {{-- Hot Produk --}}
        {{-- <h2 class="font-weight-bold p-2">Hot Products</h2> --}}
        {{-- <div class="row row-cols-md-4 row-cols-2 mb-5">
            <?php for($i=1;$i<=4;$i++): ?>
            <div class="col px-4">
                <div class="card bg-transparent heydrown-card border-0">

                    <div class="position-absolute top-0 d-flex" style="z-index:2;">
                        <div class="text-white font-weight-bold px-3 mr-1 heydrown-bg-black">Hot</div>
                    </div>

                    <a href="/product/this-is-slug" class="product-photo-click">
                        <img src="/img/baju.jpg" class="card-img-top product-photo" alt="...">
                    </a>
                    <div class="card-body px-0 py-1">
                        <a href="/product/this-is-slug"
                            class="text-decoration-none font-weight-bold text-white product-name">
                            Heydrown Shirt One
                        </a>
                        <p>Rp. 100.000</p>
                    </div>
                </div>
            </div>
            <?php endfor ?>
        </div> --}}
        {{-- <div class="row mb-5">
            <div class="col text-center">
                <p style="letter-spacing: 5px">Products Empty</p>
            </div>
        </div> --}}

        {{-- Gallery --}}
        <h2 class="font-weight-bold p-2">Sale Products</h2>
        <div class="row row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-2">
            @foreach ($diskonProduk as $d)
                <div class="col px-4">
                    <div class="card bg-transparent heydrown-card h-100 border-0">
                        <div class="position-absolute top-0 d-flex" style="z-index:2;">
                            <div class="text-white font-weight-bold px-3 mr-1 heydrown-bg-black">
                                {{ $d->potongan . '% Off' }}</div>
                        </div>
                        @if ($d->produk->ukuran->count() > 0)
                            <a href="{{ route('outside.product', $d->produk) }}" class="product-photo-click">
                                <img src="{{ asset('storage/' . $d->produk->foto) }}" class="card-img-top product-photo"
                                    alt="{{ $d->produk->nama }}">
                            </a>
                        @else

                            <div class="position-relative">
                                <img src="{{ asset('storage/' . $d->produk->foto) }}" class="card-img-top product-photo"
                                    alt="{{ $d->produk->nama }}">
                                <span class="text-center p-2 out-of-stock">
                                    OUT OF
                                    STOCK</span>
                            </div>

                        @endif
                        <div class="card-body px-0 py-1">

                            @if ($d->produk->ukuran->count() > 0)
                                <a href="{{ route('outside.product', $d->produk) }}"
                                    class="text-decoration-none font-weight-bold text-white product-name card-title">
                                    {{ $d->produk->nama }}
                                </a>
                            @else
                                <span class="text-decoration-none font-weight-bold text-white product-name card-title">
                                    {{ $d->produk->nama }}
                                </span>
                            @endif

                            <div class=" product-harga">
                                <small class="mr-2 text-muted" style="text-decoration: line-through">Rp.
                                    {{ rupiah($d->produk->harga) }}</small>
                                <p>Rp. {{ rupiah($d->harga_diskon) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center mt-4">
            <a href="{{ route('outside.products') }}" class="btn border-0 text-white bg-heydrown"
                style="background-color:black;">Lihat Semua</a>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        $(window).on('load', function() {
            $(".loadingio-container").delay(500).fadeOut("slow");
        })
    </script>
@endpush


@push('css')
    <style>
        .heydrown-loading {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            overflow: hidden;
            background: url({{ asset('img/loading.gif') }}) center no-repeat black;
        }

        .carousel-item {
            min-height: 100vh;
        }

        .carousel-hd-img-1,
        .carousel-hd-img-2,
        .carousel-hd-img-3 {
            min-height: 100vh;

            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .carousel-hd-img-1 {
            background-image: url({{ asset('img/new-carousel-3.jpg') }});
        }

        .carousel-hd-img-2 {
            background-image: url({{ asset('img/new-carousel-1.jpg') }});
        }

        .carousel-hd-img-3 {
            background-image: url({{ asset('img/new-carousel-2.jpg') }});
        }

    </style>
@endpush
