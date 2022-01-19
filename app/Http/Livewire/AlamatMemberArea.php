<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\{Provinsi, Kota};

class AlamatMemberArea extends Component
{

    public $provinsi;
    public $kota;

    public $provinsi_id;
    public $kota_id;

    public function mount()
    {
        $this->provinsi = Provinsi::all();
        $this->kota = [];
    }

    public function updatedProvinsiId($key, $value)
    {
        dump($key, $value);
        $this->kota = Kota::where('id', $value)->get();
    }

    public function render()
    {
        return view('livewire.alamat-member-area');
    }
}
