<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EstimateItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'estimate_id',
        'title',
        'description',
        'quantity',
        'rate',
        'amount',
    ];

    // 🔹 Item belongs to estimate
    public function estimate()
    {
        return $this->belongsTo(Estimate::class);
    }
}
