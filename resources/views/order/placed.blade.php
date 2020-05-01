@extends('layouts.app')

@push('styles')
<style>
    #order-placed-page {
        font-family: 'Sen', sans-serif;
    }
    
    .order-placed-container {
        width: 300px;
        margin: 20px auto;
        padding: 15px;
    }
    
    .order-placed-container  svg{
        width: 200px;
    }
    
    @media only screen and (max-width: 600px) {
        .order-placed-container  svg{
            width: 100px;
        }
    }
    
</style>
@endpush
@section('content')
<div id="order-placed-page" class="container py-3">
    <div class="card border rounded-0">
        <div class="card-body text-center">
            <div class="order-placed-container">
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                viewBox="0 0 100.353 100.353" style="enable-background:new 0 0 100.353 100.353;" xml:space="preserve">
                <g>
                    <path style="fill:#7ac400;" d="M96.747,39.242c-0.186-0.782-0.97-1.265-1.755-1.079c-0.782,0.187-1.265,0.972-1.078,1.754
                    c0.766,3.212,1.155,6.604,1.155,10.083c0,24.85-20.67,45.067-46.078,45.067S2.913,74.85,2.913,50
                    c0-24.852,20.67-45.07,46.078-45.07c10.119,0,19.785,3.202,27.952,9.26c0.644,0.479,1.558,0.344,2.037-0.302
                    s0.344-1.558-0.302-2.037C70.006,5.417,59.74,2.018,48.991,2.018C21.977,2.018,0,23.542,0,50c0,26.456,21.977,47.98,48.991,47.98
                    c27.014,0,48.991-21.524,48.991-47.98C97.982,46.295,97.566,42.676,96.747,39.242z"/>
                    <path style="fill:#7ac400;" d="M47.98,71.683c-0.386,0-0.756-0.153-1.03-0.426L19.637,43.948c-0.569-0.569-0.569-1.491,0-2.06
                    c0.568-0.569,1.49-0.569,2.059,0l26.223,26.219l49.538-55.486c0.536-0.6,1.456-0.652,2.056-0.116s0.652,1.456,0.117,2.056
                    L49.066,71.197c-0.267,0.299-0.645,0.475-1.045,0.486C48.007,71.683,47.994,71.683,47.98,71.683z"/>
                </g>
            </svg>
            
        </div>
        <div class="mb-4">
            <div class="text-muted mb-2">Hey Jane Doe,</div>
            <h3 class="h3-responsive font-weight-bold">Your order is placed!</h3>
            <div class="text-muted">We will notify you via SMS as soon as there is any progress in your order.</div>
            <br>
            <a class="btn bg-secondary-color text-white card-shadow rounded-0" href="{{ route('customer.orders') }}">Check Status</a>
        </div>
    </div>
</div>
</div>
@endsection