@extends('heydrown.layouts.app')

@section('content')
    <div class="heydrown-banner banner-empty d-flex justify-content-center align-items-center">

    </div>
    <div class="container px-5 py-5">
        <div class="row row-cols-md-1 row-cols-1 row-cols-sm-1 row-cols-lg-2 detail-product justify-content-center">

            {{-- Kiri -Foto --}}
            <div class="col p-0 d-flex align-items-center justify-content-center">
                <span style="display: inline-block;" class="foto-product-container">
                    <img src="{{ asset('storage/' . $produk->foto) }}" alt="" class="img-fluid foto-product" id="thumb"
                        data-large-img-url="{{ asset('storage/' . $produk->foto_hd) }}">
                </span>
            </div>

            {{-- Kanan - Detail --}}
            <div class="col-lg-6 col-md-8 col-sm-12 col-12 d-flex flex-column justify-content-between p-3">
                <div class="product-header">
                    <h3 class="font-weight-bold">{{ $produk->nama }}</h3>
                    <a href="{{ route('outside.products') . '?kategori=' . $produk->kategori->slug }}"
                        class="nama p-0 m-0 text-white text-decoration-none">{{ $produk->kategori->nama }}</a><br>
                    @if ($produk->diskon)
                        <div class="mb-5">
                            <small class="p-0 d-inline text-muted" style="text-decoration: line-through">
                                Rp.{{ rupiah($produk->harga) }}
                            </small>
                            <p class="p-0 harga d-inline">Rp. {{ rupiah($produk->diskon->harga_diskon) }}</p>
                            <span class="px-2 py-1"
                                style="background: black">{{ '-' . $produk->diskon->potongan . '%' }}</span>
                        </div>
                    @else
                        <div class="mb-4">
                            <p class="p-0 harga">Rp. {{ rupiah($produk->harga) }}</p>
                        </div>
                    @endif

                </div>

                <div class="product-description">
                    <h5 class="font-weight-bold">Product Description</h5>
                    <p class="p-0 mt-2 mb-5">
                        {{ $produk->deskripsi }}
                    </p>
                </div>


                @livewire('add-to-cart',['produk'=>$produk])


            </div>
        </div>
    </div>


@endsection

@push('css')
    {{-- <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css"> --}}
    @livewireStyles()
@endpush

@push('scripts')


    @livewireScripts()

    <script type="text/javascript">
        // var evt = new Event(),
        //     m = new Magnifier(evt);
        // m.attach({
        //     thumb: '#thumb',
        //     mode: 'inside',
        //     zoom: 2,
        //     zoomable: false
        // });

        $(document).ready(function() {
            let hdImage = $('.foto-product-container img').data('large-img-url');
            $('span.foto-product-container').zoom({
                url: hdImage,
                on:'grab',
                magnify:1
            });
        });


        window.addEventListener('addtocart-alert', event => {
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

            Toast.fire({
                icon: 'error',
                title: '<h5 style="color:white;text-align:center;">' + event.detail.message + '</h5>'
            })
        })


        window.addEventListener('addtocart-run', event => {
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

            Toast.fire({
                icon: 'success',
                title: '<h5 style="color:white;text-align:center;">' + event.detail.message + '</h5>'
            })

            $('.cart-quantity').html(event.detail.totalCart);
        })

        window.addEventListener('open-login', event => {
            $('#offcanvas-login').toggleClass('slide-right');
        })
    </script>
@endpush
