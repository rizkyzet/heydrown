<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function view()
    {
        dd(\Cart::session(Auth::id())->getContent());
    }
    public function delete()
    {
        \Cart::session(Auth::id())->clear();

        return redirect('/');
    }

    public function edit()
    {
        return view('heydrown.cart');
    }
}
