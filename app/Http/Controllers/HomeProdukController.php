<?php

namespace App\Http\Controllers;

use App\Models\{Kategori, Produk, Diskon};
use Illuminate\Http\Request;

class HomeProdukController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {

        $kategori = Kategori::all();

        $data = Produk::with('diskon')->latest();
        $data = $data->filter(request(['search', 'kategori']))->get();

        if (request('kategori')) {
            $title = ucwords(Kategori::firstWhere('slug', request('kategori'))->nama);
        } elseif (request('event')) {
            $title = ucwords(request('event'));
            $data = Diskon::with('produk')->filter(request(['search']))->get();
        } else {
            $title = 'All Product';
        }


        return view('heydrown.products', compact('kategori', 'data', 'title'));
    }
}
