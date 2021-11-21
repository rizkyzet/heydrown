@extends('heydrown.dashboard.layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-0 pb-2 mb-3 border-bottom">
        <h1 class="h2">Ubah Diskon {{ $produk->nama }}</h1>
    </div>


    <div class="row">
        <div class="col-4">
            <img src="{{ asset('storage/' . $produk->foto) }}" alt="foto-preview" id="fotoProduk"
                class="foto-produk img-fluid" width='400'>
        </div>
        <div class="col-3">
            <form action="{{ route('dashboard.diskon.update', $produk) }}" method="POST">
                @csrf
                @method('PATCH')
                <input type="hidden" name="produk_id" value="{{ $produk->id }}" readonly>
                <div class="form-group">
                    <label for="berlaku">Berlaku</label>
                    <input type="date" class="form-control" name="berlaku" id="berlaku"
                        value="{{ old('berlaku', $produk->diskon->berlaku) }}">
                    @error('berlaku')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="potongan" class="d-block">Potongan Persen</label>
                    <input type="number" class="form-control col-4 d-inline" name="potongan" id="potongan"
                        value="{{ old('potongan', $produk->diskon->potongan) }}" min="1">
                    <strong class="d-inline">%</strong>
                    @error('potongan')
                        <small class="text-danger d-block">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="number" class="form-control" name="harga" readonly value="{{ $produk->harga }}"
                        id="harga">
                    @error('harga')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="harga_diskon">Harga Diskon</label>
                    <input type="text" class="form-control" name="harga_diskon" id="harga_diskon" readonly
                        value="{{ old('harga_diskon', $produk->diskon->harga_diskon) }}">
                    @error('harga_diskon')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <button class="btn btn-primary float-right" type="submit">Ubah Diskon</button>
            </form>
        </div>
    </div>

@endsection


@push('scripts')
    <script>
        $('#potongan').on('change', function() {
            let harga = $('#harga').val();
            let potongan = $(this).val();
            let harga_potongan = harga * potongan / 100;

            $('#harga_diskon').val(harga - harga_potongan);

        });
    </script>
@endpush
