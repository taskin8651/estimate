<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Estimate extends Model
{
    use HasFactory;

    protected $fillable = [
        'estimate_number',
        'client_id',
        'issue_date',
        'expiry_date',
        'subtotal',
        'tax_percentage',
        'tax_amount',
        'total',
        'status',
        'notes',
        'created_by',
        'template',
    ];

    protected $dates = [
        'issue_date',
        'expiry_date',
    ];

    // 🔹 Estimate belongs to client
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // 🔹 Estimate has many items
    public function items()
    {
        return $this->hasMany(EstimateItem::class);
    }

    // 🔹 Who created estimate
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
