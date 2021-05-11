<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Station extends Model
{
    use SoftDeletes;
    protected $guarded=[];


    public function lines()
    {
        return $this->belongsToMany(Line::class)->withPivot('order');
    }
    public function lineExist($id)
    {
        foreach ($this->lines as $attribute) {
            if($attribute->id==$id)
            {
                return true;
            }

        }
        return false;
    }

}
