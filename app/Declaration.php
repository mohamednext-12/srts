<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Declaration extends Model
{
    use LogsActivity;
    protected $guarded=[];

    public function reason()
    {
        return $this->belongsTo(Reason::class);
    }
    public function chain()
    {
        return $this->hasMany(Chain::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
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
