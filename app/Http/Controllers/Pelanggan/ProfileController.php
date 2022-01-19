<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function index()
    {
        return view('heydrown.pelanggan.profile-pelanggan');
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'confirmed'
        ]);

        $data = ['name' => $request->name];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('pelanggan.profile.index')->with('success', 'Profile berhasil diubah!');
    }
}
