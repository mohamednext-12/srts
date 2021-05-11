<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Line extends Model
{
    use LogsActivity,SoftDeletes;
    protected $guarded=[];

    public function buses()
    {
        $this->hasMany(Bus::class);
    }
    public function stations()
    {
        return $this->belongsToMany(Station::class)->withPivot('order');
    }

    public function categories() {
        return $this->belongsToMany(SubscriptionCategory::class,'category_lines')->withPivot('price');
    }

    public function subscription()
    {
        return $this->belongsToMany(Subscription::class);
    }



}
