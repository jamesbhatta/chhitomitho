<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    public function products()
    {
        return $this->hasMany('App\Product');
    }
}
