<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Shipment extends Model
{
    protected $fillable = [
        'tracking_number','shipped_at','origin','destination',
        'status','goods_detail'
    ];
    public function booking(): HasOne
    {
        return $this->hasOne(Booking::class);
    }
}
