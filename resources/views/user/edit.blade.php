@extends('layouts.admin')

@section('content')
<div class="p-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex mb-4">
                    <h5 class="page-title align-self-center">Edit User {{ $user->name }}</h5>
                    <div class="ml-auto">
                        <a href="{{ route('users.index') }}" class="btn btn-outline-primary btn-sm z-depth-0">Users</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card rounded-0 p-4 card-shadow">
            @include('partials.alerts')
            <form action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data" class="form">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-pic-container text-center" style="width: 100%; height: 300px;">
                            <img id="profilePicPreview" class="img-fluid" src="{{ $user->gravatar }}" alt="{{ $user->name }}" style="max-height: 300px;">
                        </div>
                        <div class="text-center">
                            <input type="file" id="profilePic" name="profile_pic" hidden>
                            <div class="p-3">
                                <label for="profilePic" class="btn btn-primary rounded-0 z-depth-0 text-white" for="">Select Image</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 text-muted">
                        <div class="p-3">
                            <input type="hidden" name="id" value="{{ $user->id }}" hidden>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="">Name</label>
                                    <input type="text" name="name" class="form-control " value="{{ old('name', $user->name) }}">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Email</label>
                                    <input type="email" name="email" class="form-control rounded-0" value="{{ old('email', $user->email) }}">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Mobile</label>
                                    <input type="text" name="mobile" class="form-control rounded-0" value="{{ old('mobile', $user->mobile) }}" placeholder="98xxxxxxxx">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Address</label>
                                    <input type="text" name="address" class="form-control rounded-0" value="{{ old('address', $user->address) }}" placeholder="Address">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="form-check-label mb-2" for="">Gender</label>
                                    <br>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" name="gender" class="form-check-input" value="male" @if($user->gender == 'male') checked @endif>Male
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" name="gender" class="form-check-input" value="female" @if($user->gender == 'female') checked @endif>Female
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" name="gender" class="form-check-input" value="other" @if($user->gender == 'other') checked @endif>Other
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Role</label>
                                    <select name="role" id="" class="form-control">
                                        @if(old('role', $user->role))
                                        <option value="{{ old('role', $user->role) }}" selected>{{ ucfirst(old('role', $user->role)) }}</option>
                                        @endif
                                        <option value="admin">Admin</option>
                                        <option value="manager">Manager</option>
                                        <option value="partner">Partner</option>
                                        <option value="courier">Courier</option>
                                        <option value="customer">Customer</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-6 form-group">
                                    <label for="">Password</label>
                                    <input type="text" name="password" class="form-control rounded-0">
                                </div>
                                
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-lg rounded-0 card-shadow">Update User</button>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function () {
        function readProfilePicURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#profilePicPreview').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        
        $("#profilePic").change(function(){
            readProfilePicURL(this);
        });
    });
</script>
@endpush
