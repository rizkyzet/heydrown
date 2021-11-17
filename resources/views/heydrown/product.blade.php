@extends('heydrown.layouts.app')

@section('content')

    <div class="container px-5 py-4">
        <div class="row row-cols-md-1 row-cols-1 row-cols-sm-1 row-cols-lg-2 detail-product">
            <div class="col p-4 d-flex align-items-center justify-content-center">
                <img src="/img/baju-detail.jpg" alt="" class="img-fluid foto-product" id="thumb"
                    data-large-img-url="/img/baju.jpg">
            </div>
            <div class="col py-4 px-4">
                <div class="product-header">
                    <h1 class="font-weight-bold">Heydrown Shirt One</h1>
                    <p class=" p-0 m-0 nama">T-Shirt &mdash; Short Leeve</p>
                    <p class="p-0 harga">Rp. 100.000</p>
                </div>

                <div class="product-description mt-5">
                    <h3 class="font-weight-bold">Product Description</h3>
                    <p class="p-0 mt-2 mb-5">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nostrum voluptas aliquid repudiandae nisi,
                        tempora sint perferendis ut, voluptatum voluptate harum necessitatibus laborum! Natus voluptas,

                    </p>
                </div>

                <form>
                    <div class="form-row">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="" class="font-weight-bold">Size</label>
                                <select name="" id="" class="form-control">
                                    <option value="">XL</option>
                                    <option value="">L</option>
                                    <option value="">M</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="" class="font-weight-bold">Quantity</label>
                                <input type="number" class="form-control">
                            </div>
                        </div>
                        <div class="col d-flex align-items-center mt-3 ">
                            <button class="btn btn-dark btn-cart">Add to Cart</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection


@push('scripts')
    <script type="text/javascript">
        var evt = new Event(),
            m = new Magnifier(evt);
        m.attach({
            thumb: '#thumb',
            mode: 'inside',
            zoom: 3,
            zoomable: true
        });
    </script>
@endpush
