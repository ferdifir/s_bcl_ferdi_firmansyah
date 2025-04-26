<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Checkin extends Model
{
    use HasFactory;
    protected $fillable = ['fleet_id','latitude','longitude'];

    public function fleet(): BelongsTo
    {
        return $this->belongsTo(Fleet::class);
    }
}
