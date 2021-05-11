<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Demand extends Model
{
    use LogsActivity;
    protected $guarded=[];

    public function agency(){
        return $this->belongsTo(User::class);
    }
}
