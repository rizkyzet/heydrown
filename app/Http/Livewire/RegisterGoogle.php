<?php

namespace App\Http\Livewire;

use App\Mail\WelcomeNewUser;
use Livewire\Component;
use App\Models\{Provinsi, Kota, Users, Alamat};
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterGoogle extends Component
{

    public $user;
    public $provinsi;
    public $kota;

    public $users;
    public $alamat;

    protected $rules = [
        'users.nama' => 'required|string',
        'users.phone' => 'required|digits_between:12,13|numeric',
        'users.password' => 'required|min:6|confirmed',
        'users.password_confirmation' => 'required',
        // alamat
        'alamat.provinsi_id' => 'required',
        'alamat.kota_id' => 'required',
        'alamat.kode_pos' => 'required',
        'alamat.detail_alamat' => 'required'
    ];

    public function mount($user)
    {
        $this->user = $user;
        $this->provinsi = Provinsi::all();
        $this->kota = [];
        $this->users = ['email' => $user['email'], 'nama' => $user['name']];
    }



    public function updatedAlamat($value, $key)
    {
        if ($key == 'provinsi_id') {
            $this->kota = Kota::where('provinsi_id', $value)->get();
        }
    }


    public function register()
    {

        $this->validate();


        $users = [
            'name' => $this->users['nama'],
            'email' => $this->users['email'],
            'email_verified_at' => now(),
            'password' => Hash::make($this->users['password']),
            'role_id' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ];

        DB::transaction(function () use ($users) {
            $id = DB::table('users')->insertGetId($users);

            $alamat = [
                'user_id' => $id,
                'nama' => $this->users['nama'],
                'provinsi_id' => $this->alamat['provinsi_id'],
                'kota_id' => $this->alamat['kota_id'],
                'kecamatan_id' => null,
                'kode_pos' => $this->alamat['kode_pos'],
                'phone' => $this->users['phone'],
                'detail_alamat' => $this->alamat['detail_alamat'],
                'type' => 'primary'
            ];

            Alamat::create($alamat);
        });

        Mail::to($this->users['email'])->send(new WelcomeNewUser($this->users['nama']));

        request()->session()->forget('token');
        $this->dispatchBrowserEvent('register-alert', ['message' => 'Account has been created. please login to system']);
    }


    public function render()
    {


        return view('livewire.register-google');
    }
}
