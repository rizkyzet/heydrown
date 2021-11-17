    {{-- Navbar --}}

    <nav class="navbar navbar-expand-lg heydrown-navbar navbar-dark sticky-top ">
        <a class="navbar-brand font-weight-bold" href="/"><img class="mr-3" src="/img/logo.png" alt=""
                width="40" height="40">{{ env('APP_NAME') }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav mx-auto ">
                <a class="nav-link {{ Request::RouteIs('outside.home') ? 'active' : '' }}"
                    href="{{ route('outside.home') }}">Home</a>
                <a class="nav-link {{ Request::RouteIs('outside.products') ? 'active' : '' }}"
                    href="{{ route('outside.products') }}">Product</a>
                <a class="nav-link {{ Request::RouteIs('outside.about') ? 'active' : '' }}"
                    href="{{ route('outside.about') }}">About</a>
                <a class="nav-link {{ Request::RouteIs('outside.contact') ? 'active' : '' }}"
                    href="{{ route('outside.contact') }}">Contact</a>
            </div>
            <div class="navbar-nav">
                <a class="nav-link" href="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-cart-fill" viewBox="0 0 16 16">
                        <path
                            d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                    </svg>
                    <span class="d-lg-none">Cart</span>
                </a>
                @if (Auth::check())
                    <div class="dropdown">
                        <button class="btn btn-heydrown-black dropdown-toggle text-white font-weight-bold" type="button"
                            id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <form action="/logout" method="POST">
                                @csrf
                                <button class="dropdown-item font-weight-bold">Logout</button>
                            </form>
                        </div>
                    </div>
                @else

                    <a class="nav-link" href="/login">Login</a>
                @endif
            </div>
        </div>
        </div>
    </nav>
