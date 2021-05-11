<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Institution extends Model
{
    use LogsActivity,SoftDeletes;
    protected $guarded=[];

    public function level()
    {
        return $this->belongsTo(Level::class);
    }
    public function education()
    {
        return $this->belongsTo(Level::class);
    }
    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }
}
