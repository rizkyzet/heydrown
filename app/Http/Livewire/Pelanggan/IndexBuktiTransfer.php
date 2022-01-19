<?php

namespace App\Http\Livewire\Pelanggan;

use App\Models\BuktiTransfer;
use App\Models\Pesanan;
use Livewire\Component;

class IndexBuktiTransfer extends Component
{

    public $bukti;
    public Pesanan $pesanan;

    protected $listeners = [
        'refreshIndexBuktiTransfer' => '$refresh'
    ];

    public function mount(Pesanan $pesanan)
    {
        $this->pesanan = $pesanan;
        $this->bukti = BuktiTransfer::where('pesanan_id', $pesanan->id)->latest()->get();
    }


    public function render()
    {
        $this->bukti = BuktiTransfer::where('pesanan_id', $this->pesanan->id)->latest()->get();
        return view('livewire.pelanggan.index-bukti-transfer');
    }
}
