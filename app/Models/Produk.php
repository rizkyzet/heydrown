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


    public function diskon()
    {
        return $this->hasOne(Diskon::class, 'produk_id');
    }

    public function scopeFilter($query, array $filters)
    {

        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%');
            });
        });

        $query->when($filters['kategori'] ?? false, function ($query, $kategori) {
            return $query->whereHas('kategori', function ($query) use ($kategori) {
                $query->where('slug', $kategori);
            });
        });
    }
}
