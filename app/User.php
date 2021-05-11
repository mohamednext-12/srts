<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable,HasRoles,LogsActivity;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','last_login_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($pass){

        $this->attributes['password'] = Hash::make($pass);

    }
    public function getLastLoginAtAttribute($login){

//        $this->attributes['last_login_at'] =(new Carbon($value))->format('d/m/y');
        return Carbon::parse($login)->diffForHumans();

    }


    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }
    public function demands()
    {
        return $this->hasMany(Demand::class);
    }
    public function subscriptions()
    {
        return $this->belongsTo(Subscription::class);
    }
}
