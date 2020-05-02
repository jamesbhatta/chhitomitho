<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LedgerEntry extends Model
{
    protected $guarded = [];

    public function test()
    {
        dump('I am test method in LedgerEntry');
    }

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

    public function store()
    {
        return $this->belongsTo('App\Store');
    }

    public static function credit($store_id, $amount, $details, $sellingPrice = null)
    {
        $currentBalance = LedgerEntry::where('store_id', $store_id)->latest()->first()->balance ?? 0;
        $newBalance = $currentBalance + $amount;

        $ledger = LedgerEntry::create([
            'store_id'  =>  $store_id,
            'details'   =>  $details,
            'credit'    =>  $amount,
            'balance'   =>  $newBalance,
            'selling_price' => $sellingPrice
        ]);
        return $newBalance;
    }

    public static function debit($store_id, $amount, $details)
    {
        $currentBalance = LedgerEntry::where('store_id', $store_id)->latest()->first()->balance ?? 0;
        $newBalance = $currentBalance - $amount;

        $ledger = LedgerEntry::create([
            'store_id'  =>  $store_id,
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
