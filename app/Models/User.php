<?php

namespace App\Models;

use App\Notifications\VerifyUserNotification;
use Carbon\Carbon;
use DateTimeInterface;
use Hash;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use SoftDeletes, Notifiable, HasFactory;

    public $table = 'users';

    protected $hidden = [
        'remember_token',
        'password',
    ];

    protected $fillable = [

        'name',
        'email',
        'password',

        'company_name',

        'status',
        'joining_date',
        'expiry_date',

        'plan_id',
        'subscription_status',
        'trial_ends_at',
        'subscription_ends_at',

        'last_login_at',

        'email_verified_at',
    ];

    protected $casts = [

        'email_verified_at' => 'datetime',

        'joining_date' => 'date',
        'expiry_date' => 'date',

        'trial_ends_at' => 'datetime',
        'subscription_ends_at' => 'datetime',

        'last_login_at' => 'datetime',

        'status' => 'boolean'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }


    /*
    |--------------------------------------------------------------------------
    | Roles
    |--------------------------------------------------------------------------
    */

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function getIsAdminAttribute()
    {
        return $this->roles()->where('id', 1)->exists();
    }


    /*
    |--------------------------------------------------------------------------
    | Password
    |--------------------------------------------------------------------------
    */

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] =
                app('hash')->needsRehash($input)
                ? Hash::make($input)
                : $input;
        }
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    // User created clients
    public function clients()
    {
        return $this->hasMany(Client::class, 'created_by');
    }

    // User created estimates
    public function estimates()
    {
        return $this->hasMany(Estimate::class, 'created_by');
    }

    // Mail settings
    public function mailSetting()
    {
        return $this->hasOne(UserMailSetting::class);
    }


    /*
    |--------------------------------------------------------------------------
    | Subscription Helpers
    |--------------------------------------------------------------------------
    */

    public function getIsTrialAttribute()
    {
        return $this->subscription_status === 'trial';
    }

    public function getIsActiveAttribute()
    {
        return $this->subscription_status === 'active';
    }

    public function getIsExpiredAttribute()
    {
        return $this->subscription_ends_at &&
               $this->subscription_ends_at->isPast();
    }

}