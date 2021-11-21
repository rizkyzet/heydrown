@extends('heydrown.layouts.app')

@section('content')
    <div class="heydrown-loading"></div>
    {{-- Caraousel --}}
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="/img/caraousel-img-1.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="/img/caraousel-img-1.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="/img/caraousel-img-1.png" class="d-block w-100" alt="...">
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
        <h2 class="font-weight-bold p-2">New Products</h2>
        <div class="row row-cols-md-4 row-cols-2 mb-5">
            <?php for($i=1;$i<=4;$i++): ?>
            <div class="col px-4">
                <div class="card bg-transparent heydrown-card border-0">
                    <div class="position-absolute top-0 d-flex" style="z-index:2;">
                        <div class="text-white font-weight-bold px-3 mr-1 heydrown-bg-black">New</div>
                    </div>
                    <a href="/product/this-is-slug" class="product-photo-click position-relative">
                        <img src=" /img/baju.jpg" class="card-img-top product-photo" alt="...">
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
        </div>


        {{-- Hot Produk --}}
        <h2 class="font-weight-bold p-2">Hot Products</h2>
        <div class="row row-cols-md-4 row-cols-2 mb-5">
            <?php for($i=1;$i<=4;$i++): ?>
            <div class="col px-4">
                <div class="card bg-transparent heydrown-card border-0">
                    {{-- <div class="position-absolute top-0 px-3 py-1" style="background-color: rgb(0, 0, 0,1);z-index:2;">
                        <a class="text-white text-decoration-none font-weight-bold">Hot</a>
                    </div> --}}
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
        </div>

        {{-- Gallery --}}
        <h2 class="font-weight-bold p-2">Sale Products</h2>
        <div class="row row-cols-md-4 row-cols-2">
            <?php for($i=1;$i<=7;$i++): ?>
            <div class="col px-4">
                <div class="card bg-transparent heydrown-card h-100 border-0">
                    <div class="position-absolute top-0 d-flex" style="z-index:2;">
                        <div class="text-white font-weight-bold px-3 mr-1 heydrown-bg-black">30% Off</div>
                    </div>
                    <a href="/product/this-is-slug" class="product-photo-click">
                        <img src=" /img/baju.jpg" class="card-img-top product-photo" alt="...">
                    </a>
                    <div class="card-body px-0 py-1">
                        <a href="/product/this-is-slug"
                            class="text-decoration-none font-weight-bold text-white product-name">
                            Heydrown Shirt One
                        </a>
                        <div class="d-flex product-harga">
                            <p class="mr-2" style="text-decoration: line-through">Rp. 100.000</p>
                            <p>Rp. 50.000</p>
                        </div>
                    </div>
                </div>
            </div>
            <?php endfor ?>
            <div class="col px-4">
                <div class="card bg-transparent heydrown-card h-100 border-0">
                    <div class="position-absolute top-0 d-flex flex-wrap" style="z-index:2;">
                        <div class="text-white font-weight-bold px-3 mr-1 heydrown-bg-black">100% Off</div>
                        <div class="text-white font-weight-bold px-3 mr-1 heydrown-bg-black">Free Ongkir</div>
                        <div class="text-white font-weight-bold px-3 my-1 mr-1 heydrown-bg-black">Gratis Rumah</div>
                    </div>
                    <a href="/product/this-is-slug" class="product-photo-click">
                        <img src="/img/fazri.jpg" class="card-img-top product-photo" alt="...">
                    </a>
                    <div class="card-body px-0 py-1">
                        <a href="/product/this-is-slug"
                            class="text-decoration-none font-weight-bold text-white product-name">
                            Sesosok
                        </a>
                        <div class="d-flex product-harga">
                            <p class="mr-2" style="text-decoration: line-through">Rp. 100</p>
                            <p>Rp. 0</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-2">
            <a href="{{ route('outside.products') }}" class="btn border-0 text-white bg-heydrown"
                style="background-color:black;">Lihat Semua</a>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $(".heydrown-loading").fadeOut("slow");
            AOS.init();
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

    </style>
@endpush
