<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function scopeHidden($query)
    {
        return $query->where('hidden', true);
    }

    public function scopeVisible($query)
    {
        return $query->where('hidden', false);
    }
}
