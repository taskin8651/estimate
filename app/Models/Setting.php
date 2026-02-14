<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'company_name',
        'company_email',
        'company_phone',
        'company_address',
        'company_logo',
        'created_by', // 👈 add karo
    ];

    // 🔹 Setting belongs to User
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
