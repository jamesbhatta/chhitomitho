@extends('layouts.app')

@push('styles')
<style>
    #auth-reset {
        background: url("{{ asset('assets/img/bg.webp') }}");
        width: 100%;
        min-height: 100vh;
        padding: 15px;
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
        font-family: 'Sen', sans-serif;
    }
    
    #auth-reset .form-title {
        font-size: 28px;
        font-weight: 600;
        color: #555;
    }
</style>
@section('content')
<div id="auth-reset">
    <div class="container password-reset-form-wrapper">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card my-4">
                    <div class="card-body py-4 px-sm-4 px-md-5">
                        <div class="form-title mb-4">{{ __('Reset Password') }}</div>
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            
                            <div class="form-group">
                                <label for="email" class="form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control rounded-0 @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="password" class="form-label text-md-right">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control rounded-0 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="password-confirm" class="form-label text-md-right">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control rounded-0" name="password_confirmation" required autocomplete="new-password">
                            </div>
                            
                            <div class="form-group mb-0">
                                <button type="submit" class="btn btn-primary card-shadow">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
