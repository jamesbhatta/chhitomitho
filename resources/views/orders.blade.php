@extends('layouts.app')

@push('styles')
<style>
    #orders-page {
        font-family: 'Sen', sans-serif;
    }
    
    .card-shadow {
        box-shadow: 0 0px 15px 2px rgba(143, 143, 143, 0.09);
    }
</style>
@endpush
@section('content')
<div id="orders-page" class="container">
    <h2 class="h2-responsive text-muted mb-3">My Orders</h2>
    
    @include('partials.alerts')
    
    @foreach ($orders as $order)
    <div class="card card-shadow mb-4">
        <div class="card-header grey lighten-5 mdb-color-text">
            <div class="d-flex">
                <div>
                    <h6 class="h6-responsive text-info">Order #{{ $order->id }}</h6>
                    <div class="small text-muted">Placed on {{ \Carbon\Carbon::parse($order->created_at)->format('jS \\of F Y h:i:s A') }}</div>
                </div>
                <div class="ml-auto">
                    <h6 class="h6-responsive text-capitalize text-info">{{ $order->status }}</h6>
                    <div class="small text-muted text-uppercase"><i class="fas fa-dollar-sign mr-2"></i> {{ $order->payment_option }}</div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <table class="table table-borderless table-sm mdb-color-text">
                        <tbody>
                            @foreach ($order->orderProducts as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td><span class="text-muted">Qty:</span> {{ $product->quantity }}</td>
                                <td><span class="text-muted">Rs.</span> {{ $product->price }} <span class="text-muted small">/ unit</span></td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class=" rgba-blue-slight">
                            <tr class="font-weight-bolder">
                                <td colspan="2" class="text-right">Total</td>
                                <td><span class="text-muted">Rs.</span> {{ number_format($order->total_price) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                    @if (!is_null($order->order_notes))
                    <p class="card-text">
                        <i class="mdb-color-text">Order Notes:</i>
                        <br>
                        {{ $order->order_notes }}
                    </p>
                    @endif
                </div>
                <div class="col-md-4">
                    @if($order->hasStore)
                    <div class="card border purple lighten-1 text-white mb-3">
                        <div class="card-body">
                            Order fulfilled by: <span class="font-weight-bold">{{ $order->store->name }}</span>
                        </div>
                    </div>
                    @endif
                    @if($order->hasCourier)
                    <div class="card z-depth-0">
                        <div class="card-body text-center purple-text">
                            <img class="img-fluid img-thumbnail" src="{{ $order->courier->gravatar }}" alt="{{ $order->courier->name }}" style="max-height: 300px;">
                            <p class="my-2"><span class="text-muted">Delivery Boy:</span> <span class="font-weight-bolder">{{ $order->courier->name }}</span></p>
                            <p><span class="text-muted">Mobile:</span> {{ $order->courier->mobile }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection