<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Provinsi;

class AlamatController extends Controller
{



    public function index()
    {
        return view('heydrown.pelanggan.alamat.index');
    }

    public function create()
    {
        return view('heydrown.pelanggan.alamat.create');
    }
}
