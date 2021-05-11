<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Subscription extends Model
{
    use LogsActivity;
    protected $guarded=[];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    public function category()
    {
        return $this->belongsTo(SubscriptionCategory::class);
    }
    public function period()
    {
        return $this->belongsTo(SubscriptionPeriod::class);
    }
    public function phase()
    {
        return $this->belongsTo(Phase::class);
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function education()
    {
        return $this->belongsTo(Education::class);
    }
    public function chain()
    {
        return $this->belongsTo(Chain::class);
    }

    public function payment()
    {
       return $this->belongsTo(Payment::class);
    }
    public function line()
    {
        return $this->belongsToMany(Line::class);
    }
    public function getPriceAttribute($price)
    {
        $newprice = number_format($price, 3, '.', ' ');;
        return $newprice;
    }
    public function getCreatedAtAttribute($date)
    {
        if(app()->getLocale()=="fr"){
            return Carbon::parse($date)->format('d/m/Y');
        }
        else{
            return Carbon::parse($date)->format('Y/m/d');
        }
    }
}
