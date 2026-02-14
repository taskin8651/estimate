<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'country',
        'zip',
        'created_by',
    ];

    // 🔹 Client has many estimates
    public function estimates()
    {
        return $this->hasMany(Estimate::class);
    }

    // 🔹 Who created this client
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
