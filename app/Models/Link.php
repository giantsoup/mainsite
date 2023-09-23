<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Link extends Model
{
    use HasFactory;

    protected $fillable = [
        'participant_id'
        , 'name'
        , 'url'
    ];

    public function participant(): HasOne
    {
        return $this->hasOne(Participant::class);
    }
}
