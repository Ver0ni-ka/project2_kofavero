<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Style extends Model
{
    public function buildings(): HasMany
    {
    return $this->hasMany(Building::class);
    }
}
