@extends('layouts.app')

@push('styles')
<style>
    #cart-page {
        font-family: 'Sen', sans-serif;
        color: #434954;
    }
    
    .empty-cart-container {
        width: 300px;
        margin: 20px auto;
        padding: 15px;
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
    
    #order-summary-section {
        position: sticky;
        top: 10px;
    }
    
    .order-summary-section-heading {
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
<div id="cart-page" class="container my-4">
    @if(!Cart::count())
    <div class="card border rounded-0">
        <div class="card-body text-center">
            <div class="empty-cart-container">
                <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512"><defs><linearGradient id="linear-gradient" x1="305.57" y1="474.02" x2="305.59" y2="474.02" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#dd1f26"/><stop offset="1" stop-color="#e15c25"/></linearGradient><linearGradient id="linear-gradient-2" x1="12.77" y1="256" x2="499.23" y2="256" xlink:href="#linear-gradient"/><linearGradient id="linear-gradient-3" x1="410.12" y1="9.9" x2="421.04" y2="9.9" xlink:href="#linear-gradient"/></defs><title>Empty Cart</title><polygon points="305.57 474.03 305.59 474.02 305.58 474.02 305.57 474.03" fill="url(#linear-gradient)"/><path d="M482.74,299.35c6.07-1.76,15.56-1.09,16.4-7.93,1.12-9-8.35-7.08-14.28-8.13-5.26-.95-10.49-2.12-15.72-3.19,14.75-32.07,15-34.41,11.46-34.75-30-2.9-13.59-25.51-17.31-39.47,10.33-1.72,20-4.86,28.16-12.25-4.78-5.55-13.89,0-16.64-8-4.82-19.6-28.94-12.75-37.45-27.32a25,25,0,0,0-.12-4.09c2.35-2.38,4.7-4.77,7.05-7.18h0l9.92-1.75h0c7.57-2.35,11.45-10.11,6.81-14.13-9.7-8.42-21.27-5.33-31.4,1.93-23.72,1.45-28.66-19.78-40-33.22l8.27-11.75C410,83.81,410,69.79,418.54,62.57c5,2.36,10.55,4,13.34-2.43,2.59-6-.89-10.45-7-11.16-11-1.27-17.93,4.21-21.05,14.66l0,0c-17.72,21.27-38.86,7-58.76,5.66-11.47,0-23.6,2.55-32.22-8.36q.22-6.25.44-12.48c13.36-13.42,15-28.67,4.89-48.5-4.12,24.1-19.08,36-39.47,42.14h0L238.69,60l-8.5-5.23c-17.42-3.42-20.51-23.9-35.71-30-4.87-3.75-10.82-12.44-15.73-7.2-7.71,8.26,4.26,14.51,6.9,22-.29,9.92,7.51,15.1,12.8,21.75h0L187.83,72.88c-9.77,2.35-18.85.16-27.57-4.17l0,0,0,0-1.5-.85h0c-1.91-7.71-2-16.2-9.52-21.42h0c-.93-12.36-5-23.07-16.86-28.73-1.88-.89-7,.79-7.78,2.53C118.45,34.32,134,40.2,137,51c.48,1.67,3,2.78,4.58,4.16L137.3,69.32h0l0,0c-5.93,7.52-16.45,12.56-13.41,24.92-2.56,6.4-8.49,6.1-13.84,7a11.49,11.49,0,0,0-5.61-2.2c-4-12-12.9-24.44-24.11-16.07-9.78,7.32-3.24,20.9,8.89,27.35h0c2.26,2.9,4.55,5.8,6.85,8.71v0c.12,2.54.23,5.05.35,7.59L84.23,138.7h0c-4.57-.61-9.13-1.21-13.69-1.84C62,132,51.07,126.71,46.25,138.33c-4.36,10.51,6.49,13.5,15.34,14.82q1.91,7,3.84,13.95h0v0Q54.78,182.46,44.1,197.8h0c-7.29,4.12-22.55-5.55-22.14,8.65.22,8.35,14.06,4.81,21.93,6.11l6.72,11.91L31.4,243.12c-6.5-.16-14.38-.75-17.54,5.3-3.69,7.09,2.72,12.89,8.4,15,19.57,7.12,13.06,16.75,3.71,27.24C11.17,314.43,48.8,312.06,45.65,330c-2.58,12-28.52,13.64-14.57,33,9.86,9.59,21.36,3.84,32.28,3.44l0,0h0c4,6.17,12.83,14.1,11.3,18.23-10.28,28.07,10.23,34.37,28,43.08.71,7.15,2.16,13.66,11.59,13.06,7.94,6.34-9,30.69,11.49,28,1.85.32,4.28-.15,7.49-1.72,15.36-8.71,29.59-14.43,29.67,12.59,0,17.12,10.53,16.44,21.44,11.84,8.38-3.52,13.86-13.93,25.24-10.28,9.56,6.2,23.11,3.43,30.81,13.78h0c17.9,13.64,36,31.4,51.78-2.29,6-5.11,12.38-9.92,13.4-18.64l19.35,6.43c27.18,31.55,19-17.3,33.46-14.7l12.88.94c5.7,8.88,11.46,22.37,23.83,13.18,7.55-5.6,8.12-18-7.35-20.07v0l0,0c-2.52-8.85,9.37-10.5,9.08-18.23h0c7.46-15.67,28.71-12.58,37-27.16l.14.06c9.13,5.49,18.66,9.21,29.6,6.95,9.07-8.79,12.11-19.91,12.46-32.07,13.62-17-.78-17.88-11.87-20.65h0c-3.55-9.6,1.3-17.94,3.89-26.63.75-1.83,1.42-3.69,2-5.58,10.35-.37,22.77,4.58,28.93-10.6-10-5.77-19.47-3.69-28.75-3.46C465.63,310,473.45,304.28,482.74,299.35ZM305.57,474h0Z" fill="url(#linear-gradient-2)"/><path d="M420.95,7.38c.6-1.38-1.93-5.94-3.38-6.11-5.12-.6-7,3.61-7.42,7.82-.25,2.45,1.25,5.07,2.49,9.51C416.35,13.83,419.38,10.94,420.95,7.38Z" fill="url(#linear-gradient-3)"/><path d="M361.89,169.21H187.48l-3.76-20.94c-.9-5.27-5.51-8-10.83-8H150a9.3,9.3,0,1,0,0,18.6h16l4.72,29.3L188.53,304c1.32,4.87,4.31,9.87,9.63,9.87H342.63c5.32,0,9.18-5.75,9.63-9.67l19.26-125.27C372.42,173.65,367.21,169.21,361.89,169.21Zm-26.48,126h-130L190.94,187.81H349.85Z" fill="#fff"/><path d="M308.92,323.42A24.08,24.08,0,1,0,333,347.49,24.07,24.07,0,0,0,308.92,323.42Zm0,38.52a14.45,14.45,0,1,1,14.45-14.45A14.45,14.45,0,0,1,308.92,361.94Z" fill="#fff"/><path d="M222.24,323.42a24.08,24.08,0,1,0,24.08,24.08A24.07,24.07,0,0,0,222.24,323.42Zm0,38.52a14.45,14.45,0,1,1,14.45-14.45A14.45,14.45,0,0,1,222.24,361.94Z" fill="#fff"/><polygon points="330.85 216.74 331.92 208.47 208.87 208.47 209.94 216.74 330.85 216.74" fill="#fff"/><polygon points="212.07 237.4 328.72 237.4 329.79 227.07 211 227.07 212.07 237.4" fill="#fff"/><polygon points="214.22 256 326.57 256 327.64 245.67 213.15 245.67 214.22 256" fill="#fff"/><polygon points="216.35 274.6 324.44 274.6 325.51 266.33 215.28 266.33 216.35 274.6" fill="#fff"/></svg>
            </div>
            <div>
                <h3 class="h3-responsive font-weight-bolder">Unfortunately, Your Cart Is Empty</h3>
                <div class="text-muted">Please add something in your cart</div>
                <br>
                <a class="btn btn-outline-dark" href="{{ url('/') }}">Continue Shopping</a>
            </div>
        </div>
    </div>
    @else
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
                    <a href="{{ url('/') }}" class="btn bg-secondary-color text-white rounded-0">Need More</a>
                    <a href="{{ route('checkout.index') }}" class="btn bg-theme-color text-white rounded-0">Checkout</a>
                </div>
            </div>
        </div>
        <div class="col-lg-2"></div>
    </div>
    <div id="push-sales" class="row my-5" v-cloak>
        <div v-if="products" class="col-md-12">
            <h5 class="mb-3">@{{ title }}</h5>
            <div class="row">
                <div v-for="product in products" class="col-md-3">
                    <x-product-verticle-vue></x-product-verticle-vue>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
@push('scripts')
<script src="{{ asset('assets/js/shopping.js') }}"></script>    

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
        
        var pushSales = new Vue({
            el: '#push-sales',
            data: {
                title: 'Recommended',
                products: null
            },
            mounted() {
                this.fetchPushSalesProducts();
            },
            methods: {
                formatMoney: function (number) {
                    return new Intl.NumberFormat('en-IN', { maximumSignificantDigits: 3 }).format(number)
                },
                fetchPushSalesProducts: function() {
                    axios.get('{{ route('ajax.push_sales_products') }}')
                    .then(response => {
                        if(response.status == 200) {
                            this.products = response.data;
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    })
                    .then(function () {
                    });
                },
                
                addToCart: function (id, quantity, e) {
                    var btn = 'product'+id;
                    console.log(this.$refs[btn]);
                    this.$refs[btn][0].innerText = 'Adding to Cart';
                    this.$refs[btn][0].disabled = true;
                    
                    $('#cart-processing-overlay').show();
                    axios.post('{{ route('cart.add') }}', {
                        id: id,
                        quantity: quantity
                    })
                    .then(response => {
                        if(response.status == 200){
                            location.reload();
                            this.$refs[btn][0].innerText = 'Add To Cart';
                            this.$refs[btn][0].disabled = false;
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    })
                }
            }
        })
    });
</script>
@endpush
