<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventMatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id'
        , 'participant_id'
        , 'matched_participant_id'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }

    public function matchedParticipant()
    {
        return $this->belongsTo(Participant::class, 'matched_participant_id');
    }
}
