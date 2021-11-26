<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
    }

    public function index()
    {
        Gate::authorize('admin');
        $produk = Produk::latest()->get();
        return view('heydrown.dashboard.produk.index', compact('produk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('admin');
        $kategori = Kategori::all();
        return view('heydrown.dashboard.produk.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('admin');
        $validatedData = $request->validate([
            'nama' => 'required|max:255|unique:produk,nama',
            'harga' => 'required|numeric',
            'berat' => 'required|numeric',
            'deskripsi' => 'required',
            'foto' => 'required|image|file|max:2024',
            'kategori_id' => 'required'
        ]);

        // resize image
        $image = $request->file('foto');
        $imageName = str_replace(' ', '-', $image->getClientOriginalName());
        $fileName =   time() . rand() . '-resize-' . $imageName;
        $validatedData['foto'] =  $request->file('foto')->store('produk-image', 'public');

        // upload resize image
        \Image::make(storage_path('app/public/' . $validatedData['foto']))->resize(400, 400)->save();


        // upload hd image and send to variabel
        $validatedData['foto_hd'] = $request->file('foto')->store('produk-image-hd', 'public');

        Produk::create($validatedData);

        return redirect()->route('dashboard.produk.index')->with('success', 'Data berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Produk $produk)
    {
        Gate::authorize('admin');
        return view('heydrown.dashboard.produk.show', compact('produk'));
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
        $kategori = Kategori::all();
        return view('heydrown.dashboard.produk.edit', ['produk' => $produk, 'kategori' => $kategori]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produk $produk)
    {
        Gate::authorize('admin');
        $validatedData = $request->validate([
            'nama' => 'required|max:255|unique:produk,nama,' . $produk->id . ',id',
            'harga' => 'required|numeric',
            'berat' => 'required|numeric',
            'deskripsi' => 'required',
            'foto' => 'image|file|max:2024',
            'kategori_id' => 'required'
        ]);

        if ($request->file('foto')) {


            // resize image
            $image = $request->file('foto');
            $imageName = str_replace(' ', '-', $image->getClientOriginalName());
            $fileName =   time() . rand() . '-resize-' . $imageName;
            $validatedData['foto'] =  $request->file('foto')->store('produk-image', 'public');

            // upload resize image
            \Image::make(storage_path('app/public/' . $validatedData['foto']))->resize(400, 400)->save();

            // $v = Storage::disk('public')->put("produk-image/" . $fileName, (string) $imageResize->encode());
            // dd($v);

            // upload hd image and send to variabel
            $validatedData['foto_hd'] = $request->file('foto')->store('produk-image-hd', 'public');

            Storage::delete('public/' . $produk->foto);
            Storage::delete('public/' . $produk->foto_hd);
        }


        $produk->update($validatedData);

        if ($produk->wasChanged()) {

            return redirect()->route('dashboard.produk.index')->with('success', 'Data berhasil ditambah');
        }

        return redirect()->route('dashboard.produk.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produk $produk)
    {
        Gate::authorize('admin');

        $produk->delete();
        Storage::delete(['public/' . $produk->foto, 'public/' . $produk->foto_hd]);
        return redirect()->route('dashboard.produk.index')->with('success', 'Data berhasil dihapus');
    }
}
