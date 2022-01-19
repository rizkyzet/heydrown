<button class="btn btn-dark btn-sm btn-canvas stick m-0 py-5 px-0 d-sm-inline d-inline d-md-none d-lg-none"
    style="opacity: 0.5;"><i class="bi bi-caret-right-fill"></i></button>

<div class="heydrown-offcanvas d-lg-block d-md-block d-sm-block d-block">
    <div class="container">
        <div class="header d-flex justify-content-end align-items-center">
            <button class="btn btn-dark btn-sm btn-canvas border-0">X</button>
        </div>

        <div class="row heydrown-member-area">
            <div class="col sidebar">
                <h5 class="heading">Account</h5>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::RouteIs('pelanggan.profile*') ? 'active' : '' }}"
                            href="{{ route('pelanggan.profile.index') }}">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::RouteIs('pelanggan.alamat*') ? 'active' : '' }}"
                            href="{{ route('pelanggan.alamat.index') }}">Address</a>
                    </li>
                </ul>
                <h5 class="heading">Transaction</h5>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::RouteIs('pelanggan.pesanan*') ? 'active' : '' }}" href="{{ route('pelanggan.pesanan.index') }}">Order History</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
