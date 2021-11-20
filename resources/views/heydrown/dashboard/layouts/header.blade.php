<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="/">{{ env('APP_NAME') }}</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse"
        data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="nav-link p-2 m-2 border-0 bg-dark sign-out"> Logout <span
                        data-feather="log-out"></span></button>
            </form>

        </li>
    </ul>
</nav>
