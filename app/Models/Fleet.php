<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fleet extends Model
{
    use HasFactory;
    protected $fillable = ['number', 'type', 'is_available', 'capacity'];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
    public function checkins(): HasMany
    {
        return $this->hasMany(Checkin::class);
    }

    public function latestCheckin(): HasOne
    {
        return $this->hasOne(Checkin::class)->latestOfMany();
    }
}
