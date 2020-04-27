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

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<style>
    /* ************
    *  SLICK DESIGN
    * ************ */
    /* Slick Prev Next Buttons */
    .c-slick-prev,
    .c-slick-next{
        position: absolute;
        top: 40%;
        z-index: 100;
        padding: 15px 12px;
        background: #7ac400;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0.9;
        cursor: pointer;
    }
    .c-slick-prev{
        left: -15px;
    }
    .c-slick-next{
        right: -15px;
    }
    .c-slick-prev:hover,
    .c-slick-next:hover{
        background: #fff;;
        border: 1px solid #ff9800;
        color: #ff9800;
        opacity: 1;
    }
    
    /* Dots */
    .slick-dotted.slick-slider
    {
        margin-bottom: 30px;
    }
    
    .slick-dots
    {
        position: absolute;
        bottom: -40px;
        display: block;
        width: 100%;
        padding: 0;
        margin: 0;
        list-style: none;
        text-align: center;
    }
    .slick-dots li
    {
        position: relative;
        display: inline-block;
        width: 20px;
        height: 20px;
        margin: 0 5px;
        padding: 0;
        cursor: pointer;
    }
    .slick-dots li button
    {
        font-size: 0;
        line-height: 0;
        display: block;
        width: 20px;
        height: 20px;
        padding: 5px;
        cursor: pointer;
        color: transparent;
        border: 0;
        outline: none;
        background: transparent;
    }
    .slick-dots li button:hover,
    .slick-dots li button:focus
    {
        outline: none;
    }
    .slick-dots li button:hover:before,
    .slick-dots li button:focus:before
    {
        opacity: 1;
    }
    .slick-dots li button:before
    {
        font-family: 'slick';
        font-size: 26px;
        line-height: 20px;
        position: absolute;
        top: 0;
        left: 0;
        width: 20px;
        height: 20px;
        content: '•';
        text-align: center;
        opacity: .25;
        color: black;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }
    .slick-dots li.slick-active button:before
    {
        opacity: .75;
        color: black;
    }
    
    /* Hide Arrows when disabled */
    .c-slick-prev.slick-disabled,
    .c-slick-next.slick-disabled{
        display: none!important;
    }
    
    /* Product slider Styles */
    #featuredProductSlider .product-wrapper {
        font-family: 'Sen', sans-serif;
        color: #747d89;
    }
    #featuredProductSlider img{
        height: 150px;
    }
    #featuredProductSlider .product-wrapper .add-to-cart-btn {
        color: #7ac400;
        font-size: 14px;
        text-transform: uppercase;
        background: none;
        border: 1px solid #7ac400;
        padding: 6px 14px;
        margin-top: 5px;
        line-height: 18px;
        border-radius: 20px;
    }
    
    #featuredProductSlider .product-wrapper .add-to-cart-btn:hover,
    #featuredProductSlider .product-wrapper .add-to-cart-btn:focus {
        color: #fff;
        background: #7ac400;
        box-shadow: none;
    }
    #featuredProductSlider .product-wrapper .qty-minus-btn,
    #featuredProductSlider .product-wrapper .qty-plus-btn {
        padding: 5px;
        color: #fff;
        background-color: #ff9800;
        border: 1px solid #ff9800;
    }
    #featuredProductSlider .product-wrapper .qty-minus-btn{
        border-top-left-radius: 20px;
        border-bottom-left-radius: 20px;
    }
    #featuredProductSlider .product-wrapper .qty-plus-btn{
        border-top-right-radius: 20px;
        border-bottom-right-radius: 20px;
    }
    #featuredProductSlider .product-wrapper .qty-minus-btn:hover,
    #featuredProductSlider .product-wrapper .qty-plus-btn:hover {
        color: #ff9800;
        background-color: #fff;
    }
    
    #featuredProductSlider .product-wrapper .counter-control {
        padding: 0;
        outline: none;
        color: #747d89;
    }

    #featuredProductSlider .product-wrapper .counter-control-wrapper {
        border-top: 1px solid #ff9800;
        border-bottom: 1px solid #ff9800;
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
    
</div>

{{-- Featured Products section --}}
<div class="container-fluid" style="background-color: #e2eaef;">
    <div class="container py-4">
        <div class="row">
            <div class="col-md-12">
                <div id="featuredProductSlider" class="px-3">
                    @foreach ($featuredProducts as $product)
                    <div class="slider-product-wrapper py-0 px-3">
                        <div class="product-wrapper">
                            <div class="card card-shadow rounded-0">
                                <img class="card-img-top rounded-0" src="{{ asset('storage/' . $product->product_image) }}" alt="{{ $product->name }}">
                                <div class="card-body text-center">
                                    <div class="card-title">
                                        <h4 class="h4-responsive text-capitalize">
                                            {{ $product->name }}
                                        </h4>
                                    </div>
                                    <div>
                                        @if($product->sale_price)
                                        <strike>
                                            @endif
                                            <h5 class="h5-responsive d-inline">Rs. {{ number_format($product->regular_price) }}</h5>
                                            @if($product->sale_price)
                                        </strike>
                                        @endif
                                        @if($product->sale_price)
                                        <h4 class="h4-responsive d-inline">Rs. {{ number_format($product->sale_price) }}</h4>
                                        @endif
                                    </div>
                                    {{-- <div class="d-flex justify-content-center my-3">
                                        <div class="mx-2">
                                            <button class="qty-minus-btn btn btn-sm rounded-0 px-3 z-depth-0 m-0">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <div class="mx-2 text-center">
                                            <input type="number" class="quantity counter-control" value="{{ $product->min_quantity ?? 1 }}" min="{{ $product->min_quantity ?? 1 }}" max="99" style="width: 50px; text-align: center;">
                                        </div>
                                        <div class="mx-2">
                                            <button class="qty-plus-btn btn btn-sm rounded-0 px-3 z-depth-0 m-0">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div> --}}
                                    <div class="d-flex justify-content-center my-3">
                                        <div class="">
                                            <button class="qty-minus-btn btn btn-sm px-3 z-depth-0 m-0">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <div class="counter-control-wrapper text-center">
                                            <input type="number" class="quantity counter-control border-0" value="{{ $product->min_quantity ?? 1 }}" min="{{ $product->min_quantity ?? 1 }}" max="99" style="width: 50px; text-align: center;">
                                        </div>
                                        <div class="">
                                            <button class="qty-plus-btn btn btn-sm px-3 z-depth-0 m-0">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    @if($product->min_quantity)
                                    {{-- <p class="font-italic">Min. order : {{ $product->min_quantity }}</p> --}}
                                    @endif
                                    <button class="add-to-cart-btn btn bg-secondary-color z-depth-0" data-product-id="{{ $product->id }}"><i class="fas fa-shopping-basket mr-2"> </i> Add to Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
{{-- End of Featured Products section --}}


<div class="container my-4">
    
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
                            <x-product-verticle :product="$product"></x-product-verticle>
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
<script src="{{ asset('assets/js/shopping.js') }}"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<script>
    $(function () {
        $('#featuredProductSlider').slick({
            dots: true,
            infinite: true,
            speed: 1500,
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 1500,
            arrows: true,
            prevArrow: '<div class="c-slick-prev"><span class="fa fa-chevron-left"></span></div>',
            nextArrow: '<div class="c-slick-next"><span class="fa fa-chevron-right"></span></div>',
            responsive: [{
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 400,
                settings: {
                    arrows: false,
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }]
        });
    });
</script>
@endpush
{{-- @push('scripts')
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
@endpush --}}
