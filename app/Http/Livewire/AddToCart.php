<?php

namespace App\Http\Livewire;

use App\Models\Produk;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Darryldecode\Cart\CartCondition;
use App\Models\Ukuran;

class AddToCart extends Component
{

    public $produk;
    public $ukuran_id;
    public $quantity = 1;
    public $stok;


    public function mount(Produk $produk)
    {

        $this->produk = $produk;
        $this->stok = $produk->ukuran->first()->stok->jumlah;
        $this->ukuran_id = $produk->ukuran->first()->id;
    }

    public function updatedUkuranId($value)
    {
        $this->getStok();
        $this->quantity = 1;
    }

    public function updatedQuantity($value)
    {
        $this->cekStok();
    }

    public function getStok()
    {

        $jumlah = $this->produk->ukuran->where('id', $this->ukuran_id)->first()->stok->jumlah;
        $this->stok = $jumlah;
    }

    public function cekStok()
    {
        if ($this->quantity > $this->stok) {
            $this->dispatchBrowserEvent('addtocart-alert', ['message' => 'Stok tidak cukup!']);
            $this->quantity = $this->stok;
        }
        // elseif ($this->quantity == 0) {
        //     $this->dispatchBrowserEvent('addtocart-alert', ['message' => 'Quantity harus lebih dari 0!']);
        //     $this->quantity = 1;
        // }
    }

    public function cekStokDiCart()
    {
        $cart = \Cart::session(Auth::id())->getContent();
        $ukuran = Ukuran::where('id', $this->ukuran_id)->first();
        $idProdukYgDiCek = $this->produk->id . '-' . $ukuran->tipe;
        $stokYangAda = $this->produk->ukuran->where('id', $this->ukuran_id)->first()->stok->jumlah;

        foreach ($cart as $c) {
            if ($c->id == $idProdukYgDiCek) {
                if ($this->quantity + $c->quantity > $stokYangAda) {
                    return false;
                } elseif ($c->quantity >= $stokYangAda) {
                    return false;
                }
            }
        }

        return true;
    }


    public function addToCart()
    {

        if ($this->quantity == 0) {
            $this->dispatchBrowserEvent('addtocart-alert', ['message' => 'Quantity harus lebih dari 0!']);
            $this->quantity = 1;
        } else {

            if (!Auth::check()) {
                $this->dispatchBrowserEvent('addtocart-alert', ['message' => 'Kamu harus login']);
                return redirect()->route('login');
            } else {

                if ($this->cekStokDiCart()) {


                    $cartItems = array(
                        'id' => $this->produk->id . '-' . $this->produk->ukuran->where('id', $this->ukuran_id)->first()->tipe,
                        'name' => $this->produk->nama,
                        'price' => $this->produk->harga,
                        'quantity' => $this->quantity,
                        'attributes' => [
                            'ukuran_id' => $this->ukuran_id,
                            'tipe' => $this->produk->ukuran->where('id', $this->ukuran_id)->first()->tipe,
                            'addedTime' => date('Y-m-d H:i:s')
                        ],
                        'associatedModel' => $this->produk,
                    );

                    if ($this->produk->diskon) {
                        $itemCondition1 = new CartCondition(array(
                            'name' => 'SALE 5%',
                            'type' => 'sale',
                            'value' => '-5%',
                        ));

                        $cartItems['conditions'] = [$itemCondition1];
                    }


                    \Cart::session(Auth::id())->add($cartItems);

                    $cart = \Cart::session(Auth::id())->getContent();

                    $this->dispatchBrowserEvent('addtocart-run', ['message' => 'Keranjang berhasil ditambah', 'totalCart' => $cart->count()]);
                } else {
                    // $this->dispatchBrowserEvent('addtocart-alert', ['message' => 'Barang ini sudah ada di keranjang kamu dengan stok maksimal!']);
                    $this->dispatchBrowserEvent('addtocart-alert', ['message' => 'Produk ini sudah ada di keranjang, dan melebihi batas maksimal']);
                }
            }
        }
    }


    public function render()
    {

        return view('livewire.add-to-cart');
    }
}
