@extends('layouts.app')

@push('styles')
<style>
    #cart-page {
        font-family: 'Sen', sans-serif;
        color: #434954;
    }
    
    #cart-table-wrapper {
        position: relative;
    }
    
    .cart-table {
        color: #677897;
    }
    
    .cart-table thead {
        background-color: #fbfcff;
    }
    
    .cart-table thead th {
        color: #677897;
        text-transform: capitalize;
        font-size: 0.8em;
        font-weight: 600;
        border-width: 1.5px;
    }
    
    .cart-table td {
        font-size: inherit;
    }
    
    .cart-table td.name-col {
        color: #363a41;
        font-weight: lighter;
    }
    
    .quantity-picker {
        /* border: 1px solid #efefef; */
        background-color: #efefef;
        border-radius: 25px;
        display: flex;
        justify-content: space-between;
        overflow: hidden;
    }
    
    .quantity-picker .quantity-minus,
    .quantity-picker .quantity-plus {
        padding: 0 10px;
        cursor: pointer;
    }
    
    .quantity-picker .quantity-minus:hover,
    .quantity-picker .quantity-plus:hover {
        color: #28a745;
    }
    
    .quantity-picker .quantity-minus {}
    
    .quantity-picker .quantity-plus {}
    
    .quantity-picker .quantity {
        background-color: #fefefe;
        min-width: 30px;
        text-align: center;
    }
    
    #cart-processing-overlay {
        display: none;
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background-color: rgba(243, 243, 243, 0.53);
        color: #4caf50;
        text-align: center;
    }
    
    #cart-processing-overlay .message {
        padding: 15px;
        position: relative;
        top: 40%;
    }
    
    #order-summary-section {}
    
    .order-summary-section-heading {
        position: sticky;
        top: 10px;
        font-size: 28px;
    }
    
    .summary-section-content {
        margin: 15px auto;
    }
    
    .summary-section-content .subtotal {}
    
    .summary-section-content .subtotal .value,
    .summary-section-content .shipping .value,
    .summary-section-content .total .value {
        font-weight: 600;
    }
    
</style>
@endpush
@section('content')
<div id="cart-page" class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="mb-2">
                @include('partials.alerts')
            </div>
            <div class="mb-3">
                <h4 class="h4-responsive">My Cart</h4>
                <small>You have {{ Cart::count() }} items in your cart.</small>
            </div>
        </div>
        <div class="col-md-8">
            <div id="cart-table-wrapper">
                <table class="table cart-table white border">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach(Cart::content() as $item) :?>
                        <tr>
                            <td class="d-flex name-col">
                                @if ($item->options->has('product_image'))
                                <img class="img-fluid" src="{{ asset('storage/' . $item->options->product_image) }}" alt="" style="min-width: 50px; height:50px;">
                                @endif
                                <div class="ml-3 text-success">{{ $item->name }}</div>
                            </td>
                            <td>
                                Rs. {{ number_format($item->price) }}
                            </td>
                            <td class="text-center">
                                <div class="quantity-picker">
                                    <div class="quantity-minus">-</div>
                                    <div class="quantity" data-row-id="{{ $item->rowId }}" data-min-qty="{{ $item->options->min_quantity ?? 1 }}">{{ $item->qty }}</div>
                                    <div class="quantity-plus">+</div>
                                </div>
                                @if(!is_null($item->options->min_quantity))
                                <div class="text-center small font-italic text-success">
                                    Min: {{ $item->options->min_quantity}}
                                </div>
                                @endif
                            </td>
                            <td>Rs. {{ number_format($item->total) }}</td>
                            <td>
                                <button type="button" class="remove-item-btn bg-transparent border-0 text-danger" data-row-id="{{ $item->rowId }}">
                                    <i class="far fa-times-circle"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div id="cart-processing-overlay">
                    <div class="message">
                        <i class="fa fa-circle-notch fa-spin fa-3x"></i>
                        <div>Processing</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div id="order-summary-section" class="white border p-3">
                <div class="order-summary-section-heading">
                    Order Summary
                </div>
                <div class="summary-section-content">
                    <div class="checkout-summary-rows">
                        <div class="subtotal d-flex justify-content-between">
                            <div class="label text-muted">Subtotal</div>
                            <div class="value">Rs. {{ Cart::total() }}</div>
                        </div>
                        <div class="shipping d-flex justify-content-between">
                            <div class="label text-muted">Shipping</div>
                            <div class="value">Rs. {{ Cart::tax() }}</div>
                        </div>
                        <div class="total d-flex justify-content-between mt-2 pt-2 border-top">
                            <div class="label font-weight-bold text-theme-color">Total</div>
                            <div class="value text-theme-color">Rs. {{ Cart::total() }}</div>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-between">
                    <a href="#" class="btn bg-secondary-color text-white rounded-0">Need More</a>
                    <a href="#" class="btn bg-theme-color text-white rounded-0">Checkout</a>
                </div>
            </div>
        </div>
        <div class="col-lg-2"></div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        function updateCart(rowId, quantity) {
            $('#cart-processing-overlay').show();
            $.ajax({
                url: "{{ route('cart.update', ) }}", 
                type: 'POST',
                data: { rowId: rowId, quantity: quantity }
            })
            .done(function() {})
            .fail(function() {})
            .always(function() {
                location.reload();
            })
        }
        
        $('.quantity-minus').click(function() {
            var rowId = $(this).parent().find('.quantity').data('row-id');
            var quantity = parseInt($(this).parent().find('.quantity').text());
            var minQty = parseInt($(this).parent().find('.quantity').data('min-qty'));
            if (quantity > minQty) {
                updateCart(rowId, quantity - 1);
            }
        });
        $('.quantity-plus').click(function() {
            var rowId = $(this).parent().find('.quantity').data('row-id');
            var quantity = parseInt($(this).parent().find('.quantity').text());
            updateCart(rowId, quantity + 1);
        });
        
        $('.remove-item-btn').click(function() {
            console.log('updating');
            var rowId = $(this).data('row-id');
            updateCart(rowId, 0);
        });
    });
    
</script>
@endpush
