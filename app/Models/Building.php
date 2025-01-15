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

    public function style(): BelongsTo
    {
    return $this->belongsTo(Style::class);
    }

    public function jsonSerialize(): mixed 
    { 
        return [ 
            'id' => intval($this->id), 
            'name' => $this->name, 
            'description' => $this->description, 
            'architect' => $this->architect->name, 
            'style' => ($this->style ? $this->style->name : ''), 
            'year' => intval($this->year), 
            'image' => asset('images/' . $this->image), 
        ]; 
    } 
}
