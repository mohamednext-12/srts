<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Carbon\Carbon;
class Client extends Model
{
    use LogsActivity;
    protected $guarded=[];
    protected $dates=['birth','created_at'];
//    protected $appends=['addresses'];
    public function address()
    {
        return $this->hasMany(Address::class);
    }
    public function education()
    {
        return $this->hasMany(Education::class);
    }
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
    public function social()
    {
        return $this->belongsTo(Social::class);
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['birth'])->age;
    }
    public function getBirthAttribute($date)
    {
        if($date)
        {
            return  Carbon::parse($date)->format('Y-m-d');
        }
        return false;
    }

    public function getCreatedAtAttribute($date)
    {
        if (app()->getLocale()=='ar'){
            return Carbon::parse($date)->format('Y/m/d');
        }else{
            return Carbon::parse($date)->format('d/m/Y');
        }

    }

}
