<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
        , 'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(Participant::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
