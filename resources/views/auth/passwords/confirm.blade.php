@extends('layouts.app')

@push('styles')
<style>
    #auth-confirm {
        background: url("{{ asset('assets/img/bg.webp') }}");
        width: 100%;
        min-height: 100vh;
        padding: 15px;
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
        font-family: 'Sen', sans-serif;
    }
    
    #auth-confirm .email-form-wrapper {
        min-height: 50vh;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
    }
    
    #auth-confirm .form-title {
        font-size: 28px;
        font-weight: 600;
        color: #555;
    }
</style>
@section('content')
<div id="auth-confirm">
    <div class="container password-confirm-form-wrapper">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-shadow">
                    <div class="card-body py-4 px-sm-4 px-md-5">
                        <div class="form-title mb-4">{{ __('Confirm Password') }}</div>
                        <div class="my-3">
                            {{ __('Please confirm your password before continuing.') }}
                        </div>
                        <form method="POST" action="{{ route('password.confirm') }}">
                            @csrf
                            
                            <div class="form-group">
                                <label for="password" class="form-label text-md-right">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            
                            <div class="form-group mb-0">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Confirm Password') }}
                                </button>
                            </div>
                            @if (Route::has('password.request'))
                            <div class="text-center">
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
