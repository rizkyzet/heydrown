@extends('heydrown.layouts.app')


@section('content')
    <div class="container p-5">
        <div class="row justify-content-center ">
            <div class="col-4 d-lg-flex align-items-center d-md-none d-sm-none d-none">
                <img class="img-fluid" src="/img/contact.jpg" alt="">
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                <h4 class="font-weight-bold">Contact us</h4>
                <div class="form-group">
                    <label for="">Nama</label>
                    <input type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Handphone</label>
                    <input type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Message</label>
                    <textarea name="" id="" cols="30" rows="6" class="form-control"></textarea>
                </div>
                <button class="btn btn-dark btn-block btn-heydrown-black">Send</button>
            </div>
        </div>
    </div>
@endsection
