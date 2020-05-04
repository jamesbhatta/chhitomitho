@extends('layouts.admin')

@section('content')
<div class="p-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex mb-4">
                    <h5 class="page-title align-self-center">Add User</h5>
                    <div class="ml-auto">
                        <a href="{{ route('users.index') }}" class="btn btn-outline-primary btn-sm z-depth-0">Users</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card rounded-0 p-4 card-shadow">
            @include('partials.alerts')
            <div class="row">
                <div class="col-md-4">
                    <div class="profile-pic-container text-center" style="width: 100%; height: 300px;">
                        <img class="img-fluid" src="" alt="">
                    </div>
                </div>
                <div class="col-md-8 text-muted">
                    <div class="p-3">
                        <form action="{{ route('users.store') }}" method="POST" class="form">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="">Name</label>
                                    <input type="text" name="name" class="form-control " value="{{ old('name') }}">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Email</label>
                                    <input type="email" name="email" class="form-control rounded-0" value="{{ old('email') }}">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Mobile</label>
                                    <input type="text" name="mobile" class="form-control rounded-0" value="{{ old('mobile') }}" placeholder="98xxxxxxxx">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Address</label>
                                    <input type="text" name="address" class="form-control rounded-0" value="{{ old('address') }}" placeholder="Address">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="form-check-label mb-2" for="">Gender</label>
                                    <br>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" name="gender" class="form-check-input" value="male">Male
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" name="gender" class="form-check-input" value="female">Female
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" name="gender" class="form-check-input" value="other">Other
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Role</label>
                                    <select name="role" id="userRole" class="form-control">
                                        @if(old('role'))
                                        <option value="{{ old('role') }}" selected>{{ ucfirst(old('role')) }}</option>
                                        @endif
                                        <option value="admin">Admin</option>
                                        <option value="manager">Manager</option>
                                        <option value="partner">Partner</option>
                                        <option value="courier">Courier</option>
                                        <option value="customer">Customer</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-6 form-group courier-details" style="display: none;">
                                    Receives a commission of 
                                    <div class="input-group mb-3">
                                        <input type="number" name="commission_percentage" class="form-control" value="{{ old('commission_percentage') }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group courier-details" style="display:none;">
                                    Minimum withdraw amount is 
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">NRs.</span>
                                        </div>
                                        <input type="number" name="credit_limit" class="form-control" value="{{ old('credit_limit') }}">
                                    </div>
                                </div>
                                
                                <div class="col-md-6 form-group">
                                    <label for="password">New Password</label>
                                    <input type="text" name="password" class="form-control rounded-0" value="{{ old('password') }}">
                                    <small id="passwordHelpBlock" class="form-text text-muted">
                                        Password must be 8-20 characters long, contain letters and numbers, and must not contain spaces,
                                        special characters,
                                        or emoji.
                                    </small>
                                </div>
                                
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-lg rounded-0 card-shadow">Add User</button>
                                </div>
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#userRole').on('change', function () {
            console.log('role changed to: ' + $(this).val());
            if($(this).val() == 'courier') {
                $('.courier-details').show();
            } else {
                $('.courier-details').hide();
            }
        });
    });
</script>
@endpush