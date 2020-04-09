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
        static::addGlobalScope('viewable', function (Builder $builder) {
            switch (Auth::user()->role) {
                case 'admin':
                    $builder;
                    break;

                case 'manager':
                    break;

                case 'partner':
                    $builder->where('store_id', Auth::user()->store->id);
                    break;

                case 'courier':
                    $builder->where('courier_id', Auth::user()->id);
                    break;

                default:
                    $builder->where('user_id', Auth::user()->id);
                    break;
            }
        });
    }

    public function orderProducts()
    {
        return $this->hasMany('\App\OrderProduct');
    }

    public function user()
    {
        return $this->belongsTo('\App\User');
    }

    public function store()
    {
        return $this->belongsTo('App\Store');
    }

    public function courier()
    {
        return $this->belongsTo('App\User', 'courier_id');
    }

    // Local Scopes
    public function scopeMine($query)
    {
        return $query->where('user_id', Auth::user()->id);
    }

    // Attributes
    public function getHasStoreAttribute()
    {
        return !empty($this->store_id);
    }

    public function getHasCourierAttribute()
    {
        return !empty($this->courier_id);
    }
}
