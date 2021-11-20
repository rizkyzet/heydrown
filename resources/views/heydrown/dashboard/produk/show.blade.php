@extends('heydrown.dashboard.layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-0 pb-2 mb-3 border-bottom">
        <h1 class="h2">Detail Data Produk</h1>
    </div>

    <div class="d-flex justify-content-end">
        <a class="btn btn-sm btn-primary mx-1 my-2" href="">Kelola Stok</a>
        <a class="btn btn-sm btn-success mx-1 my-2" href="{{ route('dashboard.produk.edit', $produk) }}">Edit Data
            Produk</a>
    </div>

    <div class="row">
        <div class="col-4">
            <img src="{{ asset('storage/' . $produk->foto) }}" alt="foto-preview" id="fotoProduk"
                class="foto-produk img-fluid" width='400'>
        </div>
        <div class="col">
            <table class="table table-sm table-border w-75">
                <tr>
                    <th>Nama Produk :</th>
                    <td>{{ $produk->nama }}</td>
                </tr>
                <tr>
                    <th>Harga :</th>
                    <td>{{ rupiah($produk->harga) }}</td>
                </tr>
                <tr>
                    <th>Berat :</th>
                    <td>{{ $produk->berat }}</td>
                </tr>
                <tr>
                    <th>Kategori :</th>
                    <td>{{ $produk->kategori->nama }}</td>
                </tr>
                <tr>
                    <th>Created at :</th>
                    <td>{{ $produk->created_at }}</td>
                </tr>
                <tr>
                    <th>Deskripsi :</th>
                    <td>
                        {{ $produk->deskripsi }}
                    </td>
                </tr>
            </table>

        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <table class="table table-sm w-100 text-center">
                <tr>
                    <th colspan=4>Stok</th>
                </tr>
                <tr>
                    <th>S</th>
                    <th>M</th>
                    <th>L</th>
                    <th>XL</th>
                </tr>
                <tr>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                </tr>
            </table>
            < </div>
        </div>
    @endsection
