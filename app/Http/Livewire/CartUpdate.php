<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\{Produk, Ukuran, Stok};

class CartUpdate extends Component
{

    public $cart;
    public $total;
    public $quantity;

    protected $listeners = ['editQuantity' => '$refresh'];

    public function mount()
    {
        $this->cekStokTerkini();


        $this->cart = collect(\Cart::session(Auth::id())->getContent())->sortByDesc(function ($product, $key) {
            return $product['attributes']['addedTime'];
        });

        $this->total = \Cart::session(Auth::id())->getTotal();
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
        session()->flash('infoCart', $message);
    }

    public function delete($id)
    {

        \Cart::session(Auth::id())->remove($id);
        $cartIconQty = \Cart::session(Auth::id())->getContent()->count();

        $this->dispatchBrowserEvent('cart-alert', ['message' => 'Barang berhasil dihapus', 'qty' => $cartIconQty > 0 ? $cartIconQty : '', 'type' => 'delete']);
    }


    public function tambahCart($id, $value)
    {

        $stokMaksimal = $this->getStokMaksimal($id);


        if ($value >= $stokMaksimal) {

            \Cart::session(Auth::id())->update($id, [
                'quantity' => [
                    'relative' => false,
                    'value' => $stokMaksimal
                ],
            ]);

            $this->dispatchBrowserEvent('cart-alert', ['message' => 'Pembelian melebihi batas maksimal', 'type' => 'maks']);
        } else {
            \Cart::session(Auth::id())->update($id, [
                'quantity' => +1
            ]);

            $this->dispatchBrowserEvent('cart-alert', ['message' => 'Produk ditambah', 'type' => 'tambahCart']);
        }
    }


    public function kurangCart($id, $value)
    {


        if ($value == 1) {
            \Cart::session(Auth::id())->remove($id);

            $cartIconQty = \Cart::session(Auth::id())->getContent()->count();

            $this->dispatchBrowserEvent('cart-alert', ['message' => 'Produk dihapus', 'qty' => $cartIconQty > 0 ? $cartIconQty : '', 'type' => 'delete']);
        } else {

            \Cart::session(Auth::id())->update($id, [
                'quantity' => -1
            ]);

            $this->dispatchBrowserEvent('cart-alert', ['message' => 'Produk berkurang', 'type' => 'tambahCart']);
        }
    }


    public function editQuantity($id, $value)
    {


        if ($value <= 0) {
            \Cart::session(Auth::id())->remove($id);
            $cartIconQty = \Cart::session(Auth::id())->getContent()->count();
            $this->dispatchBrowserEvent('cart-alert', ['message' => 'Produk dihapus', 'qty' => $cartIconQty > 0 ? $cartIconQty : '', 'type' => 'delete']);
        } else {

            $stokMaksimal = $this->getStokMaksimal($id);

            if ($value > $stokMaksimal) {


                \Cart::session(Auth::id())->update($id, [
                    'quantity' => [
                        'relative' => false,
                        'value' => $stokMaksimal
                    ],
                ]);

                $this->dispatchBrowserEvent('cart-alert', ['message' => 'Pembelian melebihi batas maksimal!, quantity akan diubah ke batas maksimal', 'type' => 'updateCart']);
                $this->dispatchBrowserEvent('edit-input', ['stokMaks' => $stokMaksimal, 'inputId' => 'input' . $id]);
                // return redirect()->to('/cart');
            } else {

                \Cart::session(Auth::id())->update($id, [
                    'quantity' => [
                        'relative' => false,
                        'value' => $value
                    ],
                ]);
                $this->dispatchBrowserEvent('cart-alert', ['message' => 'Produk berhasil diupdate', 'type' => 'updateCart']);
            }
        }
    }


    public function cekStokMaksimal($id, $value, $type)
    {
        $cart = \Cart::session(Auth::id())->get($id);;

        $idProduk = explode('-', $cart->id)[0];

        $stokProduk = Produk::find($idProduk)->ukuran->where('id', $cart->attributes->ukuran_id)->first()->stok->jumlah;


        if ($type == 'tambah') {

            if ($value >= $stokProduk) {
                return false;
            } else {
                return true;
            };
        } elseif ($type == 'update') {
            if ($value > $stokProduk) {
                return false;
            } else {
                return true;
            };
        }
    }

    public function getCartCount()
    {
        return \Cart::session(Auth::id())->getContent()->count();
    }

    public function getStokMaksimal($id)
    {
        $cart = \Cart::session(Auth::id())->get($id);;

        $idProduk = explode('-', $cart->id)[0];

        $stokProduk = Produk::find($idProduk)->ukuran->where('id', $cart->attributes->ukuran_id)->first()->stok->jumlah;

        return $stokProduk;
    }

    public function render()
    {
        $this->cart = collect(\Cart::session(Auth::id())->getContent())->sortByDesc(function ($product, $key) {
            return $product['attributes']['addedTime'];
        });

        $this->total = \Cart::session(Auth::id())->getTotal();
        // $this->cart = \Cart::session(Auth::id())->getContent();



        return view('livewire.cart-update');
    }
}
