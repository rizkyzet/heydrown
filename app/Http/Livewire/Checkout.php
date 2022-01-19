<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\{Alamat, Kota, LogPesanan, Pembayaran, User};
use Illuminate\Support\Facades\Http;

use App\Models\{Pesanan, Produk, Stok};
use App\Mail\OrderCreated;
use App\Notifications\UserOrderCreated;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB;

class Checkout extends Component
{

    public $dataAlamat;
    public $selectAlamat = [];
    public $cart;
    public $totalBerat;
    public $total;
    public $kurir = [];
    public $service = [];

    public $metodePembayaran;


    public $inputAlamat;
    public $inputKurir;
    public $inputNamaKurir;
    public $inputService;
    public $inputEtd;
    public $inputBiayaKurir;
    public $inputCatatan;
    public $inputTotalBelanja;

    public $pesananID = '';


    protected $rules = [
        'inputAlamat' => 'required',
        'inputKurir' => 'required',
        'metodePembayaran' => 'required'
    ];


    public function mount()
    {
        $this->dataAlamat = Alamat::where('user_id', Auth::id())->get();
    }




    public function updatedInputAlamat($value)
    {
        $this->resetValidation();

        if ($value) {

            $this->selectAlamat = Alamat::find($value);
            $this->inputBiayaKurir = 0;

            $this->kurir = [
                'jne',
                'pos',
                'tiki',
            ];

            $origin = Kota::where('nama', 'Pandeglang')->first()->id;
            $destination = $this->selectAlamat->kota_id;


            foreach ($this->kurir as $kurir) {
                $queryAPI = [
                    'origin' => $origin,
                    'destination' => $destination,
                    'weight' => $this->totalBerat,
                    'courier' => $kurir,
                ];

                $rajaOngkir = Http::withHeaders([
                    'key' => '173c617ab5ce3c42930854ce4ae0f1a2',
                ])->post('https://api.rajaongkir.com/starter/cost', $queryAPI)->json();


                if ($rajaOngkir['rajaongkir']['status']['code'] == 200) {
                    $this->service[$kurir] = $rajaOngkir['rajaongkir']['results'][0]['costs'];
                } else {
                    $this->service[$kurir] = [];
                }
            }

            $this->inputKurir = '';
            // dd($this->service);
        } else {
            $this->inputKurir = '';
            $this->selectAlamat = '';
            $this->service = [];
        }
    }


    public function updatedInputKurir($value)
    {
        $this->resetValidation();
        if ($value) {

            $kode = explode('-', $value);
            $namaKurir = $kode[0];
            $namaService = $kode[1];

            $cek = $this->service[$namaKurir];

            $harga = collect($cek)->first(function ($item, $key) use ($namaService) {
                if ($item['service'] == $namaService) {
                    return $item['cost'][0]['value'];
                }
            });

            $this->inputBiayaKurir = $harga['cost'][0]['value'];
            $this->inputEtd = $harga['cost'][0]['etd'];
            $this->inputNamaKurir = $namaKurir;
            $this->inputService = $namaService;
            $this->inputTotalBelanja = $this->total + $this->inputBiayaKurir;
        } else {
            $this->inputBiayaKurir = 0;
            $this->inputService = '';
            $this->inputNamaKurir = '';
            $this->inputEtd = '';
            $this->selectAlamat = '';
            $this->inputAlamat = '';
        }
    }

    public function hitungTotalBerat()
    {
        return $this->cart->map(function ($value, $key) {

            return $value->associatedModel->berat * $value->quantity;
        })->sum();
    }


    public function checkout()
    {

        $this->validate();
        $cek = $this->cekStokTerkini();

        if (!empty($cek)) {

            return redirect()->route('outside.cart.edit')->with('infoCartToo', $cek);
            
        } else {

            DB::transaction(function () {
                $id = $this->saveOrder();
                $this->saveShipment($id);
                $this->savePayment($id);
                $this->saveDetailOrder($id);
                $this->saveLogPesanan($id);
            });

            $admin = User::where('role_id', 1)->get();
            $user = Auth::user();
         
            Mail::to($user->email)->send(new OrderCreated($this->pesananID));

            Notification::send($admin, new UserOrderCreated($this->pesananID, $user->name));

            $this->dispatchBrowserEvent('alert', ['message' => 'Pesanan berhasil dibuat', 'type' => 'success']);

            \Cart::session(Auth::id())->clear();
        }


        // $this->saveDetailOrder($id = 1);
        // $this->cekStokTerkini();
        // die;

    }



    public function cekStokTerkini()
    {

        $cart = \Cart::session(Auth::id())->getContent();

        $message = [];
        foreach ($cart as $c) {
            $produk_id = $c->associatedModel->id;
            $ukuran_id = $c->attributes->ukuran_id;
            $quantityYgDibeli = $c->quantity;
            $stok = Stok::where(['produk_id' => $produk_id, 'ukuran_id' => $ukuran_id])->first()->jumlah ?? null;

            if ($stok) {
                if ($stok - $quantityYgDibeli < 0) {
                    \Cart::session(Auth::id())->update($c->id, [
                        'quantity' => [
                            'relative' => false,
                            'value' => $stok
                        ],
                    ]);
                    $message[] = $c->name . " size " . $c->attributes->tipe . ' stok yang tersedia hanya ' . $stok . ', produk diubah ke stok maksimal';
                }
            } else {
                \Cart::session(Auth::id())->remove($c->id);
                $message[] = $c->name . " size " . $c->attributes->tipe . ' stok kosong! , produk dihilangkan dari keranjang';
            }
        }

        return $message;



        // dump(Produk::where('id',$dataDetail['produk_id'])->first()->ukuran->where('id',$dataDetail['ukuran_id'])->first()->stok->update('jumlah',));
    }





    public function saveLogPesanan($id)
    {

        $dataLogPesanan = [
            'pesanan_id' => $id,
            'info' => 'Pesanan telah dibuat!',
        ];

        LogPesanan::create($dataLogPesanan);
    }


    public function savePayment($id)
    {
        $dataPayment = [
            'pesanan_id' => $id,
            'metode' => $this->metodePembayaran
        ];

        Pembayaran::create($dataPayment);
    }




    public function saveDetailOrder($id)
    {
        $cart = \Cart::session(Auth::id())->getContent();

        foreach ($cart as $c) {

            $dataDetail = [
                'pesanan_id' => $id,
                'produk_id' => $c->associatedModel->id,
                'ukuran_id' => $c->attributes->ukuran_id,
                'qty' => $c->quantity,
                'harga' => $c->price,
                'diskon' => count($c->conditions) > 0 ? $c->conditions[0]->getAttributes()['diskon'] : null,
                'harga_diskon' => count($c->conditions) > 0 ? $c->getPriceWithConditions() : null,
                'total_harga' => $c->getPriceSumWithConditions(),
                'berat' => $c->attributes->berat,
                'total_berat' => $c->attributes->berat * $c->quantity,
                'created_at' => now()
            ];

            DB::table('detail_pesanan')->insert($dataDetail);


            // ambil data stok produk
            $stokProduk = Stok::where('produk_id', $dataDetail['produk_id'])->where('ukuran_id', $dataDetail['ukuran_id'])->first();

            // kurangi dengan quantity yang dibeli
            $stokDiKurangi = $stokProduk->jumlah - $dataDetail['qty'];

            // jika hasil nya 0 maka stok didelete
            if ($stokDiKurangi == 0) {
                $stokProduk->delete();
            }
            // selain itu stok diupdate
            else {
                $stokProduk->update(['jumlah' => $stokDiKurangi]);
            }
        }
    }

    public function saveShipment($id)
    {

        $dataShipment = [
            'pesanan_id' => $id,
            'nama' => $this->selectAlamat['nama'],
            'provinsi_id' => $this->selectAlamat['provinsi_id'],
            'kota_id' => $this->selectAlamat['kota_id'],
            'kecamatan_id' => null,
            'detail_alamat' => $this->selectAlamat['detail_alamat'],
            'phone' => $this->selectAlamat['phone'],
            'kode_pos' => $this->selectAlamat['kode_pos'],
            'kurir' => $this->inputNamaKurir,
            'servis' => $this->inputService,
            'etd' => $this->inputEtd,
            'total_berat' => $this->totalBerat,
            'biaya' => $this->inputBiayaKurir,
            'created_at' => now(),
        ];

        DB::table('pengiriman')->insert($dataShipment);
    }


    public function saveOrder()
    {

        $dataOrder = [
            'kode' => Pesanan::generatePesananId(),
            'user_id' => Auth::id(),
            'total_qty' => \Cart::session(Auth::id())->getTotalQuantity(),
            'total' => $this->total,
            'grand_total' => $this->inputTotalBelanja,
            'catatan' => $this->inputCatatan,
            'status' => PESANAN::PENDING,
            'expired_at' => now()->addDay(1),
            'created_at' => now()
        ];

        $id = DB::table('pesanan')->insertGetId($dataOrder);
        $this->pesananID = $id;
        return $id;
    }

    public function render()
    {
        $this->cart = \Cart::session(Auth::id())->getContent();
        $this->total = \Cart::session(Auth::id())->getTotal();

        $this->totalBerat = $this->hitungTotalBerat();
        return view('livewire.checkout');
    }
}
