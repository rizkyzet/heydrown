<div>

    <p class="font-weight-bold">Stok : {{ $stok }} </p>

    <form wire:submit.prevent="addToCart">
        <div class=" form-row">
            <div class="col-3">
                <div class="form-group">
                    <label for="ukuran_id" class="font-weight-bold">Size</label>
                    <select name="ukuran_id" id="ukuran_id" class="form-control" wire:model="ukuran_id"
                        wire:loading.attr="disabled">
                        @foreach ($produk->ukuran as $ukuran)
                            <option value="{{ $ukuran->id }}">{{ $ukuran->tipe }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="quantity" class="font-weight-bold">Quantity</label>
                    <input type="number" min="1" max="{{ $stok }}" class="form-control" wire:model="quantity"
                        id="quantity" name="quantity" wire:loading.attr="disabled" value="1" min="1">
                </div>
            </div>
            <div class="col d-flex align-items-center mt-3 ">
                <button class="btn btn-dark btn-cart" type="submit" wire:loading.attr="disabled">Add to Cart</button>
            </div>
        </div>
    </form>
</div>
