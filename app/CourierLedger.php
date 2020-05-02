<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourierLedger extends Model
{
    protected $guarded = [];

    public function getSellingPriceAmountAttribute()
    {
        return is_null($this->selling_price) ? null : 'NRs. ' . number_format($this->selling_price);
    }

    public function getDebitAmountAttribute()
    {
        return is_null($this->debit) ? null : 'NRs. ' . number_format($this->debit);
    }

    public function getCreditAmountAttribute()
    {
        return is_null($this->credit) ? null : 'NRs. ' . number_format($this->credit);
    }

    public function getBalanceAmountAttribute()
    {
        return 'NRs. ' . number_format($this->balance, 2);
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'courier_id');
    }

    public static function credit($courier_id, $amount, $details, $sellingPrice = null)
    {
        $currentBalance = CourierLedger::where('courier_id', $courier_id)->latest()->first()->balance ?? 0;
        $newBalance = $currentBalance + $amount;

        $ledger = CourierLedger::create([
            'courier_id'  =>  $courier_id,
            'details'   =>  $details,
            'credit'    =>  $amount,
            'balance'   =>  $newBalance,
            'selling_price' => $sellingPrice
        ]);
        return $newBalance;
    }

    public static function debit($courier_id, $amount, $details)
    {
        $currentBalance = CourierLedger::where('courier_id', $courier_id)->latest()->first()->balance ?? 0;
        $newBalance = $currentBalance - $amount;

        $ledger = CourierLedger::create([
            'courier_id'  =>  $courier_id,
            'details'   =>  $details,
            'debit'    =>  $amount,
            'balance'   =>  $newBalance
        ]);
        return $newBalance;
    }

    public function getBalance()
    {
        return $this->latest()->first()->balance() ?? 0;
    }
}
