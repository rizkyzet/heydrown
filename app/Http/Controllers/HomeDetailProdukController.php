<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class HomeDetailProdukController extends Controller
{
    public function index(Produk $produk)
    {
        if ($produk->ukuran->count() == 0) {
            return redirect(route('outside.products') . '?search=' . $produk->nama)
                ->with('alert', 'Stok Kosong!');
        }

        return view('heydrown.product', compact('produk'));
    }
}
