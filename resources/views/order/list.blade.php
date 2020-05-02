@extends('layouts.admin')

@section('content')
<div class="p-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex mb-4">
                    <h5 class="align-self-center page-title">Manage Orders</h5>
                </div>
                @include('partials.alerts')
            </div>
            
            <div class="col-md-12">
                <div class="card card-shadow">
                    <div class="card-header grey lighten-5">
                        <div class="d-flex">
                            <div class="align-self-center">
                                <a class="{{ $filter == 'all' ? 'text-muted' : '' }}" href="{{ route('orders.index') }}">All</a> | 
                                <a class="{{ $filter == 'pending' ? 'text-muted' : '' }}" href="{{ route('orders.index') }}?filter=pending">Pending</a> | 
                                <a class="{{ $filter == 'processing' ? 'text-muted' : '' }}" href="{{ route('orders.index') }}?filter=processing">Processing</a> | 
                                <a class="{{ $filter == 'shipped' ? 'text-muted' : '' }}" href="{{ route('orders.index') }}?filter=shipped">Shipped</a> | 
                                <a class="{{ $filter == 'delivered' ? 'text-muted' : '' }}" href="{{ route('orders.index') }}?filter=delivered">Delivered</a>
                            </div>
                            <form action="{{ route('orders.index') }}" class="form-inline ml-auto align-self-center">
                                @csrf
                                <div class="form-group mb-2">
                                    <label for="search-order-number" class="sr-only">Email</label>
                                    <input type="text" class="form-control form-control-sm rounded-0" name="order_number" id="search-order-number" value="{{ $order_number }}" placeholder="# Order Number">
                                </div>
                                <div class="form-group mx-sm-3 mb-2">
                                    <label for="search-name" class="sr-only">Password</label>
                                    <input type="text" class="form-control form-control-sm rounded-0" name="name" id="search-name" value="{{ $name }}" placeholder="Name">
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm card-shadow rounded-0 px-3 my-0 mb-2 ml-0"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="card-body white card-shadow p-3">
                        <table id="order-table" class="table custom-table table-hover white">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Mode</th>
                                    <th>Date</th>
                                    @if(!Auth::user()->hasRole('partner'))
                                    <th>Store</th>
                                    @endif
                                    @if(!Auth::user()->hasRole('courier'))
                                    <th>Courier</th>
                                    @endif
                                    <th>Status</th>
                                    <th class="text-right">Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)
                                <tr>
                                    <td>{{ $order->orderNumber }}</td>
                                    <td>
                                        <a href="{{ route('orders.edit', $order) }}" data-toggle="tooltip" title="Edit">
                                            {{ $order->user->name }}
                                            <div>{{ $order->billing_address }}</div>
                                        </a>
                                    </td>
                                    <td class="">
                                        <div class="text-uppercase">{{ $order->payment_option }}</div>
                                        @if($order->payment_option == "esewa")
                                        <div class="text-center small">
                                            {{ isPaymentComplete($order) ? '(paid)' : '(unpaid)' }}
                                        </div>
                                        @endif
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($order->created_at)->format('h:i A') }}<br>
                                        {{ \Carbon\Carbon::parse($order->created_at)->isoFormat('D MMM YYYY') }}
                                    </td>
                                    @if(!Auth::user()->hasRole('partner'))
                                    <td>
                                        @if($order->hasStore)
                                        {{ $order->store->name }}
                                        <div>
                                            {{ $order->store->owner->mobile}}
                                        </div>
                                        @endif
                                    </td>
                                    @endif
                                    @if(!Auth::user()->hasRole('courier'))
                                    <td>
                                        @isset($order->courier)
                                        <a href="{{ route('users.edit', $order->courier) }}" data-toggle="tooltip" title="Courier Details" target="_blank">{{ $order->courier->name }}</a>
                                        <div>
                                            {{ $order->courier->mobile}}
                                        </div>
                                        @endisset
                                    </td>
                                    @endif
                                    <td class="text-capitalize">
                                        <div class="badge z-depth-0 p-2 {{ statusBadgeClass($order->status) }}">{{ $order->status }}</div>
                                    </td>
                                    <td class="text-right">Rs. {{ number_format($order->total_price) }}</td>
                                    <td>
                                        <a href="{{ route('orders.edit', $order) }}" class="edit-link" data-toggle="tooltip" title="Edit"><i class="far fa-edit"></i></a> | 
                                        <form action="{{ route('orders.destroy', $order) }}" method="POST" class="form d-inline">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="del-order-btn del-btn" data-toggle="tooltip" title="Delete"><i class="far fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center font-italic" colspan="10">
                                        !! No orders found !!
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer d-flex">
                        <div class="align-self-center text-dark">
                            Showing {{ $orders->firstItem() }} to {{ $orders->lastItem() }} of {{ $orders->total() }} entries
                        </div>
                        @if($orders->hasPages())
                        <div class="align-self-center ml-auto">
                            {{ $orders->links() }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function () {
        $('.del-order-btn').click(function () {
            var ch = confirm ('Are you absolutely sure you want to delete?');
            if(ch == true) {
                return true;
            }
            return false;
        });
    });
</script>
@endpush