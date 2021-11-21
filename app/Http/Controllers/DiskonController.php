<?php

namespace App\Http\Controllers;

use App\Models\{Diskon, Produk};
use Illuminate\Http\Request;

class DiskonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function redirectTo()
    {
        return redirect()->route('dashboard.diskon.index')->with('failed', 'Pilih Produk!');
    }


    public function index()
    {
        $produk = Produk::all();

        return view('heydrown.dashboard.diskon.index', compact('produk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Produk $produk)
    {

        if (is_null($produk)) {
            return redirect()->route('dashboard.diskon.index')->with('failed', 'Pilih Produk!');
        } elseif ($produk->diskon) {
            return redirect()->route('dashboard.diskon.index')->with('failed', 'Diskon Sudah dibuat!');
        }


        return view('heydrown.dashboard.diskon.create', compact('produk'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validData = $request->validate([
            'berlaku' => 'date|required',
            'potongan' => 'required|numeric|min:1',
            'harga' => 'required|numeric',
            'harga_diskon' => 'required|numeric'
        ]);
        $validData['produk_id'] = $request->produk_id;


        Diskon::create($validData);
        return redirect()->route('dashboard.diskon.index')->with('success', 'Diskon berhasil di set');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Diskon  $diskon
     * @return \Illuminate\Http\Response
     */
    public function show(Diskon $diskon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Diskon  $diskon
     * @return \Illuminate\Http\Response
     */
    public function edit(Produk $produk)
    {

        return view('heydrown.dashboard.diskon.edit', compact('produk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Diskon  $diskon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produk $produk)
    {

        $validData = $request->validate([
            'berlaku' => 'date|required',
            'potongan' => 'required|numeric|min:1',
            'harga' => 'required|numeric',
            'harga_diskon' => 'required|numeric'
        ]);

        $validData['produk_id'] = $request->produk_id;


        $produk->diskon->update($validData);
        return redirect()->route('dashboard.diskon.index')->with('success', 'Diskon berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Diskon  $diskon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produk $produk)
    {
        $produk->diskon->delete();
        return redirect()->route('dashboard.diskon.index')->with('success', 'Diskon berhasil di hapus');
    }
}
