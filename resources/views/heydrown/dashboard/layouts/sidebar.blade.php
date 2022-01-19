<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
            {{-- <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="user"></span>
                    Profil
                </a>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('dashboard.kategori*') ? 'active' : '' }}"
                    href="{{ route('dashboard.kategori.index') }}">
                    <span data-feather="tag"></span>
                    Kategori
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::RouteIs('dashboard.produk*') ? 'active' : '' }}"
                    href="{{ route('dashboard.produk.index') }}">
                    <span data-feather="shopping-cart"></span>
                    Produk
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::RouteIs('dashboard.stok*') ? 'active' : '' }}"
                    href="{{ route('dashboard.stok.index') }}">
                    <span data-feather="layers"></span>
                    Stock
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::RouteIs('dashboard.ukuran*') ? 'active' : '' }}"
                    href="{{ route('dashboard.ukuran.index') }}">
                    <span data-feather="scissors"></span>
                    Ukuran
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::RouteIs('dashboard.diskon*') ? 'active' : '' }}"
                    href="{{ route('dashboard.diskon.index') }}">
                    <span data-feather="percent"></span>
                    Diskon
                </a>
            </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Transaksi</span>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link" href="{{route('dashboard.pesanan.index')}}">
                    <span data-feather="file-text"></span>
                    Transaksi
                </a>
            </li>
        </ul>
    </div>
</nav>
