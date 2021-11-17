@extends('heydrown.layouts.app')


@section('content')
    <div class="row m-0 p-0">
        <div class="col-4 col-md-3 col-lg-2" style="background-color: black;">
            <nav class="nav flex-column heydrown-sidebar pl-4 py-4">
                <div class="mb-4">
                    <h4 class="pl-3 font-weight-bold mt-3" style="border-bottom:0px solid white">SHIRT</h4>
                    <a class="nav-link active" href="#">Short</a>
                    <a class="nav-link" href="#">Long</a>
                </div>

                <div class="mb-4">
                    <h4 class="pl-3 font-weight-bold mt-3" style="border-bottom:0px solid white">JACKET</h4>
                    <a class="nav-link" href="#">Varsity</a>
                    <a class="nav-link" href="#">Denim</a>
                    <a class="nav-link" href="#">Bomber</a>
                </div>
            </nav>
        </div>
        <div class="col px-5 py-5">
            <div class="row justify-content-between py-3 row-cols-lg-2 row-cols-md-1 row-cols-sm-1 row-cols-1">
                <div class="col">
                    <h2 class="font-weight-bold p-2">All Product</h2>
                </div>
                <div class="col d-flex align-items-center">
                    <input type="text" class="form-control d-inline">
                    <button class="btn btn-dark btn-heydrown-black ml-2">Search</button>
                </div>

            </div>

            <div class="row row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1">
                <?php for($i=1;$i<=16;$i++): ?>
                <div class="col px-4 py-4">
                    <div class="card bg-transparent heydrown-card">
                        <a href="/product/this-is-slug" class="product-photo-click">
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
        </div>
    </div>


@endsection
