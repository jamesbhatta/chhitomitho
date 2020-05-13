@extends('layouts.app')

@push('styles')
<style>
    #bottomMenu {
        display: none!important;
    }
    #login-page {
        background: url("{{ asset('assets/img/bg.webp') }}");
        width: 100%;
        min-height: 100vh;
        /* display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center; */
        padding: 15px;
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
        font-family: 'Sen', sans-serif;
    }
    .login-form {
        font-family: 'Sen', sans-serif;
        box-shadow: 0 1px 3px 0 rgba(0,0,0,0.16),0 1px 6px 0 rgba(0,0,0,0.12) !important;
        background-color: #fff;
        border-radius: 0.25rem;
    }
    .login-form .head {
        padding: 15px 10px;
        text-align:center;
    }
    .login-form .head .form-title {
        font-size: 32px;
        font-weight: 600;
        color: #555;
        text-align: center;
    }
    .login-form .social-login{
        padding: 10px 15px;
    }
    .login-form .social-login .social-login-btn {
        display: block;
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
<div id="login-page">
    {{-- <div class="container"> --}}
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="login-form">
                    <div class="head">
                        <div class="form-title">{{ __('Login') }}</div>
                    </div>
                    <div class="social-login">
                        <div class="d-flex flex-column flex-md-row justify-content-center">
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
                                <input type="password" name="password" class="form-control rounded-0 @error('password') is-invalid @enderror" autocomplete="current-password" placeholder="Type your password">
                                
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    
                                    <label class="form-check-label text-muted small" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                            <hr class="my-4">
                            <div class="d-flex flex-column-reverse flex-md-row justify-content-between">
                                <div class="align-self-center mt-3 mt-md-0">
                                    @if (Route::has('password.request'))
                                    <a class="text-muted pr-sm-0 pr-md-3" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }} <span class="text-primary">Reset Now</span></a>
                                    @endif
                                </div>
                                <div class="flex-fill flex-grow-1">
                                    <button id="loginBtn" type="submit" class="btn btn-primary btn-lg btn-block rounded-0 z-depth-0">Log In</button>
                                </div>
                            </div>
                        </form>
                        <div class="text-center mt-4">
                            <span class="text-muted">Don't have an account?</span> <a href="{{ route('register',) }}"><span class="border-bottom">Register</span></a>
                        </div>
                    </div>
                    
                </div>
            </div>
            
        </div>
    {{-- </div> --}}
</div>
@endsection
