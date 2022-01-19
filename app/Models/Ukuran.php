<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Ukuran extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = [
        'id'
    ];

    protected $table = 'ukuran';


    public function produk()
    {
        return $this->belongsToMany(Produk::class, 'stok', 'ukuran_id', 'produk_id')->withPivot('jumlah')->as('stok');
    }

    public function detailPesanan()
    {
        return $this->hasMany(DetailPesanan::class, 'ukuran_id');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'tipe',
                'onUpdate' => true
            ]
        ];
    }
}
