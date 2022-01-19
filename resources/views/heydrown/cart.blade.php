@extends('heydrown.layouts.app')


@section('content')
    <div class="heydrown-banner banner-empty d-flex justify-content-center align-items-center">

    </div>
    @if (Auth::check())
        @livewire('cart-update')
    @else
        <div class="container p-5" style="min-height: 100vh;">
            <h4 class="font-weight-bold text-center lsp-5">Your Cart</h4>
            <div class="row">


                <div class="col-12 d-flex justify-content-center flex-column align-items-center">
                    <h3 class="text-center mt-5" style="letter-spacing: 10px">CART EMPTY</h3>
                    <p class="p-2" style="letter-spacing: 2px;">You must be <a class="btn-nav-canvas text-white"
                            href="#" data-offcanvas="offcanvas-login">login</a></p>
                </div>




            </div>

            <div class="row justify-content-center">
                <div class="col-12 col-sm-12 col-md-10 col-lg-10 my-3 ">
                    <hr style="border:1px solid black;">

                    <div class="d-flex justify-content-end">
                        <p><strong>Total</strong> : Rp. 0</p>
                    </div>

                    <div class="d-flex justify-content-between mt-5">
                        <a class="btn btn-dark btn-heydrown m-2" href="{{ route('outside.products') }}">Continue
                            Shopping</a>
                        <a class="btn btn-dark btn-heydrown m-2" href="{{ route('outside.checkout.index') }}">Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    @endif








@endsection

@push('css')
    @livewireStyles()
@endpush


@push('scripts')
    @livewireScripts()
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'center',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: false,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            },
            background: 'black',
            iconColor: 'white',

        })


        window.addEventListener('cart-alert', event => {
            let icon;

            if (event.detail.type == 'delete') {
                $('.cart-quantity').html(event.detail.qty);
                icon = 'success';
            } else if (event.detail.type == 'maks') {
                icon = 'error';

            } else if (event.detail.type == 'tambahCart') {
                icon = 'success';

            } else if (event.detail.type == 'updateCart') {
                icon = 'success';
            }

            Toast.fire({
                icon: icon,
                title: '<h5 style="color:white;text-align:center;">' + event.detail.message + '</h5>'
            })
        })

        window.addEventListener('edit-input', event => {
            $('#' + event.detail.inputId).val(event.detail.stokMaks)
        })
    </script>
@endpush
