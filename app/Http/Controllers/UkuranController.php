<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ukuran;

class UkuranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ukuran = Ukuran::all();
        return view('heydrown.dashboard.ukuran.index', compact('ukuran'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('heydrown.dashboard.ukuran.create');
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
            'tipe' => 'required|unique:ukuran,tipe'
        ]);

        $validData['tipe'] = strtoupper($validData['tipe']);

        Ukuran::create($validData);

        return redirect()->route('dashboard.ukuran.index')->with('success', 'Data ukuran berhasil ditambah!');
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
    public function edit(Ukuran $ukuran)
    {

        return view('heydrown.dashboard.ukuran.edit', compact('ukuran'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ukuran $ukuran)
    {
        $validData = $request->validate([
            'tipe' => 'required|unique:ukuran,tipe,' . $ukuran->id . ',id'
        ]);

        $validData['tipe'] = strtoupper($validData['tipe']);

        $ukuran->update($validData);

        return redirect()->route('dashboard.ukuran.index')->with('success', 'Data ukuran berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ukuran $ukuran)
    {
        $ukuran->delete();

        return redirect()->route('dashboard.ukuran.index')->with('success', 'Data ukuran berhasil dihapus!');
    }
}
