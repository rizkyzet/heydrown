@extends('heydrown.layouts.app')

@section('content')
    <div class="heydrown-loading"></div>
    <div class="parallax-about d-flex justify-content-center align-items-center">
        <h1 class="font-weight-bold text-white heading" data-aos="fade-in" data-aos-duratuin="3000">HEYDROWN</h1>
    </div>

    <div class="container-fluid container-about p-4">
        <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-2">
            <div class="col p-4">
                <img src="/img/about-2.jpg" alt="" data-aos="fade-right" class="img-fluid">
            </div>

            <div class="col p-4 d-flex justify-content-center flex-column about-description ">
                <h3 class="font-weight-bold text-white heading-text-column">OUR JOURNEY</h3>
                <p class="text-white">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Alias ipsa sint cum,
                    nobis molestiae beatae?
                </p>

            </div>
        </div>
        <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-2">
            <div class="col order-1 order-sm-1 order-md-2 order-lg-2 p-4">
                <img src="/img/about-3.jpg" alt="" data-aos="fade-left" class="img-fluid">
            </div>

            <div
                class="col order-2 order-sm-2 order-md-1 order-lg-1 p-4 d-flex justify-content-center flex-column about-description">
                <h3 class="font-weight-bold text-white heading-text-column">VISION</h3>
                <p class="text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis nobis voluptate
                    repudiandae omnis culpa voluptas odit ipsam libero voluptates minima excepturi architecto, ab aliquam
                    reprehenderit.
                </p>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-2">
            <div class="col p-4 d-flex align-items-center">
                <img src="/img/about-4.jpg" alt="" data-aos="fade-right" class="img-fluid">
            </div>

            <div class="col d-flex justify-content-center flex-column p-4 about-description">
                <h3 class="font-weight-bold text-white heading-text-column">GET IN TOUCH</h3>
                <p class="text-white">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Magnam, exercitationem
                    beatae aspernatur saepe, rem sequi libero nemo distinctio aliquid architecto itaque autem perspiciatis

                </p>
            </div>
        </div>

    </div>
@endsection


@push('scripts')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        $(document).ready(function() {
            $(".heydrown-loading").fadeOut("slow");
            AOS.init();
        })
    </script>
@endpush


@push('css')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
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


        .parallax-about {
            /* The image used */
            background-image: url({{ asset('img/about-1.jpg') }});

            /* Set a specific height */
            min-height: 650px;

            /* Create the parallax scrolling effect */
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

    </style>
@endpush
