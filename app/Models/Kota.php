<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    use HasFactory;

    protected $table = 'kota';
    protected $guarded = ['id'];

    public function alamat()
    {
        return $this->hasOne(Alamat::class, 'kota_id');
    }

    public function kota(){
        return $this->hasMany(Pengiriman::class,'kota_id');
    }
}
