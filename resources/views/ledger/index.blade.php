@extends('layouts.admin')

@section('content')
<div class="p-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex mb-4">
                    <h5 class="align-self-center page-title">Ledger Book</h5>
                </div>
                @include('partials.alerts')
            </div>
            
            <div class="col-md-12">
                <div class="card card-shadow">
                    <div class="card-body white card-shadow p-3">
                        <table id="order-table" class="table custom-table table-hover white">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Store Name</th>
                                    <th>Balance</th>
                                    <th>Credit Limit</th>
                                    <th>Commission</th>
                                    <th></th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($stores as $store)
                                @if(count($store->transactions))
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $store->name }}</td>
                                    <td>
                                        @if(count($store->transactions))
                                        <span class="@if($store->transactions->first()->balance >= $store->credit_limit) text-success  @else text-danger @endif)">
                                            {{ $store->transactions->first()->balanceAmount }}
                                        </span>
                                        @endif
                                    </td>
                                    <td>NRs. {{ number_format($store->credit_limit) }}</td>
                                    <td>{{ $store->commission_percentage }} %</td>
                                    <td class="text-center">
                                        @if( $store->hasRequestedPayment)
                                        <span class="text-green" data-toggle="tooltip" title="Payment Requested" data-placement="left">
                                            <i class="fas fa-circle"></i>
                                        </span>
                                        @elseif($store->transactions->first()->balance >= $store->credit_limit)
                                        <span class="text-ink" data-toggle="tooltip" title="Credit Reached" data-placement="left">
                                            <i class="fas fa-circle"></i>
                                        </span>
                                        @else
                                        <span class="text-red" data-toggle="tooltip" title="No Enough Credit" data-placement="left">
                                            <i class="fas fa-circle"></i>
                                        </span>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="text-primary" href="{{ route('ledgers.show', $store->id) }}">View Transactions</a>
                                    </td>
                                </tr>
                                @endif
                                @empty
                                <tr>
                                    <td class="text-center font-italic" colspan="10">
                                        !! No transactions found !!
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer d-flex">
                        <div class="align-self-center text-dark">
                            Showing {{ $stores->firstItem() }} to {{ $stores->lastItem() }} of {{ $stores->total() }} entries
                        </div>
                        @if($stores->hasPages())
                        <div class="align-self-center ml-auto">
                            {{ $stores->links() }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
