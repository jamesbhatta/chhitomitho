@extends('layouts.admin')

@section('content')
<div class="p-3">
    <div class="container-fluid">
        <form action="{{ route('orders.update', $order) }}" method="POST" class="form">
            @csrf
            @method('put')
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex mb-4">
                        <h5 class="align-self-center page-title">Edit Order</h5>
                        <div class="ml-auto">
                            <a class="btn btn-outline-primary btn-sm z-depth-0" href="{{ route('product.create') }}">Add New</a>
                        </div>
                    </div>
                    @include('partials.alerts')
                </div>
                
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card border rounded-0">
                                <div class="card-body">
                                    <h4 class="h4-responsive">Order #{{ $order->id }} Details</h4>
                                    <div>Payment via {{ $order->payment_option }}. Paid on Feb 7 @ 09:30 AM. Customer IP: {{ $order->customer_ip }}</div>
                                    <div class="my-3"></div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5 class="h5-responsive text-uppercase">General</h5>
                                            <div>{{ $order->user->name }}</div>
                                            <div>{{ \Carbon\Carbon::parse($order->created_at)->format('F j Y h:i:s A') }}</div>
                                            <div><a href="mail:to">{{ $order->user->email }}</a></div>
                                            <div>{{ $order->user->mobile }}</div>
                                        </div>
                                        <div class="col-md-6">
                                            <h5 class="h5-responsive text-uppercase">Shipping</h5>
                                            <div>Name: {{ $order->billing_name }}</div>
                                            <div>Phone: {{ $order->billing_phone }}</div>
                                            <div>Address: {{ $order->billing_address }}</div>
                                            <div>Payment Mode: <span class="text-uppercase">{{ $order->payment_option }}</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12 pt-4">
                            <table class="table custom-table white border">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->orderProducts as $item)
                                    <tr>
                                        <td class="d-flex">
                                            @if (!empty($item->product->product_image))
                                            <img class="img-fluid" src="{{ asset('storage/' . $item->product->product_image) }}" alt="" style="min-width: 50px; height:50px;">
                                            @endif
                                            <div class="ml-3 text-success">{{ $item->name }}</div>
                                        </td>
                                        <td>
                                            Rs. {{ number_format($item->price) }}
                                        </td>
                                        <td>
                                            {{ $item->quantity }}
                                        </td>
                                        <td>Rs. {{ number_format($item->price * $item->quantity) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="font-weight-bolder">
                                        <td colspan="3" class="text-right">Total</td>
                                        <td>Rs. {{ number_format($order->total_price) }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="card border rounded-0">
                            <div class="card-header">
                                Order Notes
                            </div>
                            <div class="card-body">
                                <textarea name="order_notes" id="" class="form-control" cols="30" rows="10">{{ $order->order_notes }}</textarea>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="col-md-4">
                    <div class="card border rounded-0 mb-3">
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary btn-lg rounded-0 w-100">Update</button>
                        </div>
                    </div>
                    <div class="card border rounded-0">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Status:</label>
                                <select name="status" id="" class="form-control rounded-0">
                                    @foreach(config('constants.STATUS') as $key => $value)
                                    <option value="{{ $key }}" @if($key == $order->status) selected @endif</option>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if(!Auth::user()->hasRole('partner'))
                            <div class="form-group">
                                <label>Fulfilled By:</label>
                                <select name="store_id" id="" class="form-control rounded-0" @if($order->courier_id == Auth::user()->id) disabled @endif>
                                    <option value="">Any</option>
                                    @foreach($stores as $store)
                                    <option value="{{ $store->id }}" @if($store->id == $order->store_id) selected @endif>{{ $store->name }}</option>
                                    @endforeach
                                </select>
                                @if($order->partner_id != null)
                                <p class="card-text">
                                    <div>
                                        Store Owner: {{ $order->store->owner->name }}
                                    </div>
                                    <div>
                                        Contact: {{ $order->store->owner->mobile }}
                                    </div>
                                </p>
                                @endif
                            </div>
                            @endif
                            <div class="form-group">
                                <label>Delivered By:</label>
                                <select name="courier_id" id="" class="form-control rounded-0" @if($order->courier_id == Auth::user()->id) disabled @endif>
                                    <option value="">Select Courier</option>
                                    @foreach($couriers as $courier)
                                    <option value="{{ $courier->id }}" @if($courier->id == $order->courier_id) selected @endif>{{ $courier->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </form>
    </div>
</div>
@endsection