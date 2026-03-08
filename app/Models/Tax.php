<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Tax extends Model
{
    protected $fillable = [
        'name',
        'rate',
        'created_by'
    ];

    // relation with user
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    
}