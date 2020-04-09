@extends('layouts.app')

@push('styles')
<link href="https://fonts.googleapis.com/css?family=Sen&display=swap" rel="stylesheet">

<style>
    .login-form {
        font-family: 'Sen', sans-serif;
        box-shadow: 0 1px 3px 0 rgba(0,0,0,0.16),0 1px 6px 0 rgba(0,0,0,0.12) !important;
        background-color: #fff;
    }
    .login-form .head {
        padding: 15px 10px;
        background: linear-gradient(110deg, #30c5d7, #4edca7) !important;
        text-align:center;
    }
    .login-form .head .form-title {
        color: #fff;
        font-size: 32px;
        font-weight: 500;
    }
    .login-form .social-login{
        padding: 50px 15px;
    }
    .login-form .social-login .social-login-btn {
        padding: 15px 15px;
        margin: 10px;
        color: #fff;
        font-weight: 400;
    }
    .login-form .social-login .social-login-btn.facebook {
        background-color: #4267B2;
    }
    .login-form .social-login .social-login-btn.facebook:hover {
        background-color: #3558a1;
        box-shadow: 0 0 0 0.15rem rgba(0,123,255,.25)!important;
    }
    .login-form .social-login .social-login-btn.google {
        background-color: #DB4437;
    }
    .login-form .social-login .social-login-btn.google:hover {
        background-color: #c63f33;
        box-shadow: 0 0 0 0.15rem rgba(0,123,255,.25)!important;
    }
    .login-form .social-login .social-login-btn.facebook:focus,
    .login-form .social-login .social-login-btn.google:focus {
        box-shadow: 0 0 0 0.3rem rgba(0,123,255,.15)!important;
    }

    .login-form .separator {
        text-align: center;
        position: relative;
        z-index: 1;
    }
    .login-form .separator .or {
        padding: 10px;
        background-color: #fff;
        border: 1px solid #efefef;
        border-radius: 50%;
    }
    .login-form .separator:before {
        border-top: 1px solid #efefef;
        content: "";
        margin: 0 auto;
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        bottom: 0;
        width: 95%;
        z-index: -1;
    }

    .login-form .form{
        padding: 20px;
    }
    .login-form .form .form-group {
        margin-bottom: 25px;
    }
    .login-form .form-control{
        padding: 25px 20px;
    }
    #loginBtn:hover {
        box-shadow: 0 0 0 0.15rem rgba(0,123,255,.25)!important;
    }
    #loginBtn:focus {
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25)!important;
    }
</style>
@endpush

@section('content')
<div class="vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 mb-5 p-4">
                <div class="login-form">
                    <div class="head">
                        <div class="form-title">{{ __('Login') }}</div>
                    </div>
                    <div class="social-login">
                        <div class="d-flex justify-content-center">
                            <div class="flex-shrink-0">
                                <a href="{{ route('login.social', 'facebook') }}" class="social-login-btn facebook rounded-0 z-depth-0"><i class="fab fa-facebook-f mr-3"></i>Log in with Facebook</a>
                            </div>
                            <div class="flex-shrink-0">
                                <a href="{{ route('login.social', 'google') }}" class="social-login-btn google rounded-0 z-depth-0"><i class="fab fa-google mr-3"></i>Log in with Google</a>
                            </div>
                        </div>
                    </div>
                    <div class="separator">
                        <span class="or text-muted">OR</span>
                    </div>
                    <div class="form">
                        <form action="{{ route('login') }}" method="POST" class="form">
                            @csrf
                            <div class="form-group">
                                <input type="email" name="email" class="form-control rounded-0 @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Email Address" autocomplete="email" autofocus>

                                @error('email')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" name="password" class="form-control rounded-0 @error('password') is-invalid @enderror" autocomplete="current-password" placeholder="**your secure password**">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                            <hr class="my-4">
                            <div class="d-flex justify-content-between">
                                <div class="align-self-center">
                                    @if (Route::has('password.request'))
                                    <a class="text-muted" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                                    @endif
                                </div>
                                <div>
                                    <button id="loginBtn" type="submit" class="btn btn-primary rounded-0 z-depth-0">Log In</button>
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
