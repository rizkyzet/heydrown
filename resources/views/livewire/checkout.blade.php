<div>
    <div wire:loading wire:target='inputAlamat' class="loadingio-spinner-eclipse-sjcxxe8dx0b">
        <div class="ldio-hf202owlnef">
            <div></div>
        </div>
    </div>
    <form wire:submit.prevent="checkout">
        <div class="row row-cols-lg-2 row-cols-md-2 row-cols-sm-1 row-cols-1">
            <div class="col order-lg-1 order-md-1 order-sm-1 order-1 mb-5">
                <h4 class="font-weight-bold lsp-5 mb-3">SHIPMENT</h4>
                {{-- ALAMAT --}}
                <div class="form-group heydrown-form-group">
                    <label for="alamat">Alamat pengiriman</label>
                    <select wire:model='inputAlamat' id="alamat" class="form-control heydrown-input">
                        <option value="">Pilih Alamat</option>
                        @foreach ($dataAlamat as $a)
                            <option value="{{ $a->id }}">
                                {{ $a->nama . ' - ' . $a->detail_alamat }}</option>
                        @endforeach
                    </select>
                    @error('inputAlamat')
                        <small class='text-danger'>{{ $message }}</small>
                    @enderror
                    <div class="heydrown-input mt-2 p-2" style="height: 120px;overflow-y:auto;">
                        <?= $selectAlamat ? $selectAlamat->nama . '<br>' . $selectAlamat->detail_alamat . '<br>' . $selectAlamat->kota->type . ' ' . $selectAlamat->kota->nama . ' - Provinsi ' . $selectAlamat->provinsi->nama : '' ?>
                    </div>
                    <small class="text-white">*ingin edit atau tambah alamat? <a class="text-white"
                            href="{{ route('pelanggan.alamat.index') }}">Click
                            disini!</a></small>
                </div>

                {{-- <div class="row">
                <div class="col">

                    <div class="form-group heydrown-form-group">
                        <label for="kurir">Kurir</label>
                        <select wire:model="kurir" id="kurir" class="form-control heydrown-input">
                            <option value="">Pilih Kurir</option>
                        </select>
                    </div>
                </div>

                <div class="col">

                    <div class="form-group heydrown-form-group">
                        <label for="Service">Service</label>
                        <select wire:model="Service" id="Service" class="form-control heydrown-input">
                            <option value="">Pilih Service</option>
                        </select>
                    </div>
                </div>
            </div> --}}

                {{-- KURIR --}}
                <div class="form-group heydrown-form-group">
                    <label for="inputKurir">Kurir</label>
                    <select id="inputKurir" wire:model="inputKurir" class="form-control heydrown-input">
                        <option value="">Pilih Kurir</option>
                        @foreach ($service as $key => $s)
                            <optgroup label="{{ strtoupper($key) }}">
                                @foreach ($s as $ongkir)
                                    <option value="{{ $key . '-' . $ongkir['service'] }}">
                                        {{ $ongkir['service'] . ' - Rp. ' . rupiah($ongkir['cost'][0]['value']) . ' (' . $ongkir['cost'][0]['etd'] . ' Hari)' }}
                                    </option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                    @error('inputKurir')
                        <small class='text-danger'>{{ $message }}</small>
                    @enderror
                </div>
                {{-- <input type="text" wire:model="inputBiayaKurir">
            <input type="text" wire:model="inputService">
            <input type="text" wire:model="inputNamaKurir"> --}}

                {{-- CATATAN --}}
                <div class="form-group heydrown-form-group">
                    <label for="catatan">Catatan</label>
                    <textarea wire:model='inputCatatan' id="catatan" cols="30" rows="5"
                        class="form-control heydrown-input"></textarea>
                </div>
            </div>
            <div class="col order-lg-1 order-md-1 order-sm-1 order-1">
                <h4 class="font-weight-bold lsp-5 mb-4 ">PAYMENT</h4>

                <table class="table text-white table-sm table-borderless">

                    @foreach ($cart as $c)
                        <tr style="border-bottom: 2px solid white;">
                            <td align="center" class="text-center pt-2">
                                <img src="{{ asset('storage/' . $c->associatedModel->foto) }}" alt=""
                                    class="img-thumbnail" width="50" height="50">
                            </td>
                            <td>
                                {{ $c->associatedModel->nama . ' (' . $c->attributes->tipe . ') ' . ' x' . $c->quantity }}

                                @if (count($c->conditions) > 0)
                                    @foreach ($c->conditions as $condition)
                                        <small class="ml-2 py-1 px-2"
                                            style="background: black">{{ $condition->getValue() }}</small>
                                    @endforeach
                                @endif
                            </td>

                            <td class="text-right" align="center">
                                @if (count($c->conditions) > 0)
                                    <small style="text-decoration:line-through">Rp.
                                        {{ rupiah($c->getPriceSum(false)) }}
                                    </small>
                                    <p>Rp. {{ rupiah($c->getPriceSumWithConditions(false)) }} </p>
                                @else
                                    <p>Rp. {{ rupiah($c->getPriceSum(false)) }} </p>
                                @endif
                            </td>
                        </tr>
                        {{-- <tr style="border-bottom: 1px solid white;">
                        <td>
                            <small>{{ $c->associatedModel->kategori->nama }}</small>

                        </td>
                    </tr> --}}
                    @endforeach


                    <tr class="text-right table-borderless">
                        <td colspan="2">Total Berat:</td>
                        <td>{{ $totalBerat . ' gram' }}</td>
                    </tr>

                    <tr class="text-right table-borderless">
                        <td colspan="2">Shipment:</td>
                        <td>{{ 'Rp. ' . rupiah($inputBiayaKurir) }}</td>
                    </tr>

                    <tr class="text-right table-borderless">
                        <td colspan="2">Sub Total :</td>
                        <td style="width: 50%;">{{ 'Rp. ' . rupiah($total) }}</td>
                    </tr>

                    <tr class="text-right table-borderless">
                        <td colspan="2">Total Belanja :</td>
                        <td>{{ 'Rp. ' . rupiah($inputTotalBelanja) }}</td>
                    </tr>

                </table>

                <label for="" class="d-block">Metode Pembayaran</label>
                <div class="form-check heydrown-form-check d-inline mr-3">
                    <input class="form-check-input" type="radio" wire:model="metodePembayaran" id="metodePembayaran"
                        value="transfer">
                    <label class="form-check-label" for="metodePembayaran">
                        Bank Transfer
                    </label>
                </div>

                @error('metodePembayaran')
                    <small class="d-block text-danger">{{ $message }}</small>
                @enderror


                <div class="card card-body text-dark mt-2">
                    <div class="d-flex justify-content-center" wire:loading wire:target="metodePembayaran">
                        <div class="spinner-border" role="status" wire:loading wire:target="metodePembayaran">
                        </div>
                    </div>

                    @if ($metodePembayaran == 'transfer')

                        <div wire:loading.remove wire:target="metodePembayaran">
                            <p>Bagi yang ingin melakukan transfer melalui:

                                ATM, Setor Tunai, M-Banking, SMS banking, E-Banking.

                                Harap diperhatikan setelah selesai melakukan order harap segera lakukan transfer
                                MAKSIMAL 24 JAM setelah selesai order.</p>
                        </div>
                    @else
                        <div wire:loading.remove wire:target="metodePembayaran">

                        </div>

                    @endif

                </div>


            </div>
        </div>

        <div class="row mt-3">
            <div class="col d-flex justify-content-between">
                <a href="{{ route('outside.cart.edit') }}" class="btn btn-heydrown-black text-white">Back to cart</a>
                <button class="btn btn-heydrown-black text-white">Buat Pesanan</button>
            </div>
        </div>



    </form>
</div>

@push('scripts')
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'center',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: false,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            },
            background: 'black',
            iconColor: 'white',

        })


        window.addEventListener('alert', event => {
            Toast.fire({
                icon: event.detail.type == 'error' ? 'error' : 'success',
                title: '<h5 style="color:white;text-align:center;">' + event.detail.message + '</h5>',
                willClose: () => {
                    document.location.href = "{{ route('pelanggan.pesanan.index') }}"
                }
            })
        })
    </script>
@endpush


@push('css')

    <style type="text/css">
        @keyframes ldio-hf202owlnef {
            0% {
                transform: rotate(0deg)
            }

            50% {
                transform: rotate(180deg)
            }

            100% {
                transform: rotate(360deg)
            }
        }

        .ldio-hf202owlnef div {

            animation: ldio-hf202owlnef 1s linear infinite;
            width: 160px;
            height: 160px;
            border-radius: 50%;
            box-shadow: 0 4px 0 0 #ffffff;
            transform-origin: 80px 82px;
        }

        .loadingio-spinner-eclipse-sjcxxe8dx0b {

            display: inline-block;
            overflow: hidden;
            background: #000000cd;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 100000000;

        }

        .ldio-hf202owlnef {
            width: 100%;
            height: 100%;
            position: relative;
            transform: translateZ(0) scale(1);
            backface-visibility: hidden;
            transform-origin: 0 0;
            /* see note above */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .ldio-hf202owlnef div {
            box-sizing: content-box;
        }

        /* generated by https://loading.io/ */

    </style>
@endpush
