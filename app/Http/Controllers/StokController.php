<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Produk, Ukuran, Stok};
use Illuminate\Support\Facades\Gate;

class StokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('admin');
        $produk = Produk::all();
        $ukuran = Ukuran::all();




        return view('heydrown.dashboard.stok.index', ['produk' => $produk, 'ukuran' => $ukuran]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Produk $produk)
    {
        Gate::authorize('admin');
        $ukuran = Ukuran::all();
        return view('heydrown.dashboard.stok.edit', ['produk' => $produk, 'ukuran' => $ukuran]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function ajax()
    {

        Gate::authorize('admin');
        $produk_id = request()->produk_id;
        $ukuran_id = request()->ukuran_id;
        $jumlah = request()->jumlah;

        // dump($produk_id, $ukuran_id, $jumlah);

        $produk = Produk::find($produk_id)->ukuran->where('id', $ukuran_id);

        if ($produk->count() > 0) {
            // jika jumlah yang di update leibh dari 0
            if ($jumlah > 0) {
                // produk akan di update
                $produk->first()->stok->update(['jumlah' => $jumlah]);
                // selain itu (jika jumlah kurang dari 0)
            } else {
                // maka di data di tabel stok akan ter delete
                $produk->first()->stok->delete();
            };

            return 'Stok updated to ' . $jumlah;
        } else {

            Stok::create([
                'produk_id' => $produk_id,
                'ukuran_id' => $ukuran_id,
                'jumlah' => $jumlah
            ]);

            return 'Stok updated to ' . $jumlah;
        }
    }
}
