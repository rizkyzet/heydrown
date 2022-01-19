<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Produk, Diskon};
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        return view('home');
    }

    public function home()
    {

   
        $newProduk = Produk::take(8)->orderBy('created_at', 'desc')->get();
        $diskonProduk = Diskon::take(8)->get();



        return view('heydrown.home', compact('newProduk', 'diskonProduk'));
    }
}
