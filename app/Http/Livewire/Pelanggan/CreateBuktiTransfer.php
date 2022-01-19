<?php

namespace App\Http\Livewire\Pelanggan;

use App\Models\BuktiTransfer;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Pesanan;

class CreateBuktiTransfer extends Component
{

    use WithFileUploads;

    public $photo;
    public $catatan;
    public Pesanan $pesanan;

    public function mount($pesanan)
    {
        $this->pesanan = $pesanan;
    }

    public function save()
    {
        $this->resetValidation();

        $this->validate([
            'photo' => 'image|max:1024', // 1MB Max
        ]);

        $data = [
            'pesanan_id' => $this->pesanan->id,
            'catatan' => $this->catatan ?? null,
            'status' => 'waiting',
        ];

        $data['image'] = $this->photo->store('foto-bukti', 'public');

        if ($data['image']) {
            BuktiTransfer::create($data);
            $this->emit('refreshIndexBuktiTransfer');
            
            // kirim notifikasi ke admin

        } else {
            dd('ada kesalahan');
        }

        $this->reset(['photo', 'catatan']);
    }

    public function render()
    {
        return view('livewire.pelanggan.create-bukti-transfer');
    }
}
