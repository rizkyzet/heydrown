<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuktiTransfer extends Model
{
    use HasFactory;

    protected $table='bukti_transfer';
    protected $guarded=['id'];

    public function pesanan(){
        return $this->belongsTo(Pesanan::class,'pesanan_id');
    }
}
