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

