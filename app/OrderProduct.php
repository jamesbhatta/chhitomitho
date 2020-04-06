<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $guarded = [];
    
    public function order()
    {
        return $this->belongsTo('\App\order');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
