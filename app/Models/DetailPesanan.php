<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    use HasFactory;

    protected $table ='detail_pesanan';
    protected $guarded =['id'];

    public function pesanan(){
        return $this->belongsTo(Pesanan::class,'pesanan_id');
    }

    public function produk(){
        return $this->belongsTo(Produk::class,'produk_id');
    }

    public function ukuran(){
        return $this->belongsTo(Ukuran::class,'ukuran_id');
    }

}
