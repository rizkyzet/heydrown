@extends('heydrown.layouts.app')


@section('content')

    {{-- <div class="heydrown-banner banner-products d-flex justify-content-center align-items-center">
        <h5 class="font-weight-bold text-white lsp-5">OUR PRODUCTS</h5>
    </div> --}}
    <div class="heydrown-banner banner-empty d-flex justify-content-center align-items-center">

    </div>
    <div class="container mt-5">
        <div class="row m-0 p-0" style="min-height: 100vh;position: relative;">
            <button class="btn btn-dark btn-sm btn-canvas stick m-0 px-0 py-5 d-sm-inline d-inline d-md-block d-lg-block"><i
                    class="bi bi-caret-right-fill"></i></button>

            <div class="heydrown-offcanvas d-lg-block d-md-block d-sm-block d-block">
                <div class="container">
                    <div class="header d-flex justify-content-end align-items-center">
                        <button class="btn btn-dark btn-sm btn-canvas border-0">X</button>
                    </div>
                    <ul class="kategori-container">
                        <li class="p-2">
                            <a class="text-white {{ !request('event') && !request('kategori') ? 'active' : '' }}"
                                href="{{ route('outside.products') }}">All</a>
                        </li>
                        <li class="p-2">
                            <a class="text-white {{ request('event') == 'sale' ? 'active' : '' }}"
                                href="{{ route('outside.products') . '?event=sale' }}">Sale</a>
                        </li>
                        @foreach ($kategori as $k)
                            <li class="p-2">
                                <a class="text-white {{ request('kategori') == $k->slug ? 'active' : '' }}"
                                    href="{{ route('outside.products') . '?kategori=' . $k->slug }}">{{ $k->nama }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            {{-- <div class="col-4 col-md-3 col-lg-2 d-sm-none d-lg-block d-md-block d-none" style="background-color: black;">
                <nav class="nav flex-column heydrown-sidebar">
                    <div class="mb-4">
                        <a class="nav-link px-2 my-2 {{ !request('event') && !request('kategori') ? 'active' : '' }}"
                            href="{{ route('outside.products') }}">All</a>
                        <a class="nav-link px-2 my-2 {{ request('event') == 'sale' ? 'active' : '' }}"
                            href="{{ route('outside.products') . '?event=sale' }}">Sale</a>
                        @foreach ($kategori as $k)
                            <a class="nav-link px-2 my-2 {{ request('kategori') == $k->slug ? 'active' : '' }}"
                                href="{{ route('outside.products') . '?kategori=' . $k->slug }}">{{ $k->nama }}</a>
                        @endforeach
                    </div>
                </nav>
            </div> --}}

            <div class="col">
                @include('heydrown.layouts.alert')

                <div class="row justify-content-between py-3 row-cols-lg-2 row-cols-md-1 row-cols-sm-1 row-cols-1">
                    <div class="col">
                        <h3 class="font-weight-bold px-2">{{ $title }}</h3>
                    </div>

                    <form action="{{ route('outside.products') }}" method="GET">
                        <div class="col d-flex align-items-center flex-sm-column flex-lg-row flex-md-row flex-column">
                            @if (request('kategori'))
                                <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                            @endif
                            @if (request('event'))
                                <input type="hidden" name="event" value="{{ request('event') }}">
                            @endif
                            <input type="text" class="form-control d-inline mb-2"
                                placeholder="{{ (request('kategori') ? 'search in  ' . strtolower($title) : request('event')) ? 'search in ' . strtolower($title) : 'search all product...' }}"
                                name="search" value="{{ request('search') }}">
                            <button class="btn btn-dark btn-heydrown-black align-self-end mb-2">Search</button>
                        </div>
                    </form>


                </div>


                <div class="row row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-2">
                    @if (request('event') == 'sale')
                        {{-- BY SALE --}}
                        @forelse ($data as $diskon)
                            @if ($diskon->produk->ukuran->count() > 0)
                                <div class="col px-4 py-4">
                                    <div class="card bg-transparent heydrown-card border-0">
                                        <div class="position-absolute top-0 d-flex" style="z-index:2;">
                                            <div class="text-white font-weight-bold px-3 mr-1 heydrown-bg-black">
                                                {{ $diskon->potongan . '% Off' }}</div>
                                        </div>
                                        <a href="{{ route('outside.product', $diskon->produk) }}"
                                            class="product-photo-click position-relative">
                                            <img src="{{ asset('storage/' . $diskon->produk->foto) }}"
                                                class="card-img-top product-photo" alt="{{ $diskon->produk->nama }}">
                                        </a>
                                        <div class="card-body px-0 py-1">
                                            <a href="{{ route('outside.product', $diskon->produk) }}"
                                                class="text-decoration-none font-weight-bold text-white product-name">
                                                {{ $diskon->produk->nama }}
                                            </a>
                                            <div class="product-harga">
                                                <small class="mr-2 text-muted" style="text-decoration: line-through">Rp.
                                                    {{ rupiah($diskon->produk->harga) }}</small>
                                                <p>Rp. {{ rupiah($diskon->harga_diskon) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col px-4 py-4">
                                    <div class="card bg-transparent heydrown-card border-0">
                                        <div class="position-absolute top-0 d-flex" style="z-index:2;">
                                            <div class="text-white font-weight-bold px-3 mr-1 heydrown-bg-black">
                                                {{ $diskon->potongan . '% Off' }}</div>
                                        </div>
                                        <div class="position-relative">
                                            <img src="{{ asset('storage/' . $diskon->produk->foto) }}"
                                                class="card-img-top product-photo" alt="{{ $diskon->produk->nama }}">
                                            <span class="text-center p-2 out-of-stock">
                                                OUT OF
                                                STOCK</span>
                                        </div>
                                        <div class="card-body px-0 py-1">
                                            <span class="text-decoration-none font-weight-bold text-white product-name">
                                                {{ $diskon->produk->nama }}
                                            </span>
                                            <div class="product-harga">
                                                <small class="mr-2 text-muted" style="text-decoration: line-through">Rp.
                                                    {{ rupiah($diskon->produk->harga) }}</small>
                                                <p>Rp. {{ rupiah($diskon->harga_diskon) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @empty
                            <div class="col px-4 py-4 d-flex justify-content-center">
                                <div style="letter-spacing: 5px">Product empty</div>
                            </div>
                        @endforelse
                    @else
                        {{-- BY KATEGORI --}}
                        @forelse ($data as $p)

                            @if ($p->ukuran->count() > 0)
                                <div class="col px-4 py-4">
                                    <div class="card bg-transparent heydrown-card border-0">
                                        <div class="position-absolute top-0 d-flex" style="z-index:2;">
                                            @if ($p->diskon)
                                                <div class="text-white font-weight-bold px-3 mr-1 heydrown-bg-black">
                                                    {{ $p->diskon->potongan . '% Off' }}</div>
                                            @endif
                                        </div>
                                        <a href="{{ route('outside.product', $p) }}"
                                            class="product-photo-click position-relative">
                                            <img src="{{ asset('storage/' . $p->foto) }}"
                                                class="card-img-top product-photo" alt="{{ $p->nama }}">
                                        </a>
                                        <div class="card-body px-0 py-1">
                                            <a href="{{ route('outside.product', $p) }}"
                                                class="text-decoration-none font-weight-bold text-white product-name">
                                                {{ $p->nama }}
                                            </a>
                                            <div class="product-harga">
                                                @if ($p->diskon)
                                                    <small class="mr-2 text-muted" style="text-decoration: line-through">Rp.
                                                        {{ rupiah($p->harga) }}</small>
                                                    <p>Rp. {{ rupiah($p->diskon->harga_diskon) }}</p>
                                                @else
                                                    <p>Rp. {{ rupiah($p->harga) }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @else
                                <div class="col px-4 py-4">
                                    <div class="card bg-transparent heydrown-card border-0">
                                        <div class="position-absolute top-0 d-flex" style="z-index:2;">
                                            @if ($p->diskon)
                                                <div class="text-white font-weight-bold px-3 mr-1 heydrown-bg-black">
                                                    {{ $p->diskon->potongan . '% Off' }}</div>
                                            @endif
                                        </div>

                                        <div class="position-relative">
                                            <img src="{{ asset('storage/' . $p->foto) }}"
                                                class="card-img-top product-photo" alt="{{ $p->nama }}">
                                            <span class="text-center p-2 out-of-stock">
                                                OUT OF
                                                STOCK</span>
                                        </div>

                                        <div class="card-body px-0 py-1">
                                            <span class="text-decoration-none font-weight-bold text-white product-name">
                                                {{ $p->nama }}
                                            </span>
                                            <div class="product-harga">
                                                @if ($p->diskon)
                                                    <small class="mr-2 text-muted" style="text-decoration: line-through">Rp.
                                                        {{ rupiah($p->harga) }}</small>
                                                    <p>Rp. {{ rupiah($p->diskon->harga_diskon) }}</p>
                                                @else
                                                    <p>Rp. {{ rupiah($p->harga) }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @empty
                            <div class="col px-4 py-4 d-flex justify-content-center">
                                <div style="letter-spacing: 5px">Product empty</div>
                            </div>
                        @endforelse
                    @endif
                </div>
            </div>

        </div>
    </div>
    </div>
    </div>


@endsection

@push('scripts')
    <script>
        $('.btn-canvas').on('click', function() {
            $('.heydrown-offcanvas').toggleClass('slide');

        });
    </script>
@endpush
