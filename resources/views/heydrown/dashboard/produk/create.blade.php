@extends('heydrown.dashboard.layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-0 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tambah Data Produk</h1>
    </div>
    <form action="{{ route('dashboard.produk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="nama">Nama Produk</label>
                    <input type="text" class="form-control" name="nama" id="nama" value="{{ old('nama') }}">
                    @error('nama')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="number" class="form-control" name="harga" id="harga" value="{{ old('harga') }}">
                    @error('harga')
                        <small class='text-danger'> {{ $message }} </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="berat">Berat</label>
                    <input type="text" class="form-control" name="berat" id="berat" value="{{ old('berat') }}">
                    @error('berat')
                        <small class='text-danger'> {{ $message }} </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="kategori">Kategori</label>
                    <select name="kategori_id" id="kategori_id" class="form-control">
                        <option value="">Pilih Kategori</option>
                        @foreach ($kategori as $k)
                            <option {{ old('kategori_id') == $k->id ? 'selected' : '' }} value="{{ $k->id }}">
                                {{ $k->nama }}</option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <small class='text-danger'> {{ $message }} </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" cols="30" rows="3"
                        class="form-control">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <small class='text-danger'> {{ $message }} </small>
                    @enderror
                </div>

            </div>
            <div class="col">
                <div class="form-group">
                    <label for="foto">Foto</label>
                    <input type="file" name="foto" id="foto" class="d-block" onchange="previewImage(this)">
                    @error('foto')
                        <small class='text-danger'> {{ $message }} </small>
                    @enderror
                </div>

                <img src="{{ asset('img/noimage.jpg') }}" alt="foto-preview" id="fotoProduk"
                    class="foto-produk img-thumbnail" width="400">
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <button class="btn btn-primary float-right" type="submit">Tambah Produk</button>
        </div>
    </form>
@endsection


@push('scripts')
    <script>
        function previewImage(tes) {
            console.log(tes);
            const image = document.querySelector('#foto');
            const imgPreview = document.querySelector('.foto-produk');


            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);
            oFReader.onload = function(OFREvent) {
                imgPreview.src = OFREvent.target.result
            }
        }
    </script>
@endpush
