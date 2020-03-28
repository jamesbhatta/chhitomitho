@extends('layouts.admin')

@push('styles')
<style>
    .custom-form label {
        color: #6c757d;
        font-family: 'Times New Roman', Times, serif;
    }
    .custom-form input::placeholder {
        color: #ababab;
        font-family: 'Times New Roman', Times, serif;
    }
</style>
@endpush
@section('content')
<div class="p-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="mb-4">
                    <h5 class="page-title">Add New Product</h5>
                </div>
                @include('partials.alerts')
            </div>
        </div>
        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" class="form custom-form">
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <div class="form-row white card-shadow p-3">
                        <div class="form-group col-md-12">
                            <label>Product Name * </label>
                            <input type="text" name="name" class="form-control form-control-lg rounded-0" value="{{ old('name') }}" placeholder="Product Name" required autofocus>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Category * </label>
                            <select name="category_id" id="" class="form-control rounded-0">
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Regular Price (NRs) *</label>
                            <input type="number" name="regular_price" class="form-control rounded-0" value="{{ old('regular_price') }}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Sale Price (NRs)</label>
                            <input type="number" name="sale_price" class="form-control rounded-0" value="{{ old('sale_price') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Sale Price From</label>
                            <input type="date" name="sale_price_from" class="form-control rounded-0" value="{{ old('sale_price_from') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Sale Price To</label>
                            <input type="date" name="sale_price_to" class="form-control rounded-0" value="{{ old('sale_price_to') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Miniumum Quantity</label>
                            <input type="number" name="min_quantity" class="form-control rounded-0" min="1" value="{{ old('min_quantity') }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group text-center white card-shadow p-3">
                        <button type="submit" class="btn btn-primary rounded-0 card-shadow">Add New Product</button>
                    </div>
                    <div class="form-group white card-shadow text-center">
                        <img id="productImagePreview" class="img-fluid border" src="https://dummyimage.com/400x400/c7c7c7/ffffff.png" alt="">
                        <input type="file" id="productImage" name="product_image" hidden>
                        <div class="p-3">
                            <label for="productImage" class="btn btn-primary rounded-0 z-depth-0 text-white" for="">Select Image</label>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function () {
        function readProductImageURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#productImagePreview').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        
        $("#productImage").change(function(){
            readProductImageURL(this);
        });
    });
</script>
@endpush