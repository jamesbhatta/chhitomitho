<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Illuminate\Database\Eloquent\Builder;

class Order extends Model
{
    protected $guarded = ['transaction_time'];
    
    /**
    * The "booted" method of the model.
    *
    * @return void
    */
    protected static function booted()
    {
        // if (Auth::user()->role === 'manager') {
        //     static::addGlobalScope('mine', function (Builder $builder) {
        //         $builder->where('user_id', Auth::user()->id);
        //     });
        // }
    }
    
    public function orderProducts()
    {
        return $this->hasMany('\App\OrderProduct');
    }

    public function user()
    {
        return $this->belongsTo('\App\User');
    }
    
    public function scopeMine($query)
    {
        return $query->where('user_id', Auth::user()->id);
    }
}
