<?php

namespace App\Http\Livewire\Pelanggan;

use Livewire\Component;
use App\Models\Alamat;
use App\Models\{Provinsi, Kota};

class EditAlamat extends Component
{

    public $alamat;

    public $provinsi = [];
    public $kota = [];

    public $nama;
    public $provinsi_id;
    public $kota_id;
    public $kecamatan_id;
    public $kode_pos;
    public $phone;
    public $detail_alamat;

    protected $listeners = ['fetchAlamat'];

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
    }

    public function updatedProvinsiId($value)
    {
        $this->kota = Kota::where('provinsi_id', $value)->get();
    }

    public function fetchAlamat($id)
    {
        $this->resetValidation();

        $this->alamat = Alamat::find($id);

        $this->nama = $this->alamat->nama;
        $this->provinsi_id = $this->alamat->provinsi_id;
        $this->kota = Kota::where('provinsi_id', $this->provinsi_id)->get();
        $this->kota_id = $this->alamat->kota_id;
        $this->kode_pos = $this->alamat->kode_pos;
        $this->phone = $this->alamat->phone;
        $this->detail_alamat = $this->alamat->detail_alamat;
    }

    public function update()
    {
        $validatedData = $this->validate();

        $this->alamat->update($validatedData);

        $this->dispatchBrowserEvent('alert', ['message' => 'Alamat berhasil diubah', 'type' => 'success']);
        $this->emit('refreshIndex');
    }

    public function render()
    {
        return view('livewire.pelanggan.edit-alamat');
    }
}
