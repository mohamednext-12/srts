<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    protected $guarded=[];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
    public function agencies()
    {
        return $this->hasMany(Agency::class);
    }
}
