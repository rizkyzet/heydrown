<div>


    {{-- Care about people's approval and you will be their prisoner. --}}

    <div class="container p-5" style="min-height: 100vh;">
        <h4 class="font-weight-bold text-center lsp-5">Your Cart</h4>
        @if (Session::has('infoCart'))
            @foreach (Session::get('infoCart') as $s)
                <div class="alert alert-dark alert-dismissible fade show" role="alert">
                    <strong>Maaf! Ada Perubahan data di stok kami : </strong> {{ $s }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endforeach
        @endif


        @if (Session::has('infoCartToo'))
            @foreach (Session::get('infoCartToo') as $s)
                <div class="alert alert-dark alert-dismissible fade show" role="alert">
                    <strong>Maaf proses checkout anda terganggu, ada Perubahan data di stok kami : </strong>
                    {{ $s }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endforeach
        @endif

        <div class="row position-relative">

            @forelse ($cart as $c)
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 my-2">
                    <div class="row justify-content-center cart-edit position-relative">
                        <div class="col-12 col-sm-12 col-md-2 col-lg-1 ">
                            <a href="{{ route('outside.product', $c->associatedModel) }}">
                                <img src="{{ asset('storage/' . $c->associatedModel->foto) }}" alt="..."
                                    class="img-fluid">
                            </a>
                            <button class="heydrown-bg-black btn btn-dark btn-sm border-0 font-weight-bold"
                                style="position: absolute;top:0;left:0;border-radius:50%;"
                                wire:click="delete('{{ $c->id }}')" type="button">X</button>
                        </div>

                        <div
                            class="col-12 col-sm-12 col-md-3 col-lg-3 d-flex align-items-center justify-content-start p-3">
                            <div class="cart-deskripsi">
                                <p class="font-weight-bold p-0 m-0">{{ $c->name }}</p>
                                <p class="p-0 m-0 d-inline mr-2">Size
                                    {{ $c->attributes->tipe }}
                                </p>
                                @if (count($c->conditions) > 0)
                                    @foreach ($c->conditions as $condition)
                                        <small
                                            class="px-2 py-1 heydrown-bg-black">{{ $condition->getValue() }}</small>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <div
                            class="col-12 col-sm-12 col-md-2 col-lg-2 d-flex align-items-center justify-content-center p-1">
                            <button type="button" class="btn btn-sm btn-dark heydrown-bg-black" style="width:25px;"
                                wire:click="kurangCart('{{ $c->id }}','{{ $c->quantity }}')"
                                wire:loading.attr="disabled"
                                wire:target="kurangCart('{{ $c->id }}','{{ $c->quantity }}')">-</button>
                            <input id="input{{ $c->id }}" type="number"
                                class="form-control text-center col-4 cart-quantity"
                                style="height: 28px;border-radius:0;" value="{{ $c->quantity }}"
                                wire:change="editQuantity('{{ $c->id }}',$event.target.value)">
                            <button type="button" class="btn btn-sm btn-dark heydrown-bg-black" style="width:25px;"
                                wire:click="tambahCart('{{ $c->id }}','{{ $c->quantity }}')"
                                wire:loading.attr="disabled"
                                wire:target="tambahCart('{{ $c->id }}','{{ $c->quantity }}')">+</button>
                        </div>
                        <div
                            class="col-12 col-sm-12 col-md-3 col-lg-3 d-flex flex-column align-items-center justify-content-center p-3 text-center">

                            @if (count($c->conditions) > 0)
                                {{-- <small style="text-decoration: line-through">Rp.
                                    {{ $c->associatedModel->harga }}</small> --}}
                                <p>Rp. {{ rupiah($c->getPriceSumWithConditions(false)) }} </p>
                            @else
                                <p>Rp. {{ rupiah($c->getPriceSum(false)) }} </p>
                            @endif

                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 d-flex justify-content-center">
                    <h3 class="text-center mt-5" style="letter-spacing: 10px">CART EMPTY</h3>
                </div>
            @endforelse




        </div>

        <div class="row justify-content-center">
            <div class="col-12 col-sm-12 col-md-10 col-lg-10 my-3 ">
                <hr style="border:1px solid black;">

                <div class="d-flex justify-content-end">
                    <p><strong>Total</strong> : Rp. {{ rupiah($total) }}</p>
                </div>

                <div class="d-flex justify-content-between mt-5">
                    <a class="btn btn-dark btn-heydrown" href="{{ route('outside.products') }}">Continue Shopping</a>
                    <a class="btn btn-dark btn-heydrown" href="{{ route('outside.checkout.index') }}">Checkout</a>
                </div>
            </div>
        </div>

    </div>

</div>
