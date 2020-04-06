@extends('layouts.admin')

@section('content')
<div class="p-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex mb-4">
                    <h5 class="align-self-center page-title">Orders</h5>
                    <div class="ml-auto">
                        <a class="btn btn-outline-primary btn-sm z-depth-0" href="{{ route('product.create') }}">Add New</a>
                    </div>
                </div>
                @include('partials.alerts')
            </div>
            <div class="col-md-12">
                <div class="white card-shadow">
                    <table class="table custom-table white">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th class="text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                            <tr>
                                <td>#{{ $order->id }}</td>
                                <td>
                                    <a href="{{ route('orders.edit', $order) }}" data-toggle="tooltip" title="Edit">{{ $order->user->name }}</a>
                                </td>
                                <td class="text-muted">
                                    {{ \Carbon\Carbon::parse($order->created_at)->format('F j Y h:i:s A') }}
                                </td>
                                <td class="text-capitalize">
                                    <div class="badge badge-light z-depth-0 p-2">{{ $order->status }}</div>
                                </td>
                                <td class="text-right">Rs. {{ number_format($order->total_price) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @foreach ($orders as $order)
            <div class="card border rounded-0 mb-4 d-none">
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
    </div>
</div>
@endsection