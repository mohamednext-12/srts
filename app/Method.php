<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Method extends Model
{
    protected $guarded=[];

    public function payments()
    {
        return $this->belongsToMany(Payment::class);
    }
}
