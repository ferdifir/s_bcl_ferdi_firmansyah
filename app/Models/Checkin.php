<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Checkin extends Model
{
    protected $fillable = ['fleet_id','latitude','longitude'];

    public function fleet(): BelongsTo
    {
        return $this->belongsTo(Fleet::class);
    }
}
