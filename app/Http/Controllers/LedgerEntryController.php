<?php

namespace App\Http\Controllers;

use App\LedgerEntry;
use App\Store;
use Illuminate\Http\Request;
use Illuminate\View\ViewName;

class LedgerEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', LedgerEntry::class);

        $stores = Store::paginate(15);
        $stores->each(function ($stores) {
            $stores->load(['transactions' => function ($query) {
                $query->latest()->first();
            }])->first();
        });

        return view('ledger.index', compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Store $store)
    {
        $this->authorize('create', LedgerEntry::class);
        $request->validate([
            'amount' => 'required|numeric',
            'details' => 'required',
        ]);

        LedgerEntry::debit($store->id, $request->amount, $request->details);
        
        $store->payment_requested_at = null;
        $store->update();

        return redirect()->back()->with('success', 'Amount has been deposited successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LedgerEntry  $ledgerEntry
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        abort_unless($store->owner->id == auth()->user()->id || $this->authorize('viewAny', LedgerEntry::class), 403, 'Access Unauthorized');

        $entries = $store->transactions()->latest()->paginate(100);

        $data = LedgerEntry::whereStoreId($store->id)->select(\DB::raw('sum(credit) as earnings, sum(debit) as withdrawals'))->first();
        $data['balance'] = LedgerEntry::whereStoreId($store->id)->select('balance')->latest()->first()->balance ?? 0;

        return view('ledger.show', compact('entries', 'store', 'data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LedgerEntry  $ledgerEntry
     * @return \Illuminate\Http\Response
     */
    public function edit(LedgerEntry $ledgerEntry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LedgerEntry  $ledgerEntry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LedgerEntry $ledgerEntry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LedgerEntry  $ledgerEntry
     * @return \Illuminate\Http\Response
     */
    public function destroy(LedgerEntry $ledgerEntry)
    {
        //
    }

    public function storesList()
    {
        $stores =  Store::select('id', 'name')->orderBy('name')->get();
        $stores->map(function ($query) {
            return $query['ledger_url'] = route('ledgers.show', $query->id);
        });

        return $stores;
    }
}
