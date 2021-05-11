<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    protected $guarded=[];
    protected $dates = ['date_circulation'];

    public function line(){
      return $this->belongsTo(Line::class);
    }
    public function setDateCirculationAttribute($value)
    {
        $this->attributes['date_circulation'] = Carbon::parse($value)->format('y-m-d');
    }
    public function getDateCirculationAttribute($value)
    {
        return $this->attributes['date_circulation'] = Carbon::parse($value)->format('d/m/yy');
    }

}
