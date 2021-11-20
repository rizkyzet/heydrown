<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="user"></span>
                    Profil
                </a>
            </li>
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
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Saved reports</span>
            <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
                <span data-feather="plus-circle"></span>
            </a>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="file-text"></span>
                    Current month
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="file-text"></span>
                    Last quarter
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="file-text"></span>
                    Social engagement
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="file-text"></span>
                    Year-end sale
                </a>
            </li>
        </ul>
    </div>
</nav>
