    {{-- Navbar --}}

    <nav class="navbar navbar-expand-lg heydrown-navbar navbar-dark fixed-top p-2">
        <div class="container">


            <a class="navbar-brand font-weight-bold m-0 p-0" href="/">
                <img src="/img/logo2.png" alt="" width="150" height="50" class="mr-1">
                {{-- <span class="d-inline d-sm-inline d-md-inline d-lg-inline">{{ env('APP_NAME') }}</span> --}}
            </a>

            {{-- tablet --}}
            <div class=" d-flex justify-content-end">
                <a href="{{ route('outside.cart.edit') }}" class="nav-link d-lg-none px-0">
                    <i class="bi bi-cart-plus-fill"></i>
                    @auth
                        <span
                            class="text-white font-weight-bold cart-quantity">{{ Cart::session(Auth::id())->getContent()->count() > 0
                                ? Cart::session(Auth::id())->getContent()->count()
                                : '' }}
                        </span>
                    @else
                        <span class="text-white font-weight-bold cart-quantity"></span>
                    @endauth
                </a>

                <button class="nav-link border-0 bg-transparent btn-nav-canvas d-block d-sm-block d-md-block d-lg-none"
                    data-offcanvas="offcanvas-login"><i class="bi bi-person-fill"></i></button>

                <button class="navbar-toggler p-0 btn-nav-canvas" type="button" data-toggle="collapse"
                    data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                    aria-label="Toggle navigation" data-offcanvas="offcanvas-menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            {{-- pc --}}
            <div class="collapse navbar-collapse">

                <div class="navbar-nav ml-auto px-3">
                    <a class="nav-link {{ Request::RouteIs('outside.home') ? 'active' : '' }}"
                        href="{{ route('outside.home') }}">HOME</a>
                    <a class="nav-link {{ Request::RouteIs('outside.products') ? 'active' : '' }}"
                        href="{{ route('outside.products') }}">PRODUCTS</a>
                    <a class="nav-link {{ Request::RouteIs('outside.about') ? 'active' : '' }}"
                        href="{{ route('outside.about') }}">ABOUT</a>
                    <a class="nav-link {{ Request::RouteIs('outside.contact') ? 'active' : '' }}"
                        href="{{ route('outside.contact') }}">CONTACT</a>
                </div>

                <strong class="text-white mx-3 nav-link d-none d-sm-none d-md-none d-lg-block">|</strong>

                <div class="navbar-nav">

                    <a class="nav-link d-sm-none d-md-none d-lg-block d-none cart-icon"
                        href="{{ route('outside.cart.edit') }}">
                        <i class="bi bi-cart-plus-fill"></i>
                        @auth
                            <span
                                class="text-white font-weight-bold cart-quantity">{{ Cart::session(Auth::id())->getContent()->count() > 0
                                    ? Cart::session(Auth::id())->getContent()->count()
                                    : '' }}
                            </span>
                        @else
                            <span class="text-white font-weight-bold cart-quantity"></span>
                        @endauth
                    </a>
                    {{-- @if (Auth::check())
                        <div class="dropdown">
                            <button class="btn btn-heydrown-black dropdown-toggle text-white font-weight-bold"
                                type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item font-weight-bold"
                                    href="{{ route('dashboard') }}">Dashboard</a>
                                <form action="/logout" method="POST">
                                    @csrf
                                    <button class="dropdown-item font-weight-bold">Logout</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a class="nav-link" href="/login"><i class="bi bi-person-fill"></i></a>
                        <button class="nav-link border-0 bg-transparent btn-nav-canvas" href=""><i
                                class="bi bi-person-fill"></i></button>
                    @endif --}}

                    <button
                        class="nav-link border-0 bg-transparent btn-nav-canvas d-none d-sm-none d-md-none d-lg-block"
                        data-offcanvas="offcanvas-login">
                        <i class="bi bi-person-fill"></i></button>
                </div>
            </div>
        </div>
    </nav>


    {{-- Heydrown OffCanvas Login --}}
    <div class="heydrown-nav-offcanvas" id="offcanvas-login">
        <div class="container p-4 text-white">
            <div class="row justify-content-between align-items-center mb-3 mx-2">
                <div class="col-4 col-sm-3 col-md-3 col-lg-3">
                    <img src="/img/logo3.png" alt="" class="img-fluid">
                </div>
                <div class="col-4 col-sm-3 col-md-3 col-lg-3">
                    <button
                        class="bg-transparent border-0 text-white font-weight-bold btn-nav-canvas-close btn btn-lg border-0 btn-heydrown-transparent"
                        tabindex="-1" data-offcanvas="offcanvas-login">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-x-lg"
                            viewBox="0 0 16 16" style="min-height: 30px;">
                            <path fill-rule="evenodd"
                                d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z" />
                            <path fill-rule="evenodd"
                                d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="row login-offcanvas mx-2 mb-3">
                <div class="col">
                    <h5 class="heading">LOGIN</h5>
                    <form action="" class="form p-3 mt-3">
                        <div class="form-group">
                            <label for="">Email Address</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="text" class="form-control">
                        </div>
                        <button class="btn btn-heydrown-black text-white btn-sm px-4">LOG IN</button>
                    </form>
                </div>
            </div>

            <div class="row m-2 socialite ">
                <div class="col d-flex justify-content-center">
                    <a href="{{ route('social.login', ['website' => 'google']) }}"
                        class="btn btn-block font-weight-bold text-white px-3 bg-transparent"><i
                            class="bi bi-google"></i>&nbsp;
                        LOGIN
                        WITH GOOGLE</a>
                </div>
            </div>

            <h5 class="text-center font-weight-bold text-white mt-5 p-3">FIND US</h5>
            <div class="row m-2 find-us">
                <div class="col d-flex justify-content-around align-items-center py-0 px-3 m-0">
                    <a class="btn btn-lg font-weight-bold text-white p-0 m-0 bg-transparent"><i class="bi bi-twitter"
                            width="40" height="50"></i></a>
                    <a class="btn btn-lg font-weight-bold text-white p-0 m-0 bg-transparent"><i class="bi bi-instagram"
                            width="40" height="50"></i></a>
                    <a class="btn btn-lg font-weight-bold text-white p-0 m-0 bg-transparent"><i class="bi bi-youtube"
                            width="40" height="50"></i></a>
                    <a class="btn btn-lg font-weight-bold text-white p-0 m-0 bg-transparent"><i class="bi bi-envelope"
                            width="40" height="50"></i></a>
                    <a class="btn btn-lg font-weight-bold text-white p-0 m-0 bg-transparent"><i class="bi bi-whatsapp"
                            width="40" height="50"></i></a>
                </div>
            </div>

        </div>
    </div>




    <div class="heydrown-nav-offcanvas" id="offcanvas-menu">
        <div class="container p-4 text-white">
            <div class="row justify-content-between align-items-center mb-3 mx-2">
                <div class="col-4 col-sm-3 col-md-3 col-lg-3">
                    <img src="/img/logo3.png" alt="" class="img-fluid">
                </div>
                <div class="col-4 col-sm-3 col-md-3 col-lg-3">
                    <button
                        class="bg-transparent border-0 text-white font-weight-bold btn-nav-canvas-close btn btn-lg border-0 btn-heydrown-transparent"
                        tabindex="-1" data-offcanvas="offcanvas-menu">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-x-lg"
                            viewBox="0 0 16 16" style="min-height: 30px;">
                            <path fill-rule="evenodd"
                                d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z" />
                            <path fill-rule="evenodd"
                                d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z" />
                        </svg>
                    </button>
                </div>

            </div>

            <div class="row">
                <div class="col-12">
                    <div class="list-group menu">
                        <a href="{{ route('outside.home') }}"
                            class="list-group-item list-group-item-action bg-transparent text-white border-0 {{ Request::RouteIs('outside.home') ? 'active' : '' }}">HOME</a>
                        <a href="{{ route('outside.products') }}"
                            class="list-group-item list-group-item-action bg-transparent text-white border-0 {{ Request::RouteIs('outside.products') ? 'active' : '' }}">PRODUCTS</a>
                        <a href="{{ route('outside.about') }}"
                            class="list-group-item list-group-item-action bg-transparent text-white border-0 {{ Request::RouteIs('outside.about') ? 'active' : '' }}">ABOUT</a>
                        <a href="{{ route('outside.contact') }}"
                            class="list-group-item list-group-item-action bg-transparent text-white border-0 {{ Request::RouteIs('outside.contact') ? 'active' : '' }}">CONTACT</a>
                    </div>

                </div>
            </div>


        </div>
    </div>
