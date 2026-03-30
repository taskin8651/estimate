<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Tax extends Model
{
    protected $fillable = [
        'name',
        'rate',
        'type',
        'country',
        'is_default',
        'status',
        'created_by'
    ];

    protected $casts = [
        'is_default' => 'boolean',
        'status' => 'boolean',
        'rate' => 'float'
    ];

    // 🔹 Relationship
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // 🔥 Scope: Active Tax
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    // 🔥 Scope: Current User
    public function scopeMine($query)
    {
        return $query->where('created_by', auth()->id());
    }
}