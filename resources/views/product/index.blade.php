@extends('layouts.admin')

@section('content')
<div class="p-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex mb-4">
                    <h5 class="align-self-center page-title">Products</h5>
                    <div class="ml-auto">
                        <a class="btn btn-outline-primary btn-sm z-depth-0" href="{{ route('product.create') }}">Add New</a>
                    </div>
                </div>
                @include('partials.alerts')
            </div>
        </div>
        <table class="table custom-table white card-shadow">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @if( count($products) )
                @foreach ($products as $product)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $product->name }}</td>
                    <td>
                        @if($product->sale_price)
                        <div>Rs. {{ number_format($product->sale_price) }}</div>
                        <div class="text-muted">
                            <strike>Rs. {{ number_format($product->regular_price) }}</strike>
                        </div>
                        @else
                        <div>
                            Rs. {{ number_format($product->regular_price) }}
                        </div>
                        @endif
                    </td>
                    <td>{{ $product->category->name }}</td>
                    <td>
                        <a href="{{ route('product.edit', $product) }}" class="text-muted"><i class="far fa-edit"></i> Edit</a> | 
                        <form action="{{ route('product.destroy', $product) }}" method="POST" class="form d-inline">
                            @csrf
                            @method('delete')
                            <button type="submit" class="del-product-btn btn bg-transparent text-muted z-depth-0 p-0 my-0"><i class="far fa-trash-alt"></i> Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="5">
                        <div class="text-center font-italic">No Products have been added. Please add some first. <a href="{{ route('product.create') }}" class="text-primary">Add Product</a></div>
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
        
        @if($products->hasMorePages())
        <div class="d-flex">
            <div class="ml-auto">
                {{ $products->links() }}
            </div>
        </div>
        @endif
        
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function () {
        $('.del-product-btn').click(function () {
            var ch = confirm ('Are you absolutely sure you want to delete?');
            if(ch == true) {
                return true;
            }
            return false;
        });
    });
</script>
@endpush