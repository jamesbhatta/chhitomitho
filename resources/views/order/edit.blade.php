@extends('layouts.admin')

@section('content')
<div class="p-3">
    <div class="container-fluid">
        
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex mb-4">
                    <h5 class="align-self-center page-title">Edit Order {{ $order->orderNumber }}</h5>
                    <div class="ml-auto">
                        <a class="btn btn-outline-primary btn-sm z-depth-0" href="{{ route('product.create') }}">Add New</a>
                    </div>
                </div>
                @include('partials.alerts')
            </div>
        </div>
        <form action="{{ route('orders.update', $order) }}" method="POST" class="form">
            @csrf
            @method('put')
            <div class="row">
                <div class="col-md-8">
                    {{-- Order Details --}}
                    <div class="card border rounded-0 mb-3">
                        <div class="card-body">
                            <h4 class="h4-responsive">Order {{ $order->orderNumber }} Details</h4>
                            @if(Auth::user()->hasRoles(['admin', 'manager', 'courier']))
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
                                <div class="col-md-12">
                                    <x-status-tracker :status="$order->status"></x-status-tracker>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    {{-- End of Order Details --}}
                    {{-- Products List --}}
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
                    {{-- End of products list --}}
                    
                    {{-- Order Notes --}}
                    @if( Auth::user()->hasRoles(['admin', 'manager']))
                    <div class="card border rounded-0">
                        <div class="card-header">
                            Order Notes
                        </div>
                        <div class="card-body">
                            <textarea name="order_notes" id="" class="form-control" cols="30" rows="5">{{ $order->order_notes }}</textarea>
                        </div>
                    </div>
                    @endif

                    @if(Auth::user()->hasRole('partner') && !is_null($order->order_notes))
                    <div class="card border my-3">
                        <div class="card-body">
                            {{ $order->order_notes }}
                        </div>
                    </div>
                    @endif
                    {{-- End of Order Notes --}}
                    
                    {{-- Store Notes --}}
                    @if( Auth::user()->hasRoles(['admin', 'manager']))
                    <div class="card border rounded-0 my-3">
                        <div class="card-header">
                            Note to store
                        </div>
                        <div class="card-body">
                            <textarea name="store_notes" id="" class="form-control" cols="30" rows="5">{{ $order->store_notes }}</textarea>
                        </div>
                    </div>
                    @endif
                    
                    @if(Auth::user()->hasRole('partner') && !is_null($order->store_notes))
                    <div class="card border my-3">
                        <div class="card-body">
                            {{ $order->store_notes }}
                        </div>
                    </div>
                    @endif
                    {{-- End of Store Notes --}}
                    
                    {{-- Courier Notes --}}
                    @if( Auth::user()->hasRoles(['admin', 'manager']))
                    <div class="card border rounded-0 my-3">
                        <div class="card-header">
                            Note to Courier
                        </div>
                        <div class="card-body">
                            <textarea name="courier_notes" id="" class="form-control" cols="30" rows="5">{{ $order->courier_notes }}</textarea>
                        </div>
                    </div>
                    @endif
                    
                    @if(Auth::user()->hasRole('courier') && !is_null($order->courier_notes))
                    <div class="card border my-3">
                        <div class="card-body">
                            {{ $order->courier_notes }}
                        </div>
                    </div>
                    @endif
                    {{-- End of Corier Notes --}}
                </div>
                
                @if(Auth::user()->hasRoles(['admin', 'manager']))
                <div class="col-md-4">
                    <div style="position: sticky; top: 10px;">
                        <div class="card border rounded-0 mb-3">
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
                                    @if (!empty($order->preferred_store))
                                    <div class="form-text"><small>Preferred Store:</small> {{ $order->preferred_store }}</div>
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
                                <div>
                                    Next steps:
                                    @if($order->status == 'pending_payment')
                                    <ul>
                                        <li>Await for Payment</li>
                                    </ul>
                                    @endif
                                    @if($order->status == 'pending')
                                    <ol>
                                        @if($order->payment_option == 'cod')
                                        <li>Call customer</li>
                                        @endif
                                        <li>Select Store</li>
                                        <li>Select Courier</li>
                                        @if($order->payment_option == 'cod')
                                        <li>Change status to Confirmed or Cancelled</li>
                                        @endif
                                    </ol>
                                    @endif
                                    @if($order->status == 'confirmed')
                                    <ul>
                                        <li>Change status to Processing</li>
                                    </ul>
                                    @endif
                                    @if($order->status == 'processing')
                                    <ul>
                                        <li>Change status to Shipped</li>
                                    </ul>
                                    @endif
                                    @if($order->status == 'shipped')
                                    <ul>
                                        <li>Change status to Delivered</li>
                                    </ul>
                                    @endif
                                    @if($order->status == 'delivered')
                                    <span class="text-success">No more actions Reqired</span>
                                    @endif
                                    @if($order->status == 'cancelled')
                                    <span class="text-danger">This order has been cancelled</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="card border rounded-0">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary btn-lg rounded-0 w-100">Update</button>
                            </div>
                        </div>
                    </div>
                    {{-- End of sticky div --}}
                </div>
                @else
                <div class="col-md-4">
                    <div class="card border rounded-0 mb-3">
                        <div class="card-body">
                            <p class="card-text">
                                @if(Auth::user()->hasRole('partner') && $order->hasCourier)
                                <img class="img-fluid" src="{{ $order->courier->gravatar }}" style="max-height: 400px;">
                                <ul class="list-group list-group-flushed">
                                    <div class="list-group-item d-flex justify-content-between border-0">
                                        <dt>Delivery Boy:</dt>
                                        <div>{{ $order->courier->name }}</div>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between border-0">
                                        <dt>Contact:</dt>
                                        <div>{{ $order->courier->mobile }}</div>
                                    </div>
                                </ul>
                                @endif
                                @if(Auth::user()->hasRole('courier') && $order->hasStore)
                                <ul class="list-group list-group-flush">
                                    <div class="list-group-item d-flex justify-content-between border-0">
                                        <dt>Store:</dt>
                                        <div>{{ $order->store->owner->name }}</div>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between border-0">
                                        <dt>Contact:</dt>
                                        <div>{{ $order->store->owner->mobile }}</div>
                                    </div>
                                </ul>
                                @endif
                                
                            </p>
                        </div>
                    </div>
                    <div class="card border rounded-0">
                        <div class="card-body">
                            <div>
                                Status: <span class="text-capitalize">{{ $order->status }}</span>
                            </div>
                            
                            @if($order->status == "confirmed")

                            @can('markProcessed', App\Order::class)
                            <input type="hidden" name="processed" value="true" hidden>
                            <button type="submit" class="btn btn-info btn-lg rounded-0 w-100 text-capitalize card-shadow">Mark Processing</button>
                            @endcan

                            @elseif($order->status == "processing")
                            
                            <input type="hidden" name="dispatched" value="true" hidden>
                            <button type="submit" class="btn btn-success btn-lg rounded-0 w-100 text-capitalize card-shadow">Dispatch</button>
                            
                            @elseif(Auth::user()->hasRole('courier') && $order->status == "shipped")
                            
                            <input type="hidden" name="delivered" value="true" hidden>
                            <button type="submit" class="btn btn-success btn-lg rounded-0 w-100 text-capitalize card-shadow">Mark Delivered</button>
                            
                            @else
                            <div class="text-center">No Actions Required</div>
                            @endif
                            
                        </div>
                    </div>
                </div>
                @endif
            </div>
            {{-- End of row --}}
        </form>
    </div>
</div>
@endsection