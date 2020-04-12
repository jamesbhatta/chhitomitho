<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    public function scopeActive($query, $state = true)
    {
        return $query->where('active', $state);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    public function scopeOrderByFeatured($query)
    {
        return $query->orderBy('featured', 'DESC');
    }

    public function products()
    {
        return $this->hasMany('App\Product');
    }
}
