<div class="product-wrapper">
    <div class="card card-shadow rounded-0 mb-5">
        <img class="card-img-top rounded-0 border-bottom" v-bind:src="product.product_image_url" v-bind:alt="product.name">
        <div class="card-body text-center">
            <div class="card-title">
                <h4 class="h4-responsive text-capitalize">
                    @{{ product.name }}
                </h4>
            </div>
            <div class="price">
                <span v-bind:class="{ 'text-strike' : product.sale_price }" class="h4-responsive">Rs. @{{ formatMoney(product.regular_price) }}</span>
                <span v-if="product.sale_price" class="h5-responsive d-inline text-secondary-color">Rs. @{{ formatMoney(product.sale_price) }}</span>
            </div>
            {{-- <div class="d-flex justify-content-center my-3">
                <div class="mx-2">
                    <button class="qty-minus-btn btn btn-sm btn-danger rounded-0 px-3 z-depth-0 m-0">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
                <div class="mx-2 text-center">
                    <input type="number" class="quantity counter-control" v-bind:value="product.min_quantity || 1" v-bind:min="product.min_quantity || 1" max="99" style="width: 50px; text-align: center;">
                </div>
                <div class="mx-2">
                    <button class="qty-plus-btn btn btn-sm btn-danger rounded-0 px-3 z-depth-0 m-0">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </div> --}}
            <p v-if="product.min_quantity" class="font-italic">Min. order : @{{product.min_quantity }}</p>
            <button v-bind:ref="'product'+product.id" v-on:click="addToCart(product.id, product.min_quantity || 1, $event)" class="add-to-cart-btn z-depth-0 mt-4 w-100" v-bind:data-product-id="product.id">Add to Cart</button>
            {{-- <button v-bind:ref="'product'+product.id" class="add-to-cart-btn btn bg-secondary-color text-white rounded-0 text-capitalize z-depth-0 mt-4 w-100" v-bind:data-product-id="product.id">Add to Cart</button> --}}
        </div>
    </div>
</div>

