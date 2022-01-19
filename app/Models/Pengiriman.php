<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    use HasFactory;

    protected $table = 'pengiriman';
    protected $guarded = ['id'];
    public $timeStamps = true;

    public function provinsi(){
        return $this->belongsTo(Provinsi::class,'provinsi_id');
    }
    public function kota(){
        return $this->belongsTo(Kota::class,'kota_id');
    }
}
