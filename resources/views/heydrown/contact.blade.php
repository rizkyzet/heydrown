@extends('heydrown.layouts.app')


@section('content')
    <div class="heydrown-banner banner-contact d-flex justify-content-center align-items-center">
        <h5 class="font-weight-bold text-white lsp-5">CONTACT US</h5>
    </div>
    <div class="container p-5">
        <div class="row justify-content-center ">

            <div class="col-12 col-sm-12 col-md-6 col-lg-4">

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
