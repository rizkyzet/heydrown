<div>
    <form wire:submit.prevent='update'>
        <div class="modal-body">
            <div class="form-group heydrown-form-group">
                <label for="nama">Nama</label>
                <input type="text" id="nama" class="form-control heydrown-input" wire:model='nama'>
                @error('nama')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group heydrown-form-group">
                <label for="provinsi_id">Provinsi</label>
                <select wire:model='provinsi_id' id="provinsi_id" class="form-control heydrown-input">
                    <option value="">Pilih Provinsi</option>
                    @foreach ($provinsi as $p)
                        <option value="{{ $p->id }}">{{ $p->nama }}</option>
                    @endforeach
                </select>
                @error('provinsi_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group heydrown-form-group">
                <label for="kota_id">Kota</label>
                <select wire:model='kota_id' id="kota_id" class="form-control heydrown-input">
                    <option value="">Pilih Kota</option>
                    @foreach ($kota as $k)
                        <option value="{{ $k->id }}">{{ $k->type . ' ' }}{{ $k->nama }}</option>
                    @endforeach
                </select>
                @error('kota_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group heydrown-form-group">
                <label for="kecamatan_id">Kecamatan</label>
                <select wire:model='kecamatan_id' id="kecamatan_id" class="form-control heydrown-input" disabled>
                    <option value="">Pilih Kecamatan</option>
                </select>
                <small class="text-white">*kecamatan untuk sementara tidak diisi</small>
            </div>
            <div class="form-group heydrown-form-group">
                <label for="kode_pos">Kode Pos</label>
                <input type="text" id="kode_pos" class="form-control heydrown-input" wire:model='kode_pos'>
                @error('kode_pos')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group heydrown-form-group">
                <label for="phone">Phone</label>
                <input type="text" id="phone" class="form-control heydrown-input" wire:model='phone'>
                @error('phone')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group heydrown-form-group">
                <label for="detail_alamat">Detail Alamat</label>
                <textarea id="detail_alamat" cols="30" rows="5" wire:model="detail_alamat"
                    class="form-control heydrown-input"></textarea>
                @error('detail_alamat')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-heydrown-hover" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-heydrown-hover">Edit</button>
        </div>
    </form>



</div>
