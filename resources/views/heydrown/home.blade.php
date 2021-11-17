@extends('heydrown.layouts.app')

@section('content')
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




    <div class="container py-3 px-0">
        {{-- New Produk --}}
        <h2 class="font-weight-bold p-2">New Products</h2>
        <div class="row row-cols-md-4 row-cols-2 mb-5">
            <?php for($i=1;$i<=4;$i++): ?>
            <div class="col px-4">
                <div class="card bg-transparent heydrown-card">
                    <div class="position-absolute top-0 px-3 py-1" style="background-color: rgb(0, 0, 0,1);z-index:2;">
                        <a class="text-white text-decoration-none font-weight-bold">New</a>
                    </div>
                    <a href="" class="product-photo-click">
                        <img src=" /img/baju.jpg" class="card-img-top product-photo" alt="...">
                    </a>
                    <div class="card-body px-0 py-1">
                        <a href="" class="text-decoration-none font-weight-bold text-white product-name">
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
                <div class="card bg-transparent heydrown-card">
                    <div class="position-absolute top-0 px-3 py-1" style="background-color: rgb(0, 0, 0,1);z-index:2;">
                        <a class="text-white text-decoration-none font-weight-bold">Hot</a>
                    </div>
                    <a href="" class="product-photo-click">
                        <img src=" /img/baju.jpg" class="card-img-top product-photo" alt="...">
                    </a>
                    <div class="card-body px-0 py-1">
                        <a href="" class="text-decoration-none font-weight-bold text-white product-name">
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
            <?php for($i=1;$i<=8;$i++): ?>
            <div class="col px-4">
                <div class="card bg-transparent heydrown-card">
                    <a href="" class="product-photo-click">
                        <img src=" /img/baju.jpg" class="card-img-top product-photo" alt="...">
                    </a>
                    <div class="card-body px-0 py-1">
                        <a href="" class="text-decoration-none font-weight-bold text-white product-name">
                            Heydrown Shirt One
                        </a>
                        <p>Rp. 100.000</p>
                    </div>
                </div>
            </div>
            <?php endfor ?>
        </div>
        <div class="d-flex justify-content-center mt-2">
            <a href="{{ route('outside.products') }}" class="btn border-0 text-white bg-heydrown"
                style="background-color:black;">Lihat Semua</a>
        </div>
    </div>
@endsection
