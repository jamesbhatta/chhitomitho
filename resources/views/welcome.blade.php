@extends('layouts.app')

@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
@endpush

@section('content')
{{-- Featured Products section --}}
<div id="featuredProductSection" class="container-fluid" style="background-color: #e2eaef; display: none;">
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

<div class="container py-4">
    <ul class="nav d-flex justify-content-center" id="menuFilter" role="tablist">
        @foreach($categories as $category)
        <li class="nav-item">
            <a class="nav-link @if($loop->iteration == 1) active show @endif" id="{{ $category->slug }}-tab" data-toggle="tab" href="#{{ $category->slug }}-pane" role="tab" aria-controls="{{ $category->slug }}-pane" aria-selected="true">{{ $category->name }}</a>
        </li>
        @endforeach
    </ul>
    <div class="tab-content pt-5" id="myTabContentEx">
        @foreach($categories as $category)
        <div class="tab-pane fade @if($loop->iteration == 1) active show @endif" id="{{ $category->slug }}-pane" role="tabpanel" aria-labelledby="{{ $category->slug }}-tab">
            <div class="row">
                @foreach ($category->products as $product)
                <div class="col-md-3">
                    <x-product-verticle :product="$product"></x-product-verticle>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
</div>

<div class="container my-4">
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
    });
</script>
@endpush