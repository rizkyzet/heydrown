<div>
    <div class="row row-cols-1 row-cols-md-2 row-lg-cols-2 mt-3">
        @foreach ($alamat as $a)
            <div class="col mb-4">
                <div class="card h-100 heydrown-alamat">
                    <div class="card-body">
                        <div class="d-flex justify-content-between header">
                            <h5 class="card-title pr-3">{{ $a->nama }}</h5>
                            @if ($a->type == 'primary')
                                <small class="font-weight-bold font-italic">{{ 'Alamat Utama' }}</small>
                            @endif
                        </div>

                        <p class="card-text">
                            {{ $a->detail_alamat }}<br>
                            {{ $a->kota->type . ' ' . $a->kota->nama }} &mdash;
                            {{ 'Provinsi ' . $a->provinsi->nama }}<br>
                            {{ 'Telepon : ' . $a->phone }}
                        </p>
                    </div>
                    <div class="card-footer p-2 border">
                        <button class="btn btn-heydrown-hover btn-sm float-right"
                            onclick="return confirm('yakin ingin hapus?') ? @this.delete('{{ $a->id }}') : false">Hapus</button>
                        <button class="btn btn-heydrown-hover btn-sm float-right mr-2" data-toggle="modal"
                            data-target="#modalEditAddress"
                            wire:click="$emit('fetchAlamat',{{ $a->id }})">Edit</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
