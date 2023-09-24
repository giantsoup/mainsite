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

    public function links(): HasMany
    {
        return $this->hasMany(Link::class);
    }

    public function eventMatches()
    {
        return $this->hasMany(EventMatch::class, 'participant_id');
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
        // Remove '+1' or '001' prefix
        if (str_starts_with($value, '+1')) {
            $value = substr($value, 2);
        } elseif (str_starts_with($value, '001')) {
            $value = substr($value, 3);
        }

        $this->attributes['phone'] = preg_replace('/\D/', '', $value);
    }

}
