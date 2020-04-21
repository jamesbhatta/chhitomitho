@extends('layouts.app')

@push('styles')
<style>
    #profile-page {
        font-family: 'Sen', sans-serif;
    }
    .profile-picture-section {
        text-align: center;
        margin-bottom: 30px;
        font-family: 'Sen', sans-serif;
    }
    .profile-pic-container { 
        width: 200px;
        height: 200px;
        margin: auto auto;
        position: relative;
    }
    .profile-pic-container img {
        width: 200px;
        height: 200px;
        border: 1px solid #eaeaee;
    }
    
    .profile-picture-section .change-label {
        position: absolute;
        bottom: 0;
        left: 10px;
        padding: 5px 10px;
        border-radius: 5px;
        background-color: #24292e;
        color: #fff;
        font-size: 0.8em;
        cursor: pointer;
    }
</style>
@endpush

@section('content')
<div id="profile-page" class="container">
    <div class="card rounded-0 p-4 card-shadow">
        @include('partials.alerts')
        
        <div class="row">
            <div class="col-md-4">
                <div class="profile-picture-section">
                    <form id="image-update-form" action="" enctype="multipart/form-data" method="post">
                        @csrf
                        {{-- <div class="mb-2">Profile picture</div> --}}
                        <div class="profile-pic-container">
                            <img id="profilePicPreview" class="img-fluid img- rounded" src="{{ Auth::user()->gravatar }}" alt="{{ Auth::user()->name }}">
                            <label for="profilePic" class="change-label" for=""><i class="fa fa-camera mr-2"></i> Change</label>
                        </div>
                        <input type="file" id="profilePic" name="profile_pic" hidden>
                        <div id="pic-updated" class="my-3 text-success d-none"><i class="far fa-check-circle"></i> Changed</div>
                    </form>
                </div>
            </div>
            <div class="col-md-8 text-muted">
                <div class="mb-4">
                    <h4 class="h4-responsive font-weight-normal">User Information</h4>
                    <hr>
                    <div class="p-3">
                        <form id="test-form" action="{{ route('user.profile.update', Auth::user()) }}" method="POST" enctype="multipart/form-data" class="form">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <div class="md-form">
                                        <i class="far fa-user prefix"></i>
                                        <input type="text" id="name" name="name" class="form-control" value="{{ Auth::user()->name }}">
                                        <label for="name">Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <div class="md-form">
                                        <i class="far fa-envelope prefix"></i>
                                        <input type="text" id="email" name="email" class="form-control" value="{{ Auth::user()->email }}" readonly="true">
                                        <label for="email">Email</label>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <div class="md-form">
                                        <i class="fas fa-mobile-alt prefix"></i>
                                        <input type="text" id="mobile" name="mobile" class="form-control" maxlength="10" pattern="[7-9]{1}[0-9]{9}" value="{{ old('mobile', Auth::user()->mobile) }}" placeholder="98xxxxxxxx" aria-describedby="moibleHelpBlock">
                                        <label for="mobile">Mobile</label>
                                        <small id="mobileHelpBlock" class="form-text text-muted">
                                           Must be a 10 digit mobile number
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <div class="md-form">
                                        <i class="fas fa-map-marker-alt prefix"></i>
                                        <input type="text" id="address" name="address" class="form-control" value="{{ old('address', Auth::user()->address) }}">
                                        <label for="address">Address</label>
                                    </div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="" class="small">Gender</label>
                                    <br>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" name="gender" class="custom-control-input" id="radio-male"  value="male" @if(Auth::user()->gender == 'male') checked @endif>
                                        <label class="custom-control-label" for="radio-male">Male</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" name="gender" class="custom-control-input" id="radio-female" value="female" @if(Auth::user()->gender == 'female') checked @endif>
                                        <label class="custom-control-label" for="radio-female">Female</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" name="gender" class="custom-control-input" id="radio-other" value="other" @if(Auth::user()->gender == 'other') checked @endif>
                                        <label class="custom-control-label" for="radio-other">Other</label>
                                    </div>
                                </div>
                                
                                <div class="col-md-12 d-flex">
                                    <button type="submit" class="btn btn-secondary btn-lg rounded card-shadow text-capitalize">Update profile</button>
                                    {{-- <button class="btn btn-secondary btn-lg rounded-0 card-shadow ml-auto text-capitalize">Account Verification</button> --}}
                                </div>
                                
                            </div>
                        </form>
                    </div>
                </div>
                {{-- End of User Info Update --}}
                <div class="mb-4">
                    <h4 class="h4-responsive font-weight-normal">Change password</h4>
                    <hr>
                    <div class="p-3">
                        <form action="{{ route('user.password.update', Auth::user()->id) }}" method="POST" class="form">
                            @csrf
                            @method('put')
                            <div class="form-row">
                                <div class="form-group col-md-8">
                                    <label for="inputOldPassword">Old password</label>
                                    <input type="password" id="inputOldPassword" name="old_password" class="form-control" minlength="8" maxlength="20">
                                </div>
                                <div class="form-group col-md-8">
                                    <label for="inputPassword">Password</label>
                                    <input type="password" id="inputPassword" name="password" class="form-control" minlength="8" maxlength="20" aria-describedby="passwordHelpBlock">
                                    <small id="passwordHelpBlock" class="form-text text-muted">
                                        Your password must be 8-20 characters long and must not contain spaces,
                                        special characters,
                                        or emoji.
                                    </small>
                                </div>
                                <div class="form-group col-md-8">
                                    <label for="inputPasswordConfirmation">Confirm new password</label>
                                    <input type="password" id="inputPasswordConfirmation" name="password_confirmation" class="form-control" minlength="8" maxlength="20">
                                </div>
                                <div class="form-group col-12">
                                    <button type="submit" class="btn btn-secondary btn-lg rounded card-shadow text-capitalize">Update password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
        {{-- End of row --}}
    </div>
    {{-- End of card --}}
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
            
            fd = new FormData(document.getElementById('image-update-form'));
            console.log(fd);
            $.ajax({
                type: "post",
                contentType: false,
                processData: false,
                cache: false,
                url: "{{ route('ajax.user.profile.pic.update', Auth::user()) }}",
                data: fd,
                success: function (response) {
                    $('#pic-updated').removeClass('d-none');
                    $('#profilePicPreview').attr('src', response.url);
                },
            });
        });
        
    });
</script>
@endpush