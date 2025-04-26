<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shipment extends Model
{
    use HasFactory;
    protected $fillable = [
        'tracking_number',
        'shipped_at',
        'origin',
        'destination',
        'status',
        'goods_detail'
    ];

    protected $casts = [
        'shipped_at' => 'date',
    ];
    
    public function booking(): HasOne
    {
        return $this->hasOne(Booking::class);
    }
}
