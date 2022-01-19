<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\{Ukuran, Produk, Stok};

class StokProduk extends Component
{

    public $jumlahStok;


    public function ubahStok($jumlah, $produk_id, $ukuran_id)
    {
dd($jumlah);
        $produk = Produk::find($produk_id)->ukuran->where('id', $ukuran_id);
        if ($produk->count() > 0) {
            $produk->first()->stok->update(['jumlah' => $jumlah]);

            $this->dispatchBrowserEvent('stok-updated', ['stok' => $jumlah]);
        } else {

            Stok::create([
                'produk_id' => $produk_id,
                'ukuran_id' => $ukuran_id,
                'jumlah' => $jumlah
            ]);
        }
    }

    public function render()
    {

        $ukuran = Ukuran::all();
        $produk = Produk::all();

        return view('livewire.stok-produk', ['ukuran' => $ukuran, 'produk' => $produk]);
    }
}
