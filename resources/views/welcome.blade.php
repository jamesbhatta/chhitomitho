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
    
</style>
@endpush
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="card menu-card rounded-0 mx-auto">
                <div class="title bg-theme-color bg-secondary-color"><i class="fa fa-utensils mr-2"></i>Delicious Menu</div>
                <ul class="menu-list">
                    <li>
                        <a href="">Quick Bites</a>
                    </li>
                    <li>
                        <a href="">Coffee & Tea</a>
                    </li>
                    <li>
                        <a href="">MoMoc</a>
                    </li>
                    <li>
                        <a href="">Rice & Noodles</a>
                    </li>
                    <li>
                        <a href="">Pizzas, Burgers & Pastas</a>
                    </li>
                    <li>
                        <a href="">Noodle Soup</a>
                    </li>
                    <li>
                        <a href="">Sweets</a>
                    </li>
                    <li>
                        <a href="">Beverages</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-8">
            @foreach($categories as $category)
            <div class="items-container">
                <div class="category-wrapper">
                    @if ( count($category->products) )
                    <div class="category-title p-2 mb-4">
                        <h3 class="h3-responsive text-muted">{{ $category->name }}</h3>
                    </div>
                    @endif
                    <div class="row">
                        @foreach ($category->products as $product)
                        <div class="col-md-4">
                            <div class="product-wrapper">
                                <div class="card rounded-0 mb-5">
                                    <img class="card-img-top rounded-0 border-bottom" src="{{ asset('storage/' . $product->product_image) }}" alt="{{ $product->name }}">
                                    <div class="card-body text-center">
                                        <div class="card-title">
                                            <h4 class="h4-responsive font-weight-bolder text-theme-color text-capitalize">
                                                {{ $product->name }}
                                            </h4>
                                        </div>
                                        <div>
                                            <h3 class="h3-responsive text-secondary-color">Rs. {{ number_format($product->regular_price) }}</h3>
                                        </div>
                                        <div class="d-flex justify-content-center my-3">
                                            <div class="mx-2">
                                                <button class="btn btn-sm btn-danger rounded-0 px-3 z-depth-0 m-0">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <div class="mx-2 text-center">
                                                <input type="number" class="counter-control" value="1" min="1" max="99" style="width: 50px; text-align: center;">
                                            </div>
                                            <div class="mx-2">
                                                <button class="btn btn-sm btn-danger rounded-0 px-3 z-depth-0 m-0">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <button class="btn bg-secondary-color text-white rounded-0 text-capitalize z-depth-0 mt-4 w-100">Add to Cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
            
            <div class="items-container">
                <div class="category-wrapper">
                    <div class="category-title p-2 mb-4">
                        <h3 class="h3-responsive text-muted">Quick Bites</h3>
                    </div>
                    <div class="row">
                        @php
                        $category = array('noodles', 'pizza', 'restaurant', 'burger', 'tea');
                        @endphp
                        @for($i = 1; $i <= 15; $i++)
                        <div class="col-md-4">
                            <div class="product-wrapper">
                                <div class="card rounded-0 mb-5">
                                    <img class="card-img-top rounded-0 border-bottom" src="https://loremflickr.com/320/240/{{ $category[array_rand($category)] }}" alt="">
                                    <div class="card-body text-center">
                                        <div class="card-title">
                                            <h4 class="h4-responsive font-weight-bolder text-theme-color text-capitalize">
                                                {{ $category[array_rand($category)] }}
                                            </h4>
                                        </div>
                                        <div>
                                            <h3 class="h3-responsive text-secondary-color">Rs. 160</h3>
                                        </div>
                                        <div class="d-flex justify-content-center my-3">
                                            <div class="mx-2">
                                                <button class="btn btn-sm btn-danger rounded-0 px-3 z-depth-0 m-0">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <div class="mx-2 text-center">
                                                <input type="number" class="counter-control" value="1" min="1" max="99" style="width: 50px; text-align: center;">
                                            </div>
                                            <div class="mx-2">
                                                <button class="btn btn-sm btn-danger rounded-0 px-3 z-depth-0 m-0">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <button class="btn bg-secondary-color text-white rounded-0 text-capitalize z-depth-0 mt-4 w-100">Add to Cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- End of column --}}
                        @endfor
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection