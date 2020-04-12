<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    public static function boot()
    {
        parent::boot();
        Category::deleting(function ($category) {
            if ( $category->isUncategorized() ) return false;
        });
    }

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

    public function isUncategorized()
    {
        if ($this->slug == 'uncategorized') return true;
        return false;
    }
}
