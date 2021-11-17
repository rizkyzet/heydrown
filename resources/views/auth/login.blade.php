<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Heydrown | Login</title>

    {{-- Google Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Poppins&family=Roboto&display=swap"
        rel="stylesheet">

    {{-- Bootstrap Icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">

    {{-- App CSS --}}
    <link rel="stylesheet" href="/css/app.css">

    {{-- My CSS --}}
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>

    <div class="container-fluid p-0 heydrown-bg login-container">
        <div class="row">
            <div class="col px-5 py-5">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <h2 class="font-weight-bold text-white mb-2">LOGIN TO HEYDROWN</h2>
                            <div class="py-3">

                                @if (env('APP_ENV') == 'local')
                                    <a href="{{ route('social.login', ['website' => 'google']) }}"
                                        class="text-white text-decoration-none"><i class="bi bi-google"></i>&nbsp;
                                        Login
                                        with
                                        google</a>
                                @endif

                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Email Address">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Password">
                            </div>
                            <button class="btn btn-dark btn-block mb-4 btn-login">Login</button>

                            <div class="d-flex flex-column">

                                <a href="{{ route('outside.home') }}" class="text-decoration-none text-white">Back to
                                    Home</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col p-0 d-sm-none d-md-none d-none d-lg-block">
                <img class="float-right img-fluid" src="/img/login-img.jpg" alt="">
            </div>
        </div>
    </div>

    <script src="/js/app.js"></script>
</body>

</html>
