<?php

namespace App\Http\Livewire\Pelanggan;

use Livewire\Component;
use App\Models\{Provinsi, Kota, Alamat};
use Illuminate\Support\Facades\Auth;

class CreateAlamat extends Component
{
    public $provinsi;
    public $kota;

    public $nama;
    public $provinsi_id;
    public $kota_id;
    public $kecamatan_id;
    public $kode_pos;
    public $phone;
    public $detail_alamat;


    protected $rules = [
        'nama' => 'required|string',
        'phone' => 'required|digits_between:12,13|numeric',
        'provinsi_id' => 'required',
        'kota_id' => 'required',
        'kode_pos' => 'required',
        'detail_alamat' => 'required'
    ];

    public function mount()
    {
        $this->provinsi = Provinsi::all();
        $this->kota = [];
    }

    public function updatedProvinsiId($value)
    {

        $this->kota = Kota::where('provinsi_id', $value)->get();
    }


    public function store()
    {
        $validatedData = $this->validate();
        $validatedData['user_id'] = Auth::id();
        $validatedData['type'] = 'secondary';

        Alamat::create($validatedData);

        $this->reset(['nama', 'provinsi_id', 'kota_id', 'kecamatan_id', 'kode_pos', 'phone', 'detail_alamat']);

        $this->dispatchBrowserEvent('alert', ['message' => 'Alamat berhasil disimpan', 'type' => 'success']);
        $this->emit('refreshIndex');
    }

    public function render()
    {
        return view('livewire.pelanggan.create-alamat');
    }
}
