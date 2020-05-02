<?php

namespace App\Http\Controllers;

use App\CourierLedger;
use App\User;
use Illuminate\Http\Request;

class CourierLedgerController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', CourierLedger::class);

        $couriers = User::couriers()->paginate(15);
        $couriers->each(function ($couriers) {
            $couriers->load(['transactions' => function ($query) {
                $query->latest()->first();
            }])->first();
        });
        $type = 'courier';

        return view('ledger.index-courier', compact('couriers', 'type'));
    }

    public function store(Request $request, $courier_id)
    {
        $this->authorize('create', CourierLedger::class);

        $courier = User::couriers()->findOrFail($courier_id);
        $request->validate([
            'amount' => 'required|numeric',
            'details' => 'required',
        ]);

        CourierLedger::debit($courier->id, $request->amount, $request->details);
        
        $courier->meta->payment_requested_at = null;
        $courier->meta->requested_amount = null;
        $courier->meta->update();

        return redirect()->back()->with('success', 'Amount has been deposited successfully.');
    }

    public function show($id)
    {
        $courier = User::couriers()->findOrFail($id);
        abort_unless($courier->id == auth()->user()->id || $this->authorize('viewAny', CourierLedger::class), 403, 'Access Unauthorized');

        $entries = $courier->transactions()->latest()->paginate(100);

        $data = CourierLedger::whereCourierId($courier->id)->select(\DB::raw('sum(credit) as earnings, sum(debit) as withdrawals'))->first();
        $data['balance'] = CourierLedger::whereCourierId($courier->id)->select('balance')->latest()->first()->balance ?? 0;

        return view('ledger.show-courier', compact('entries', 'courier', 'data'));
    }

    public function couriersList()
    {
        $couriers =  User::select('id', 'name')->couriers()->orderBy('name')->get();
        $couriers->map(function ($query) {
            return $query['ledger_url'] = route('courier_ledgers.show', $query->id);
        });

        return $couriers;
    }
}
