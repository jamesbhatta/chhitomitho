@extends('layouts.admin')

@section('content')
<div class="p-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="mb-4">
                    <h5 class="page-title">Stores</h5>
                </div>
                @include('partials.alerts')
            </div>
            <div class="col-md-3">
                <div class="card card-shadow rounded-0">
                    <div class="card-body">
                        <p class="card-text">
                            Stores available can be managed here.
                        </p>
                    </div>
                    <div class="p-3">
                        <h5>Add a new Store</h5>
                        <hr>
                        <form action="{{ route('stores.store') }}" method="POST" class="form">
                            @csrf
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control rounded-0 form-control-lg" value="{{ old('name') }}">
                            </div>
                            <div class="form-group">
                                <label>Owner</label>
                                <select name="user_id" id="" class="form-control rounded-0">
                                    @foreach($partners as $partner)
                                    <option value="{{ $partner->id }}">{{ $partner->name }} : {{ $partner->email }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Commission Percentage</label>
                                <div class="input-group mb-3">
                                    <input type="text" name="commission_percentage" class="form-control rounded-0" value="{{ old('commission_percentage') }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text rounded-0">%</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Credit Limit</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <span class="input-group-text rounded-0">NRs.</span>
                                    </div>
                                    <input type="text" name="credit_limit" class="form-control rounded-0" value="{{ old('credit_limit') }}">
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-primary rounded-0 card-shadow">Add New Store</button>
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
                                <th>Username</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Commission & credit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($stores))
                            @foreach ($stores as $store)
                            <tr id="cat-{{ $loop->iteration }}" class="category-list-row">
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    {{ $store->name }}
                                    <div class="list-options mt-1 invisible" style="visibility: ;">
                                        <button type="button" data-id="{{ $loop->iteration }}" class="quick-edit-btn border-0 bg-transparent text-primary">Edit</button> | 
                                        <form action="{{ route('stores.destroy', $store) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="del-category-btn border-0 bg-transparent text-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                                <td>{{ $store->owner->name }}</td>
                                <td>{{ $store->owner->email }}</td>
                                <td>{{ $store->owner->mobile }}</td>
                                <td>{{ $store->commission_percentage }} %, NRs. {{ number_format($store->credit_limit) }}</td>
                            </tr>
                            <tr id="edit-{{ $loop->iteration }}" class="d-none">
                                <td colspan="6">
                                    <form action="{{ route('stores.update', $store) }}" method="POST" class="form">
                                        @csrf
                                        @method('PUT')
                                        <h6 class="font-weight-bolder text- text-muted mb-3">Edit Store: {{ $store->name}}</h6>
                                        <div class="form-group form-row">
                                            <label class="col-sm-1"><i>Name</i></label>
                                            <div class="col-sm-10">
                                                <input type="text" name="name" class="form-control form-control-sm rounded-0 mr-3" value="{{ $store->name }}">
                                            </div>
                                        </div>
                                        <div class="form-group form-row">
                                            <div class="col-md-1">
                                                <label><i>Owner</i></label>
                                            </div>
                                            <div class="col-sm-10">
                                                <select name="user_id" class="form-control rounded-0">
                                                    @foreach($partners as $partner)
                                                    <option value="{{ $partner->id }}" @if($partner->id == $store->user_id) selected @endif>{{ $partner->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group d-flex">
                                            <div class="col-md-2 align-self-center">
                                                <label><i>Commission</i></label>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="input-group input-group-sm">
                                                    <input type="text" name="commission_percentage" class="form-control form-control-sm rounded-0" value="{{ $store->commission_percentage }}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text rounded-0">%</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 text-center align-self-center">
                                                <label><i>Credit Limit</i></label>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text rounded-0">NRs.</span>
                                                    </div>
                                                    <input type="text" name="credit_limit" class="form-control form-control-sm rounded-0" value="{{ $store->credit_limit }}">
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
                            <tr class="text-center">
                                <td colspan="5">The stores list is empty. Please add some first.</td>
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
