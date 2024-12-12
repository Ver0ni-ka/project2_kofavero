<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Building extends Model
{
    public function architect(): BelongsTo
    {
    return $this->belongsTo(Architects::class);
    }
}
