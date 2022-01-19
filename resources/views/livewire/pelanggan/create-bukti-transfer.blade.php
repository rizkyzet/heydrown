<div>
    <form wire:submit.prevent="save">
        <div class="modal-body">
            <div class="form-group heydrown-form-group">
                <label for="photo d-block">Upload Bukti</label>
                <input class="d-block" type="file" wire:model="photo">
                <small wire:loading wire:target="photo">Uploading...</small>
                @error('photo')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                @enderror
            </div>

            <div class="form-group heydrown-form-group">
                <label for="catatan">Catatan (Optional)</label>
                <textarea wire:model="catatan" class="form-control" cols="30" rows="5" placeholder="Contoh : No. Rekening atau Nama Bank"></textarea>
                @error('catatan')
                <small class="text-danger">
                    {{ $message }}
                </small>
            @enderror
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-heydrown-hover">Upload</button>
        </div>
    </form>
</div>
