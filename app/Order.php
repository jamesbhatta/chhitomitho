<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Order extends Model
{
    protected $guarded = ['transaction_time'];

    public function orderProducts()
    {
        return $this->hasMany('\App\OrderProduct');
    }

    public function scopeMine($query)
    {
        return $query->where('user_id', Auth::user()->id);
    }
}
