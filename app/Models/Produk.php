<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Produk extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = ['id'];

    protected $table = 'produk';

    public $timestamps = true;

    protected $with = [
        'ukuran'
    ];

    public function ukuran()
    {
        return $this->belongsToMany(Ukuran::class, 'stok', 'produk_id', 'ukuran_id')->withPivot('jumlah')->as('stok');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama',
                'onUpdate' => true
            ]
        ];
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
