<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name'
        , 'last_name'
        , 'email'
        , 'phone'
    ];

    protected $appends = [
        'name'
        , 'formatted_phone'
    ];

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class);
    }

    public function exclusions(): HasMany
    {
        return $this->hasMany(Exclusion::class);
    }

    public function activeEvent()
    {
        return $this->events()
            ->where('is_active', true)
            ->first();
    }

    public function getNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getFormattedPhoneAttribute(): string
    {
        return '(' . substr($this->phone, 0, 3) . ') ' . substr($this->phone, 3, 3) . '-' . substr($this->phone, 6);
    }

    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = preg_replace('/\D/', '', $value);
    }

}
