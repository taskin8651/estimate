<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricingPlan extends Model
{
    protected $fillable = ['name','price','duration','features','type','order'];

    protected $casts = [
        'features' => 'array',
    ];
}