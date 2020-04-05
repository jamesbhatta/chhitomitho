@extends('layouts.app')

@push('styles')
<style>
    #orders-page {
        font-family: 'Sen', sans-serif;
    }
</style>
@endpush
@section('content')
<div id="orders-page" class="container">
    <h2 class="h2-responsive mb-3">My Orders</h2>
   
    @include('partials.alerts')
 
    @foreach ($orders as $order)
    <div class="card border rounded-0 mb-4">
        <div class="card-header white">
            <div class="d-flex">
                <div>
                    <h6>Order #{{ $order->id }}</h6>
                    <div class="small text-muted">Placed on {{ \Carbon\Carbon::parse($order->created_at)->format('jS \\of F Y h:i:s A') }}</div>
                </div>
                <div class="ml-auto">
                    <h6 class="h6-responsive text-capitalize">{{ $order->status }}</h6>
                    <div class="small text-muted text-uppercase">{{ $order->payment_option }}</div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                @foreach ($order->orderProducts as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td><span class="text-muted">Qty:</span> {{ $product->quantity }}</td>
                    <td><span class="text-muted">Delivered on</span> {{ \Carbon\Carbon::parse($order->created_at)->format('jS \\of F Y h:i A') }}</td>
                </tr>
                @endforeach
            </table>
            
            @if (!is_null($order->order_notes))
            <p class="card-text">
                <i class="mdb-color-text">Order Notes:</i>
                <br>
                {{ $order->order_notes }}
            </p>
            @endif
        </div>
    </div>
    @endforeach
</div>
@endsection