@extends('layouts.app')
@push('styles')
<style>
    #auth-email {
        background: url("{{ asset('assets/img/bg.webp') }}");
        width: 100%;
        min-height: 100vh;
        padding: 15px;
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
        font-family: 'Sen', sans-serif;
    }
    
    #auth-email .email-form-wrapper {
        min-height: 50vh;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
    }
    
    #auth-email .form-title {
        font-size: 28px;
        font-weight: 600;
        color: #555;
    }
</style>
@endpush
@section('content')
<div id="auth-email">
    <div class="container email-form-wrapper">
        <div class="row justify-content-center">
            <div class="card card-shadow">
                <div class="card-body py-4 px-sm-4 px-md-5">
                    <div class="form-title mb-4">{{ __('Reset Password') }}</div>
                    
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email" class="">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary card-shadow">
                                {{ __('Send Password Reset Link') }}
                            </button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
