<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogPesanan extends Model
{
    use HasFactory;

    protected $table = 'log_pesanan';
    protected $guarded =['id'];

   public function pesanan(){
       return $this->belongsTo(Pesanan::class,'pesanan_id');
   }

}
