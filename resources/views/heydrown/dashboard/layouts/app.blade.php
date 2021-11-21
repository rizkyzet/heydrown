<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Dashboard</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.6/examples/dashboard/">



    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    {{-- Datatables CSS --}}
    <link rel="stylesheet" type="text/css" href="/css/dataTables.bootstrap4.min.css" />


    {{-- My CSS --}}
    <link rel="stylesheet" href="/css/style.css">

    {{-- Dashboard CSS --}}
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

    </style>


    <!-- Custom styles for this template -->
    <link href="/css/dashboard.css" rel="stylesheet">

    {{-- Livewire Style --}}
    {{-- @livewireStyles --}}

    {{-- Stack CSS --}}
    @stack('css')
</head>

<body>

    @include('heydrown.dashboard.layouts.header')



    <div class="container-fluid">
        <div class="row">
            @include('heydrown.dashboard.layouts.sidebar')
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                @include('heydrown.dashboard.layouts.breadcrumb')
                @include('heydrown.dashboard.layouts.alert')
                @yield('content')
            </main>
        </div>
    </div>


    {{-- Jquery --}}
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    {{-- jquery datatable --}}
    <script type="text/javascript" src="/js/jquery.dataTables.min.js"></script>
    {{-- bootstrap datatable --}}
    <script type="text/javascript" src="/js/dataTables.bootstrap4.min.js"></script>
    {{-- icon feather --}}
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script> --}}
    <script src="/js/dashboard.js"></script>
    {{-- Livewire Script --}}
    {{-- @livewireScripts --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('scripts')
</body>

</html>
