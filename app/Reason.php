<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reason extends Model
{
    protected $guarded=[];

    public function declarations()
    {
        return $this->belongsTo(Declaration::class);
    }
}
