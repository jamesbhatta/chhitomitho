@extends('layouts.admin')

@section('content')
<div class="p-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex mb-4">
                    <h5 class="align-self-center page-title">Ledger Book of Couriers</h5>
                </div>
                @include('partials.alerts')
            </div>
            
            <div class="col-md-12">
                <div class="card card-shadow">
                    <div class="card-header">
                        <a class="{{ $type == 'store' ? 'text-muted' : '' }}" href="{{ route('ledgers.index') }}">Stores</a> | 
                        <a class="{{ $type == 'courier' ? 'text-muted' : '' }}" href="{{ route('courier_ledgers.index') }}">Couriers</a>
                    </div>
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
                                @forelse ($couriers as $courier)
                                @if(count($courier->transactions))
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $courier->name }}</td>
                                    <td>
                                        @if(count($courier->transactions))
                                        <span class="@if($courier->transactions->first()->balance >= $courier->credit_limit) text-success  @else text-danger @endif)">
                                            {{ $courier->transactions->first()->balanceAmount }}
                                        </span>
                                        @endif
                                    </td>
                                    <td>{{ moneyFormat($courier->meta->credit_limit) }}</td>
                                    <td>{{ $courier->meta->commission_percentage }} %</td>
                                    <td class="text-center">
                                        @if( $courier->meta->payment_requested_at)
                                        <span class="text-green" data-toggle="tooltip" title="Payment Requested" data-placement="left">
                                            <i class="fas fa-circle"></i>
                                        </span>
                                        @elseif($courier->transactions->first()->balance >= $courier->meta->credit_limit)
                                        <span class="text-ink" data-toggle="tooltip" title="Credit Reached" data-placement="left">
                                            <i class="fas fa-circle"></i>
                                        </span>
                                        @else
                                        <span class="text-red" data-toggle="tooltip" title="No Enough Credit" data-placement="left">
                                            <i class="fas fa-circle"></i>
                                        </span>
                                        @endif

                                        @if($courier->meta->requested_amount)
                                        {{ moneyFormat($courier->meta->requested_amount) }}
                                        @endif

                                    </td>
                                    <td>
                                        <a class="text-primary" href="{{ route('courier_ledgers.show', $courier->id) }}">View Transactions</a>
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
                            Showing {{ $couriers->firstItem() }} to {{ $couriers->lastItem() }} of {{ $couriers->total() }} entries
                        </div>
                        @if($couriers->hasPages())
                        <div class="align-self-center ml-auto">
                            {{ $couriers->links() }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
