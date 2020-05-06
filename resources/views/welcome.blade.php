@extends('layouts.app')

@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<style>
    #our-menu-section {
        background:  url("{{ asset('assets/img/bg-3-min.jpg') }}") rgba(62, 58, 58, 0.12);
        background-blend-mode: overlay;
        width: 100%;
        min-height: 100vh;
        background-position: center;
        background-attachment: fixed;
        background-size: cover;
        background-repeat: no-repeat;
        font-family: 'Sen', sans-serif;
        position: relative;
    }
    #section-title {
        font-family: 'Sen', sans-serif;
        font-size: 36px;
        font-weight: 600;
        color: #555;
        margin-bottom: 25px;
        z-index: 109;
    }
</style>
@endpush

@section('content')
<div class="">
    <img class="img-fluid w-100" src="{{ asset('assets/img/banner-4-min.jpg') }}">
</div>
{{-- Featured Products section --}}
<div id="featuredProductSection" class="container-fluid" style="display: none;">
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <h3 id="section-title">Quick Order</h3>
            </div>
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
                                    <div class="d-flex justify-content-center my-3">
                                        <div class="">
                                            <button class="qty-minus-btn px-3 z-depth-0 m-0">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <div class="counter-control-wrapper text-center p-0">
                                            <input type="number" class="quantity counter-control border-0" value="{{ $product->min_quantity ?? 1 }}" min="{{ $product->min_quantity ?? 1 }}" max="99">
                                        </div>
                                        <div class="">
                                            <button class="qty-plus-btn px-3 z-depth-0 m-0">
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

<div id="our-menu-section">
    <div class="rgba-black-light">
        <div class="container py-5">
            <div id="menu-head-section">
                <h3 id="section-title" class="text-center">Our Menu</h3>
                <ul class="nav d-flex justify-content-center" id="menuFilter" role="tablist">
                    @foreach($categories as $category)
                    @if(count($category->products))
                    <li class="nav-item">
                        <a class="nav-link @if($loop->iteration == 1) active show @endif" id="{{ $category->slug }}-tab" data-toggle="tab" href="#{{ $category->slug }}-pane" role="tab" aria-controls="{{ $category->slug }}-pane" aria-selected="true">{{ $category->name }}</a>
                    </li>
                    @endif
                    @endforeach
                </ul>
            </div>
            <div class="tab-content pt-5" id="myTabContentEx">
                @foreach($categories as $category)
                <div class="tab-pane fade @if($loop->iteration == 1) active show @endif" id="{{ $category->slug }}-pane" role="tabpanel" aria-labelledby="{{ $category->slug }}-tab">
                    <div class="row">
                        @foreach ($category->products as $product)
                        <div class="col-md-3 d-flex align-items-stretch">
                            <x-product-verticle :product="$product"></x-product-verticle>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <x-home-page-slider />
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('assets/js/shopping.js') }}"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<script>
    $(function () {
        $('#featuredProductSection').show();
        $('#featuredProductSlider').slick({
            dots: false,
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
        
        $(window).scroll(function(){
            var distance = $('#menu-head-section').offset().top - $(window).scrollTop()
            if (distance == 0) {
                $('#menu-head-section').css('padding', '10px');
            } else {
                $('#menu-head-section').css('padding', '25px 10px');
            }
        });
    });
</script>
@endpush