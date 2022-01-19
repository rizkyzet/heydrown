<?php

namespace App\Http\Livewire\Pelanggan;

use Livewire\Component;
use App\Models\Alamat;
use Illuminate\Support\Facades\Auth;

class IndexAlamat extends Component
{

    public $alamat;

    protected $listeners = ['refreshIndex' => '$refresh'];

    public function tes($message)
    {
        dump($message);
    }

    public function mount()
    {
    }

    public function delete($id)
    {

        $alamat = Alamat::find($id);

        if ($alamat->type == 'primary') {

            $this->dispatchBrowserEvent('alert', ['message' => 'Alamat utama tidak bisa dihapus', 'type' => 'error']);
        } else {
            $alamat->delete();
            $this->dispatchBrowserEvent('alert', ['message' => 'Alamat berhasil dihapus', 'type' => 'success']);
        }
    }

    public function render()
    {
        $this->alamat = Alamat::where('user_id', Auth::id())->get();
        return view('livewire.pelanggan.index-alamat', ['alamat' => $this->alamat]);
    }
}
