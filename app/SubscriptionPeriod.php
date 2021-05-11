<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class SubscriptionPeriod extends Model
{
    use LogsActivity;
    protected $guarded=[];

    public function subscription()
    {
        return $this->hasMany(Subscription::class);
    }

    public function category()
    {
        return $this->belongsToMany(SubscriptionCategory::class,'category_period','period_id','category_id');
    }
    public function phases()
    {
        return $this->hasMany(Phase::class,'period_id');
    }

    public function lineprices()
    {
        return $this->hasMany(LinePrice::class);
    }

}
