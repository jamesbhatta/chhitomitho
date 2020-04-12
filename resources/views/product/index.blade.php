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
            <div class="col-md-12 mb-4">
                <div class="d-flex">
                    <form action="{{ route('product.deletemultiple') }}" method="POST">
                        @csrf
                        @method('delete')
                        <input type="hidden" id="product_ids" name="product_ids">
                        <button type="submit" id="bulk-delete-btn" class="btn btn-outline-danger btn-sm rounded-0 card-shadow ml-0" >Delete Selected</button>
                    </form>
                </div>
            </div>
        </div>
        <table class="table custom-table white card-shadow">
            <thead>
                <tr>
                    <th>
                        <input type="checkbox" id="select-all">
                    </th>
                    <th>#</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Category</th>
                    
                </tr>
            </thead>
            <tbody>
                @if( count($products) )
                @foreach ($products as $product)
                <tr>
                    <td>
                        <input type="checkbox" name="id[]" class="select-checkbox" value="{{ $product->id }}">
                    </td>
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
                        <a href="{{ route('product.edit', $product) }}" class="edit-link" data-toggle="tooltip" title="Edit" data-placement="top"><i class="far fa-edit"></i></a>
                        <form action="{{ route('product.destroy', $product) }}" method="POST" class="form d-inline">
                            @csrf
                            @method('delete')
                            <button type="submit" class="del-product-btn del-btn" data-toggle="tooltip" title="Delete" data-placement="top"><i class="far fa-trash-alt"></i></button>
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
        
        @if($products->hasPages())
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
        
        $('.select-checkbox').change( function () {
            var arr = $('.select-checkbox:checked').map(function() { return this.value; }).get().join();
            $('#product_ids').val(arr);
            if (arr.length  > 0) {
                $('#bulk-delete-btn').removeAttr('disabled');
            } else {
                $('#bulk-delete-btn').prop('disabled', true);
            }
        });

        $('#select-all').change( function () {
            if($(this).prop('checked')) {
                $('.select-checkbox').prop('checked', true).trigger('change');
            } else {
                $('.select-checkbox').prop('checked', false).trigger('change');
            }
        })

        $('#bulk-delete-btn').click( function (e) {
            var ch = confirm ('Are you absolutely sure you want to delete all the selected items?');
            if(ch == true) {
                return true;
            }
            return false;
        });
    });
</script>
@endpush