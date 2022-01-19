<div class="sidebar col-4 col-sm-4 col-md-3 col-lg-3 d-sm-none d-none d-md-block d-lg-block">
    <h5 class="heading">Account</h5>
    <hr style="background-color: white;">
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
    <hr style="background-color: white;">
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link {{ Request::RouteIs('pelanggan.pesanan*') ? 'active' : '' }}" href="{{ route('pelanggan.pesanan.index') }}">Order History</a>
        </li>
    </ul>
</div>
