<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table='addresses';
    protected $guarded=[];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }
}
