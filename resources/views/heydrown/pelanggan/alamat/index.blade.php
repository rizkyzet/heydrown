@extends('heydrown.layouts.app')

@section('content')
    <div class="heydrown-banner banner-empty d-flex justify-content-center align-items-center" style="min-height: 20vh;">

    </div>

    @include('heydrown.layouts.offcanvas-member-area')

    <div class="container" style="min-height: 100vh">
        <div class="row heydrown-member-area">
            @include('heydrown.layouts.sidebar-member-area')
            <div class="col content">
                <h3 class="heading pb-2">Address</h3>
                <button class="btn btn-heydrown-black-hover btn-md mt-2" data-toggle="modal"
                    data-target="#modalCreateAddress">Buat
                    alamat baru</button>
                <div class="row">
                    <div class="col">
                        @livewire('pelanggan.index-alamat')
                    </div>
                </div>
            </div>
        </div>
    </div>





    <!-- Modal Create Adress-->
    <div class="modal fade modal-heydrown" id="modalCreateAddress" tabindex="-1" aria-labelledby="modalCreateAdress"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCreateAdress">Create New Address</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @livewire('pelanggan.create-alamat')
            </div>
        </div>
    </div>

    <!-- Modal Edit Adress-->
    <div class="modal fade modal-heydrown" id="modalEditAddress" tabindex="-1" aria-labelledby="modalCreateAdress"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCreateAdress">Edit Address</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @livewire('pelanggan.edit-alamat')
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

        const Toast = Swal.mixin({
            toast: true,
            position: 'center',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            },
            background: 'black',
            iconColor: 'white',
        })


        window.addEventListener('alert', event => {
            Toast.fire({
                icon: event.detail.type == 'error' ? 'error' : 'success',
                title: '<h5 style="color:white;text-align:center;">' + event.detail.message + '</h5>',
            })
        })
    </script>
@endpush
