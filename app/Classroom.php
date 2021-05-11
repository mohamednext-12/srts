<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    //
    protected $guarded=[];

    public function level()
    {
        return $this->belongsTo(Level::class);
    }
}
