@extends('layouts.admin')

@section('content')
<div class="p-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="mb-4">
                    <h5 class="page-title">Product Category</h5>
                </div>
                @include('partials.alerts')
            </div>
            <div class="col-md-3">
                <div class="card card-shadow rounded-0">
                    <div class="card-body">
                        <p class="card-text">
                            Product categories for your store can be managed here.
                        </p>
                    </div>
                    <div class="p-3">
                        <h5>Add a new category</h5>
                        <hr>
                        <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data" class="form">
                            @csrf
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control rounded-0 form-control-lg" value="{{ old('name') }}">
                            </div>
                            <div class="form-group">
                                <label for="">Slug</label>
                                <input type="text" name="slug" class="form-control rounded-0" value="{{ old('slug') }}">
                            </div>
                            <div class="form-group">
                                <label for="">Order</label>
                                <input type="number" name="order" class="form-control rounded-0" value="{{ old('order') }}">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary rounded-0 card-shadow">Add New Category</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="white card-shadow">
                    <table class="table custom-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Count</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($categories))
                            @foreach ($categories as $category)
                            <tr id="cat-{{ $loop->iteration }}" class="category-list-row">
                                <td>{{ $category->order }}</td>
                                <td>
                                    {{ $category->name }}
                                    <div class="list-options mt-1 invisible" style="visibility: ;">
                                        <button type="button" data-id="{{ $loop->iteration }}" class="quick-edit-btn border-0 bg-transparent text-primary">Edit</button> | 
                                        <form action="{{ route('category.destroy', $category) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="del-category-btn border-0 bg-transparent text-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                                <td>{{ $category->slug }}</td>
                                <td>{{ $category->products_count }}</td>
                                <td>
                                    <span class="text-warning mr-2">
                                        @if($category->active)
                                        <i class="far fa-check-circle"></i>
                                        @else
                                        <i class="far fa-times-circle text-danger"></i>
                                        @endif
                                    </span>
                                    @if($category->featured)
                                    <span class="text-warning"><i class="far fa-star"></i></span>
                                    @endif
                                </td>
                            </tr>
                            <tr id="edit-{{ $loop->iteration }}" class="d-none">
                                <td colspan="5">
                                    <form action="{{ route('category.update', $category) }}" method="POST" class="form">
                                        @csrf
                                        @method('PUT')
                                        <h6 class="font-weight-bolder text- text-muted mb-3">Edit Category: {{ $category->name}}</h6>
                                        <div class="form-group form-row">
                                            <label class="col-sm-1"><i>Name</i></label>
                                            <div class="col-sm-10">
                                                <input type="text" name="name" class="form-control form-control-sm rounded-0 mr-3" value="{{ $category->name }}">
                                            </div>
                                        </div>
                                        <div class="form-group form-row">
                                            <div class="col-md-1">
                                                <label><i>Slug</i></label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" name="slug" class="form-control form-control-sm rounded-0 mr-3" value="{{ $category->slug }}">
                                            </div>
                                        </div>
                                        <div class="form-group form-row">
                                            <div class="col-md-1">
                                                <label><i>Order</i></label>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="number" name="order" class="form-control form-control-sm rounded-0 mr-3" value="{{ $category->order }}">
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" name="active" class="custom-control-input" id="checkbox-active-{{ $loop->iteration }}" @if($category->active) checked @endif>
                                                    <label class="custom-control-label" for="checkbox-active-{{ $loop->iteration }}">Active</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" name="featured" class="custom-control-input" id="checkbox-featured-{{ $loop->iteration }}" @if($category->featured) checked @endif>
                                                    <label class="custom-control-label" for="checkbox-featured-{{ $loop->iteration }}">Featured</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group form-row">
                                            <button type="button" data-id="{{ $loop->iteration }}" class="cancel-quick-edit-btn btn btn-outline-danger btn-sm z-depth-0 rounded-0">Cancel</button>
                                            <button type="submit" class="ml-auto btn btn-primary btn-sm z-depth-0 rounded-0">Update</button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="4">The category list is empty. Please add some first.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function() {
        $('.category-list-row').hover(function() {
            $(this).find('.list-options').removeClass('invisible');
        }, function () {
            $(this).find('.list-options').addClass('invisible');
        });
        
        $('.quick-edit-btn').click(function () {
            var listId = $(this).data('id');
            $('#cat-' + listId).toggleClass('d-none');
            $('#edit-' + listId).toggleClass('d-none');
        });
        
        $('.cancel-quick-edit-btn').click(function () {
            var listId = $(this).data('id');
            $('#cat-' + listId +  ', #edit-' + listId).toggleClass('d-none');
            // $('#edit-' + listId).toggleClass('d-none');
        });
        
        $('.del-category-btn').click(function () {
            var ch = confirm ('Are you absolutely sure you want to delete?');
            if(ch == true) {
                return true;
            }
            return false;
        });
        
    });
    
</script>
@endpush
