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
        return 'NRs. ' . number_format($this->balance);
    }

    public function store()
    {
        return $this->belongsTo('App\Store');
    }

    public static function credit($store_id, $amount, $details)
    {
        $currentBalance = LedgerEntry::where('store_id', $store_id)->latest()->first()->balance ?? 0;
        $newBalance = $currentBalance + $amount;

        $ledger = LedgerEntry::create([
            'store_id'  =>  $store_id,
            'details'   =>  $details,
            'credit'    =>  $amount,
            'balance'   =>  $newBalance
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
        return 200;
        $this->latest()->first()->balance() ?? 0;
    }
}
