<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Booking extends Model
{
    use HasFactory;
    protected $fillable = ['fleet_id','shipment_id','booking_date'];

    public function fleet(): BelongsTo
    {
        return $this->belongsTo(Fleet::class);
    }
    public function shipment(): BelongsTo
    {
        return $this->belongsTo(Shipment::class);
    }
}
