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
    <link rel="apple-touch-icon" sizes="180x180" href="icon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="icon/favicon-16x16.png">
    <link rel="manifest" href="icon/site.webmanifest">

    {{-- Bootstrap Icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">

    {{-- App CSS --}}
    <link rel="stylesheet" href="/css/app.css">

    {{-- Magnifier CSS --}}
    <link rel="stylesheet" type="text/css" href="/css/magnifier.css">

    {{-- My CSS --}}
    <link rel="stylesheet" href="/css/style.css">

    @stack('css')

</head>

<body>

    @include('heydrown.layouts.navbar')

    {{-- Konten --}}

    @if (Request::path() == 'about')
        @yield('content')
    @else
        <div class="container-fluid heydrown-bg text-white px-0 py-0" style="min-height: 70vh">
            @yield('content')
        </div>

    @endif



    @include('heydrown.layouts.footer')


    <script type="text/javascript" src="/js/Event.js"></script>
    <script type="text/javascript" src="/js/Magnifier.js"></script>
    <script src="/js/app.js"></script>
    @stack('scripts')

</body>

</html>
