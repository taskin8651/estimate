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
        'tax_amount',
        'total',

        'status',
        'notes',
        'template',
        'created_by'
    ];


    protected $casts = [
        'issue_date' => 'date',
        'expiry_date' => 'date',
        'subtotal' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'total' => 'decimal:2'
    ];


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */


    // Estimate belongs to client
    public function client()
    {
        return $this->belongsTo(Client::class);
    }


    // Estimate items
    public function items()
    {
        return $this->hasMany(EstimateItem::class);
    }


    // Estimate taxes (pivot table)
    public function taxes()
    {
        return $this->belongsToMany(
            Tax::class,
            'estimate_taxes'
        )->withPivot('amount')->withTimestamps();
    }


    // Creator
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }


    /*
    |--------------------------------------------------------------------------
    | Helper Functions
    |--------------------------------------------------------------------------
    */


    // total items amount
    public function getItemsTotalAttribute()
    {
        return $this->items->sum('amount');
    }


    // formatted total
    public function getFormattedTotalAttribute()
    {
        return number_format($this->total, 2);
    }


    // status label
    public function getStatusLabelAttribute()
    {
        return ucfirst($this->status);
    }
}