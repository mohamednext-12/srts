<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Agency extends Model
{
    use LogsActivity,SoftDeletes;
    protected $guarded=[];

    public function users()
    {
       return $this->hasMany(User::class);
    }
    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }
    public function subscriptions()
    {
        return $this->belongsTo(Subscription::class);
    }
}
