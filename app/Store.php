<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = ['name', 'user_id', 'commission_percentage', 'credit_limit'];
    
    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    
    public function orders()
    {
        return $this->hasMany('App\Order');
    }
    
    public function transactions()
    {
        return $this->hasMany('App\LedgerEntry', 'store_id');
    }
 
    
    // Local Scopes
    public function scopeSortByName($query, $order = 'asc')
    {
        return $query->orderBy('name', $order);
    }

    public function getHasRequestedPaymentAttribute()
    {
        return $this->payment_requested_at;
    }
}
