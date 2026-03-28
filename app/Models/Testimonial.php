<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'message',
        'rating',
    ];

    protected $casts = [
        'rating' => 'integer',
    ];

    /**
     * Accessor for image URL
     */
    public function getImageUrlAttribute()
    {
        return $this->image 
            ? asset('storage/' . $this->image) 
            : asset('images/default-user.png');
    }

    /**
     * Scope for active testimonials (future use)
     */
    public function scopeActive($query)
    {
        return $query->whereNotNull('message');
    }
}