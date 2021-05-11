<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $guarded=[];

    public function institutions()
    {
        return $this->hasMany(Institution::class);
    }
    //a level has many classes = secondaire->{1,2,3,4}
    public function classroom()
    {
        return $this->hasMany(Classroom::class);
    }
}
