@extends('layouts.app')

@push('styles')
<style>
    #checkout-page {
        font-family: 'Sen', sans-serif;
        color: #434954;
    }
    
    .payment-option-card {
        border-radius: 0;
        text-align: center;
        color: #5394b1;
    }
    .payment-option-card:hover {
        cursor: pointer;
    }
    .payment-option-card .check-mark {
        visibility: hidden;
    }
    .payment-option-card.selected {
        color: #00c851;
        border-color: #00c851!important;
    }
    .payment-option-card.selected .check-mark {
        visibility: visible;
    }
</style>
@endpush
@section('content')
<div id="checkout-page" class="container">
    <form action="{{ route('order.store') }}" method="POST" class="form">
        @csrf
        <div class="row">
            <div class="col-md-12">
                @include('partials.alerts')
            </div>
            <div class="col-md-8">
                <div class="card rounded-0 border">
                    <div class="card-body grey lighten-4 text-theme-color py-2 px-4">
                        <h5>Shipping & Billing</h5>
                    </div>
                    <div class="card-body">
                        <div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="">Name</label>
                                    <input type="text" name="billing_name" class="form-control rounded-0" value="{{ Auth::user()->name }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Mobile</label>
                                    <input type="text" name="billing_phone" class="form-control rounded-0" value="{{ old('billing_phone', Auth::user()->mobile) }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Address</label>
                                    <input type="text" name="billing_address" class="form-control rounded-0" value="{{ old('billing_address', Auth::user()->address) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card rounded-0 border mt-4">
                    <div class="card-body grey lighten-4 text-theme-color py-2 px-4">
                        <h5>Payment Option</h5>
                    </div>
                    <div class="card-body">
                        <input type="radio" id="radio-cod" name="payment_option" value="cod" hidden>
                        <input type="radio" id="radio-esewa" name="payment_option" value="esewa" hidden>
                        <div class="row">
                            <div class="col-md-6">
                                <div id="cod" class="card payment-option-card border border-info">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="align-self-center pr-3">
                                                <i class="check-mark fa fa-check-circle text-success fa-2x"></i>
                                            </div>
                                            <div class="flex-grow-1 p-3">
                                                <span style="font-size: 26px">Cash on Delivery</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div id="esewa" class="card payment-option-card border border-info">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="align-self-center pr-3">
                                                <i class="check-mark fa fa-check-circle text-success fa-2x"></i>
                                            </div>
                                            <div class="flex-grow-1 p-3">
                                                <span style="font-size: 28px">E-sewa</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card border border rounded-0 mt-4">
                    <div class="card-body grey lighten-4 text-theme-color py-2 px-4">
                        <h5>Order Notes (optional)</h5>
                    </div>
                    <div class="card-body">
                        <textarea name="order_notes" id="" class="form-control" cols="30" rows="10" placeholder="Notes about your order, e.g. special notes for delivery.">{{ old('order_notes')}}</textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                {{-- Order Summary card --}}
                <div class="card border border rounded-0">
                    <div class="card-body grey lighten-4 text-theme-color py-2 px-4">
                        <h5>Order Summary</h5>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="text-muted">
                                <?php foreach(Cart::content() as $item) :?>
                                <tr>
                                    <td class="text-muted">{{ $item->name }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>Rs. {{ number_format($item->total) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2">Total</td>
                                    <td>Rs. {{ Cart::total() }}</td>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="d-flex">
                            <div class="ml-auto">
                                <button type="submit" class="btn bg-theme-color text-white rounded-0 text-capitalize">Place Order</button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Supplier card --}}
                @if(count($stores))
                <div class="card border border rounded-0 mt-3">
                    <div class="card-body grey lighten-4 text-theme-color py-2 px-4">
                        <h5>Fulfilled By</h5>
                    </div>
                    <div class="card-body">
                        <label for="">Select Supplier Restaurant (optional)</label>
                        <select name="store_id" id="" class="form-control">
                            <option value="">Any</option>
                            @foreach($stores as $store)
                            <option value="{{ $store->id }}" @if (old('store_id') == $store->id) selected @endif>{{ $store->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endif
            </div>
        </div>
        {{-- End of row --}}
    </form>
</div>
@endsection

@push('scripts')
<script>
    $(function () {
        $('#cod').click(function() {
            $(this).addClass('selected');
            $('#esewa').removeClass('selected');
            $('#radio-cod').prop('checked', true);
        })
        
        $('#esewa').click(function() {
            $(this).addClass('selected');
            $('#cod').removeClass('selected');
            $('#radio-esewa').prop('checked', true);
        })
        
        $('#cod').click();
        
    });
</script>
@endpush