<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';
    protected $guarded = ['id'];
    public $timeStamps = true;
    // protected $dates = ['created_at', 'updated_at', 'expired_at'];
    protected $casts = [
        'expired_at' => 'datetime:Y-m-d',
    ];

    public const PENDING = 'pending';
    public const CONFIRMED = 'confirmed';
    public const DELIVERED = 'delivered';
    public const COMPLETED = 'completed';
    public const CANCELLED = 'cancelled';

    public const STATUS = [
        self::PENDING => 'Pending',
        self::CONFIRMED => 'Confirmed',
        self::DELIVERED => 'Delivered',
        self::COMPLETED => 'Completed',
        self::CANCELLED => 'Cancelled',
    ];

    public static function generatePesananId()
    {
        $pesananTerakhir = self::latest()->first();

        if ($pesananTerakhir) {
            $number = $pesananTerakhir->id + 1;
            return 'PSN-0' . $number;
        } else {
            $number = 1;
            return 'PSN-0' . $number;
        }
    }


    public function detailPesanan()
    {

        return $this->hasMany(DetailPesanan::class,'pesanan_id');
    }

    public function pengiriman()
    {
        return $this->hasOne(Pengiriman::class,'pesanan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function logPesanan()
    {
        return $this->hasMany(LogPesanan::class,'pesanan_id');
    }

    public function buktiTransfer()
    {
        return $this->hasMany(BuktiTransfer::class,'pesanan_id');
    }
}
