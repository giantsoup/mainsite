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

    protected $appends = [
        'shortened_url'
    ];

    public function participant(): HasOne
    {
        return $this->hasOne(Participant::class);
    }

    public function getShortenedUrlAttribute()
    {
        $maxLength = 30;
        $url = $this->url;

        if (strlen($url) > $maxLength) {
            $shortenedUrl = substr($url, 0, $maxLength - 3) . '...';
        } else {
            $shortenedUrl = $url;
        }

        return $shortenedUrl;
    }

}
