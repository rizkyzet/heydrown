<div>
    <h3 class="heading pb-2">Address</h3>
    <button class="btn btn-heydrown-black-hover btn-md mt-2" data-toggle="modal" data-target="#modalCreateAddress">Buat
        alamat baru</button>
    <div class="row">
        <div class="col"></div>
    </div>





    <!-- Modal Create Adress-->
    <div wire:ignore.self class="modal fade modal-heydrown" id="modalCreateAddress" tabindex="-1"
        aria-labelledby="modalCreateAdress" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCreateAdress">Create New Address</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group heydrown-form-group">
                        <label for="nama">Nama</label>
                        <input type="text" id="nama" class="form-control heydrown-input" wire:model='nama'>
                    </div>
                    <div class="form-group heydrown-form-group">
                        <label for="provinsi_id">Provinsi</label>
                        <select wire:model='provinsi_id' id="provinsi_id" class="form-control heydrown-input">
                            <option value="">Pilih Provinsi</option>
                            @foreach ($provinsi as $p)
                                <option value="{{ $p->id }}">{{ $p->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group heydrown-form-group">
                        <label for="kota_id">Kota</label>
                        <select wire:model='kota_id' id="kota_id" class="form-control heydrown-input">
                            <option value="">Pilih Kota</option>
                            @foreach ($kota as $k)
                                <option value="{{ $k->id }}">{{ $k->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-heydrown-hover" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-heydrown-hover">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>
