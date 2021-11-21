@extends('heydrown.dashboard.layouts.app')

@section('content')


    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tambah Data Ukuran</h1>
    </div>

    <div class="row">
        <div class="col-4">

            <form action="{{ route('dashboard.ukuran.update', $ukuran) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="tipe">Tipe</label>
                    <input type="text" class="form-control" name="tipe" required
                        value="{{ old('tipe', $ukuran->tipe) }}">
                </div>
                @error('tipe')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                <button type="submit" class="btn btn-sm btn-primary float-right">Tambah Data</button>
            </form>

        </div>
    </div>

@endsection
