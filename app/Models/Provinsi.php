<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;

    protected $table = 'provinsi';
    protected $guarded = ['id'];


    public function alamat()
    {
        return $this->hasOne(Alamat::class, 'provinsi_id');
    }

    public function pengiriman(){
        return $this->hasMany(Pengiriman::class,'provinsi_id');
    }
}
