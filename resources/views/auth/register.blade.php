@extends('layouts.app')

@push('styles')
<style>
     #bottomMenu {
        display: none!important;
    }
    #auth-register {
        background: url("{{ asset('assets/img/bg.webp') }}");
        width: 100%;
        min-height: 100vh;
        padding: 15px;
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
        font-family: 'Sen', sans-serif;
    }
    #auth-register .form-title {
        font-size: 28px;
        font-weight: 600;
        color: #555;
        text-align: center;
    }
    .btn-social {
        font-size: 16px;
        line-height: 1.2;
        padding: 15px;
        width: calc((100% - 20px)/2);
        border-radius: 8px;
        box-shadow: 0 1px 5px 0 rgba(0,0,0,.2);
        -webkit-transition: all .4s;
        transition: all .4s;
        margin-bottom: 10px;
        color: #fff;
        text-align: center;
    }
    .btn-social > i {
        margin-right: 15px;
    }
    .btn-facebook {
        background-color: #4267B2;
        margin-right: 10px;
    }
    .btn-google {
        background-color: #DB4437;
    }
    .btn-social:hover {
        background: linear-gradient(45deg,#00dbde,#fc00ff);
        color: #fff;
    }
    
    #register-card i.prefix {
        color: #b33ff6;
        top: auto;
        bottom: 0.25rem!important;
    }
    #registerBtn {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 0 20px;
        width: 100%;
        height: 60px;
        background-color: #333;
        border-radius: 10px;
        font-size: 16px;
        color: #fff;
        line-height: 1.2;
        -webkit-transition: all .4s;
        -o-transition: all .4s;
        -moz-transition: all .4s;
        transition: all .4s;
        position: relative;
        z-index: 1;
        outline: none;
        border: none;
    }
    
    #registerBtn:hover {
        background: linear-gradient(45deg,#00dbde,#fc00ff);
    }
    a.login-link {
        color: inherit;
        border-bottom: 1px solid #ccc;
    }
    a.login-link:hover {
        color: #ba3bf6;
    }
    @media (max-width: 576px) {
        .btn-social {
            width: 100%;
        }
    }
    
    @media (min-width: 576px) {
        #register-card {
            max-width: 500px;
        }
        .btn-social {
            width: 100%;
        }
    }
</style>
@endpush
@section('content')
<div id="auth-register">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div id="register-card" class="card z-depth-0  mx-auto mt-sm-3 mt-md-4">
                <div class="card-body py-4 px-sm-4 px-md-5">
                    <div class="form-title mb-4">Create An Account</div>
                    @include('partials.alerts')
                    <div class="d-flex flex-sm-row flex-column justify-content-between my-3">
                        <a class="btn-social btn-facebook" href="{{ route('login.social', 'facebook') }}">
                            <i class="fab fa-facebook-square"></i>Facebook
                        </a>
                        <a class="btn-social btn-google" href="{{ route('login.social', 'google') }}"><i class="fab fa-google"></i>Google</a>
                    </div>
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="md-form">
                            <i class="far fa-user prefix"></i>
                            <input type="text" id="name" name="name" class="form-control form-control-sm validate @error('name') is-invalid @enderror" value="{{ old('name') }}">
                            <label for="name" data-error="wrong" data-success="right">Name</label>
                            
                        </div>
                        <div class="md-form">
                            <i class="far fa-envelope prefix"></i>
                            <input type="email" id="email" name="email" class="form-control form-control-sm validate @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">
                            <label for="email" data-error="wrong" data-success="right">Email</label>
                        </div>
                        <div class="md-form">
                            <i class="fas fa-unlock-alt prefix"></i>
                            <input type="password" id="password" name="password" class="form-control form-control-sm validate @error('password') is-invalid @enderror" minlength="8"   name="password" autocomplete="new-password">
                            <label for="password" data-error="wrong" data-success="right">Password</label>
                        </div>
                        <div class="md-form">
                            <i class="fas fa-unlock-alt prefix"></i>
                            <input type="password" id="confirm_password" name="password_confirmation" class="form-control form-control-sm validate" minlength="8" autocomplete="new-password">
                            <label for="confirm_password" data-error="wrong" data-success="right">Confirm Password</label>
                        </div>
                        <div class="form-group">
                            <button id="registerBtn" type="submit">Register</button>
                        </div>
                    </form>
                    <div class="text-center text-muted">
                        <span>Already a member?</span><span> <a href="{{ route('login') }}" class="login-link"> Login</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
