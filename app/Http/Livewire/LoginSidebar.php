<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Exception;

class LoginSidebar extends Component
{

    public $email;
    public $password;

    protected $rules = [
        'email' => 'required|email:dns',
        'password' => 'required',
    ];

    public function updated($propertyName)
    {

        $this->validateOnly($propertyName);
    }

    public function login()
    {

        $credentials = $this->validate();
        $cek = User::where('email', $this->email)->first();

        if ($cek) {
            if (Auth::attempt($credentials)) {

                request()->session()->regenerate();
                if ($cek->isRole('admin')) {
                    return redirect()->with('slideAuth', true)->intended('/');
                } elseif ($cek->isRole('pelanggan')) {
                    return redirect()->with('slideAuth', true)->intended('/');
                }
            } else {
                $this->dispatchBrowserEvent('login-alert', ['message' => 'Error with the credentials, check your email and password again!', 'type' => 'error']);
            }
        } else {
            $this->dispatchBrowserEvent('login-alert', ['message' => 'Kamu belum terdaftar!', 'type' => 'error']);
        }
    }

    public function render()
    {
        return view('livewire.login-sidebar');
    }
}
