<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Gallery extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'status'
    ];

    // optional: media collection define
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('gallery')
            ->singleFile(); // remove if multiple images chahiye
    }
}