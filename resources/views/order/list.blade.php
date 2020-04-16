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
                    <table class="table custom-table table-hover white">
                        <thead>
                            <tr class="text-center">
                                <th></th>
                                <th>Name</th>
                                <th>Mode</th>
                                <th>Date</th>
                                <th>Store</th>
                                <th>Courier</th>
                                <th>Status</th>
                                <th class="text-right">Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->orderNumber }}</td>
                                <td>
                                    <a href="{{ route('orders.edit', $order) }}" data-toggle="tooltip" title="Edit">
                                        {{ $order->user->name }}
                                        <div>{{ $order->billing_address }}</div>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <div class="text-uppercase">{{ $order->payment_option }}</div>
                                    @if($order->payment_option == "esewa")
                                    <div class="text-center small">
                                        {{ isPaymentComplete($order) ? '(paid)' : '(unpaid)' }}
                                    </div>
                                    @endif
                                </td>
                                <td class="text-muted">
                                    {{ \Carbon\Carbon::parse($order->created_at)->format('F j Y @ h:i:s A') }}
                                </td>
                                <td>
                                    @if($order->hasStore)
                                    {{ $order->store->name }}
                                    <div>
                                        {{ $order->store->owner->mobile}}
                                    </div>
                                    @endif
                                </td>
                                <td>
                                    @isset($order->courier)
                                    <a href="{{ route('users.edit', $order->courier) }}" data-toggle="tooltip" title="Courier Details" target="_blank">{{ $order->courier->name }}</a>
                                    <div>
                                        {{ $order->courier->mobile}}
                                    </div>
                                    @endisset
                                </td>
                                <td class="text-capitalize">
                                    <div class="badge z-depth-0 p-2 {{ statusBadgeClass($order->status) }}">{{ $order->status }}</div>
                                </td>
                                <td class="text-right">Rs. {{ number_format($order->total_price) }}</td>
                                <td>
                                    <a href="{{ route('orders.edit', $order) }}" class="edit-link" data-toggle="tooltip" title="Edit"><i class="far fa-edit"></i></a> | 
                                    <form action="{{ route('orders.destroy', $order) }}" method="POST" class="form d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="del-user-btn del-btn" data-toggle="tooltip" title="Delete"><i class="far fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if($orders->hasPages())
                <div class="d-flex">
                    <div>
                        Showing {{ $orders->firstItem() }} to {{ $orders->lastItem() }} of {{ $orders->total() }} entries
                    </div>
                    <div class="ml-auto">
                        {{ $orders->links() }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection