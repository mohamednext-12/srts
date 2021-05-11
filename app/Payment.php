<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded=[];

    public function method()
    {
        return $this->belongsTo(Method::class);
    }
}
