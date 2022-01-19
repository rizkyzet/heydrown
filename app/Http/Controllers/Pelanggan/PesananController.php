<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class PesananController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        // $date = Carbon::now();
        // dd($date->isoFormat('LLLL'));
        $pesanan = Pesanan::where('user_id', Auth::id())->latest()->get();

        return view('heydrown.pelanggan.pesanan.index', compact('pesanan'));
    }


    public function show(Pesanan $pesanan){
        
        return view('heydrown.pelanggan.pesanan.show',compact('pesanan'));
    }
}
