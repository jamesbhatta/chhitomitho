<div class="product-wrapper mb-5">
    <div class="card h-100 z-depth-0">
        <img class="card-img-top" src="{{ asset('storage/' . $product->product_image) }}" alt="{{ $product->name }}">
        <div class="card-body text-center h-100">
            <div class="card-title">
                <h4 class="h4-responsive text-capitalize">
                    {{ $product->name }}
                </h4>
            </div>
            <div>
                <span class="h5-responsive d-inline  @if($product->sale_price) text-strike @endif">Rs. {{ number_format($product->regular_price) }}</span>
                @if($product->sale_price)
                <span class="h4-responsive d-inline">Rs. {{ number_format($product->sale_price) }}</span>
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
            <p class="font-italic small">Min. order : {{ $product->min_quantity }}</p>
            @endif
            <button class="add-to-cart-btn z-depth-0" data-product-id="{{ $product->id }}"><i class="fas fa-shopping-basket mr-2"></i> Add to Cart</button>
        </div>
    </div>
</div>