@extends('heydrown.dashboard.layouts.app')

@section('content')


    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Data Kategori</h1>
    </div>

    <div class="row">
        <div class="col-4">

            <form action="{{ route('dashboard.kategori.update', $kategori) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" name="nama" required
                        value="{{ old('nama', $kategori->nama) }}">
                </div>
                @error('nama')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                <button type="submit" class="btn btn-sm btn-primary float-right">Edit Data</button>
            </form>

        </div>
    </div>

@endsection
