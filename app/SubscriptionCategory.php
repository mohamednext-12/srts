<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubscriptionCategory extends Model
{
    protected $guarded=[];

    public function subscription()
    {
        return  $this->hasMany(Subscription::class);
    }

    public function periods()
    {
       return $this->belongsToMany(SubscriptionPeriod::class,'category_period','category_id','period_id')->withPivot('period_id');
    }

    public function lines() {
        return $this->belongsToMany(Line::class,'category_lines')->withPivot('price');
    }
}
