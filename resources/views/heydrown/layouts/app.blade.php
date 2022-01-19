<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Heydrown</title>

    {{-- Google Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Poppins&family=Roboto&display=swap"
        rel="stylesheet">

    {{-- Favicon --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('icon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('icon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('icon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('icon/site.webmanifest') }}">

    {{-- Bootstrap Icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">

    {{-- App CSS --}}
    <link rel="stylesheet" href="/css/app.css">
    {{-- <link rel="stylesheet" href="/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous"> --}}

    {{-- Magnifier CSS --}}
    <link rel="stylesheet" type="text/css" href="/css/magnifier.css">

    {{-- My CSS --}}
    <link rel="stylesheet" href="/css/loader.css">
    <link rel="stylesheet" href="/css/style.css">

 
  

    @livewireStyles()

    @stack('css')

</head>

<body>


    @include('heydrown.layouts.navbar')




    {{-- Konten --}}

    @if (Request::path() == 'about')
        @yield('content')
    @else
        <div class="container-fluid heydrown-bg text-white px-0 pt-0" style="padding-bottom: 100px;"> 
            @yield('content')
        </div>
    @endif



    @include('heydrown.layouts.footer')


    <script src="/js/app.js"></script>
    {{-- <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script> --}}
    <script type="text/javascript" src="/js/Event.js"></script>
    <script type="text/javascript" src="/js/Magnifier.js"></script>
    <script type="text/javascript" src="/js/jquery.zoom.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    @livewireScripts()
 
    <script>
        $('.btn-nav-canvas,.btn-nav-canvas-close').click(function() {
            const idTarget = $(this).data('offcanvas');

            $('#' + idTarget).toggleClass('slide-right');
        });



        $(document).ready(function() {
            $(window).scroll(function() {
                var scroll = $(window).scrollTop();
                if (scroll > 50) {
                    $(".heydrown-navbar").css("background", "black");


                } else {
                    $(".heydrown-navbar").css("background", "transparent");

                }
            })
        })
    </script>

    @stack('scripts')



</body>

</html>
