@extends('layouts.app')

@push('styles')
<style>
    .menu-card {
        padding: 20px 0;
        font-family: 'Sen', sans-serif;
        max-width: 300px;
        position: sticky;
        top: 20px;
    }
    
    .menu-card .title {
        color: #fff;
        margin: 0 -2px 10px -2px;
        padding: 10px 15px;
        text-align: center;
        font-size: 18px;
    }
    
    .menu-card .menu-list {
        padding: 0;
    }
    
    .menu-card .menu-list li {
        list-style: none;
        margin-left: 20px;
        margin-right: 20px;
        border-bottom: 1.1px solid #efefef;
    }
    
    .menu-card .menu-list li:hover {
        background-color: #fafafa;
    }
    
    .menu-card .menu-list li a {
        padding: 15px 10px;
        color: inherit;
        display: block;
    }
    
    .category-title {
        /* font-family: 'Permanent Marker', cursive; */
        font-family: 'Sen', sans-serif;
    }
    
    /* Chrome, Safari, Edge, Opera */
    .counter-control::-webkit-outer-spin-button,
    .counter-control::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    
    /* Firefox */
    .counter-control[type=number] {
        -moz-appearance: textfield;
    }
    
    
</style>
@endpush
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <x-home-page-slider />
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            {{-- Menu Card --}}
            <div class="card menu-card card-shadow rounded-0 mx-auto">
                <div class="title bg-theme-color bg-secondary-color"><i class="fa fa-utensils mr-2"></i>Delicious Menu</div>
                <ul class="menu-list">
                    @foreach($categories as $category)
                    <li>
                        <a href="#{{ $category->slug }}">{{ $category->name }}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
            {{-- End of Menu Card --}}
        </div>
        <div class="col-md-9">
            @foreach($categories as $category)
            <div class="items-container">
                <div id="{{ $category->slug }}" class="category-wrapper">
                    @if ( count($category->products) )
                    <div class="category-title mb-4">
                        <h3 class="h3-responsive text-muted">{{ $category->name }}</h3>
                    </div>
                    @endif
                    <div class="row">
                        @foreach ($category->products as $product)
                        <div class="col-md-4">
                            <div class="product-wrapper">
                                <div class="card card-shadow rounded-0 mb-5">
                                    <img class="card-img-top rounded-0 border-bottom" src="{{ asset('storage/' . $product->product_image) }}" alt="{{ $product->name }}">
                                    <div class="card-body text-center">
                                        <div class="card-title">
                                            <h4 class="h4-responsive font-weight-bolder text-theme-color text-capitalize">
                                                {{ $product->name }}
                                            </h4>
                                        </div>
                                        <div>
                                            @if($product->sale_price)
                                            <h3 class="h3-responsive text-secondary-color">Rs. {{ number_format($product->sale_price) }}</h3>
                                            @endif
                                            @if($product->sale_price)
                                            <strike>
                                                @endif
                                                <h3 class="h3-responsive text-secondary-color">Rs. {{ number_format($product->regular_price) }}</h3>
                                                @if($product->sale_price)
                                            </strike>
                                            @endif
                                        </div>
                                        <div class="d-flex justify-content-center my-3">
                                            <div class="mx-2">
                                                <button class="qty-minus-btn btn btn-sm btn-danger rounded-0 px-3 z-depth-0 m-0">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <div class="mx-2 text-center">
                                                <input type="number" class="quantity counter-control" value="{{ $product->min_quantity ?? 1 }}" min="{{ $product->min_quantity ?? 1 }}" max="99" style="width: 50px; text-align: center;">
                                            </div>
                                            <div class="mx-2">
                                                <button class="qty-plus-btn btn btn-sm btn-danger rounded-0 px-3 z-depth-0 m-0">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        @if($product->min_quantity)
                                        <p class="font-italic">Min. order : {{ $product->min_quantity }}</p>
                                        @endif
                                        <button class="add-to-cart-btn btn bg-secondary-color text-white rounded-0 text-capitalize z-depth-0 mt-4 w-100" data-product-id="{{ $product->id }}">Add to Cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
            
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function () {
        $('.qty-minus-btn').click(function () {
            var quantity = $(this).parent().parent().find('.quantity');
            var qty = parseInt(quantity.val());
            var min = parseInt(quantity.attr('min'));
            if(qty > 1 && qty > min){
                quantity.val(qty-1);
            }
        });
        
        $('.qty-plus-btn').click(function () {
            var quantity = $(this).parent().parent().find('.quantity');
            var qty = parseInt(quantity.val());
            if(qty < 99){
                quantity.val(qty+1);
            }
        });
        
        $('.add-to-cart-btn').click(function () {
            $(this).attr('disabled', 'true');
            $(this).html('<i class="fas fa-circle-notch fa-spin"></i> Adding');
            var id = $(this).data('product-id');
            var quantity = parseInt($(this).parent().find('.quantity').val()) ;
            var button = this;
            $.ajax({
                url: "{{ route('cart.add') }}",
                type: 'POST',
                data: {id: id, quantity: quantity},
            })
            .done(function(response) {
                console.log(response);
                if(response.status == 200) {
                }
            })
            .fail(function(response) {
                console.log("error");
                console.log(response);
            })
            .always(function() {
                App.loadCartSummary();
            });
            setTimeout(() => {
                $(this).html('Add to Cart');
            }, 1000);
            $(this).removeAttr('disabled');
        });
    });
</script>
@endpush
