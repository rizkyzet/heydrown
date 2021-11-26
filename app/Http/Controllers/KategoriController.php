<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Gate;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('admin');
        $kategori = Kategori::all();

        return view('heydrown.dashboard.kategori.index', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('admin');
        return view('heydrown.dashboard.kategori.create');
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
        $validData = $request->validate([
            'nama' => 'required|unique:kategori,nama'
        ]);

        Kategori::create($validData);

        return redirect()->route('dashboard.kategori.index')->with('success', 'Kategori berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show(Kategori $kategori)
    {
        Gate::authorize('admin');
        return redirect()->route('dashboard.kategori.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function edit(Kategori $kategori)
    {
        Gate::authorize('admin');
        return view('heydrown.dashboard.kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kategori $kategori)
    {
        Gate::authorize('admin');
        $validData = $request->validate([
            'nama' => 'required|unique:kategori,nama,' . $kategori->id . ',id'
        ]);

        $kategori->update($validData);

        if ($kategori->wasChanged()) {
            return redirect()->route('dashboard.kategori.index')->with('success', 'Kategori berhasil diubah');
        } else {
            return redirect()->route('dashboard.kategori.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kategori $kategori)
    {
        Gate::authorize('admin');
        $kategori->delete();
        return redirect()->route('dashboard.kategori.index')->with('success', 'Kategori berhasil dihapus');
    }
}
