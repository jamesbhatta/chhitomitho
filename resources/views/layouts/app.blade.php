<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>{{ config('app.name', 'Chhitomitho') }}</title>
	<link rel="icon" href="{{ asset('assets/img/logo.png') }}">
	<!-- Fonts -->
	<link rel="dns-prefetch" href="//fonts.gstatic.com">

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
	<link href="{{ asset('assets/mdb/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/mdb/css/mdb.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/mdb/css/style.css') }}" rel="stylesheet">

	@stack('styles')
	<link href="https://fonts.googleapis.com/css?family=Lora&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Permanent+Marker&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Sen&display=swap" rel="stylesheet">

	<style>
		html {
			scroll-behavior: smooth;
		}
		body {
			box-sizing: border-box;
			font-family: 'Lora', serif;
		}
		.bg-theme-color {
			background-color: #982121;
		}
		.text-theme-color {
			color: #982121;
		}
		.bg-secondary-color {
			background-color: #28a745;
		}
		.text-secondary-color {
			color: #28a745;
		}
		.custom-navbar {
			background-color: #982121!important;
			color: #f1f1f1!important;
		}
		.custom-navbar .navbar-brand {
			color: #f1f1f1!important;
			font-family: 'Permanent Marker', cursive;
		}
		.custom-navbar .nav-item .nav-link {
			color: #f1f1f1!important;
		}
	</style>

	{{--
		Theme color Brown: #982121
		Secondary Color: #ffb80e
		--}}
	</head>
	<body class="grey lighten-5">
		<div id="app">
			<nav class="navbar navbar-expand-md navbar-dark custom-navbar shadow-sm">
				<div class="container">
					<a class="navbar-brand" href="{{ url('/') }}">
						<img class="img-fluid" src="{{ asset('assets/img/logo-white.png') }}" alt="" style="height: 40px; width: 40px;">
						{{ config('app.name', 'Laravel') }}
					</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
						<span class="navbar-toggler-icon"></span>
					</button>

					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<!-- Left Side Of Navbar -->
						<ul class="navbar-nav mr-auto">

						</ul>

						<!-- Right Side Of Navbar -->
						<ul class="navbar-nav ml-auto">
							<li class="nav-item">
								<a class="nav-link" href="{{ route('cart') }}">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" style="fill: #f1f1f1;" viewBox="0 0 24 24"><path d="M10 19.5c0 .829-.672 1.5-1.5 1.5s-1.5-.671-1.5-1.5c0-.828.672-1.5 1.5-1.5s1.5.672 1.5 1.5zm3.5-1.5c-.828 0-1.5.671-1.5 1.5s.672 1.5 1.5 1.5 1.5-.671 1.5-1.5c0-.828-.672-1.5-1.5-1.5zm1.336-5l1.977-7h-16.813l2.938 7h11.898zm4.969-10l-3.432 12h-12.597l.839 2h13.239l3.474-12h1.929l.743-2h-4.195z"/></svg>
									<span id="cart-total-quantity" class="badge badge-pill badge-info mr-1"></span>
									<span id="cart-total-price" class="small"></span>
								</a>
							</li>
							<!-- Authentication Links -->
							@guest
							<li class="nav-item">
								<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
							</li>
							@if (Route::has('register'))
							<li class="nav-item">
								<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
							</li>

							@endif
							@else
							<li class="nav-item dropdown">
								<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
									<img src="{{ Auth::user()->avatar }}" alt="" style="width: 40px; height:40px; border-radius: 50%;">
									{{ Auth::user()->name }} <span class="caret"></span>
								</a>

								<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
									<a class="dropdown-item" href="{{ route(Auth::user()->role) }}">{{ __('Dashboard') }}</a>
									<a class="dropdown-item" href="{{ route('customer.orders') }}">{{ __('My Orders') }}</a>
									<a class="dropdown-item" href="{{ route('user.profile') }}">{{ __('My Profile') }}</a>
									<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
										{{ __('Logout') }}
									</a>

									<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
										@csrf
									</form>
								</div>
							</li>
							@endguest
						</ul>
					</div>
				</div>
			</nav>

			<main class="py-4">
				@yield('content')
			</main>
		</div>

		{{-- Scripts --}}
		<script type="text/javascript" src="{{ asset('assets/mdb/js/jquery.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('assets/mdb/js/popper.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('assets/mdb/js/bootstrap.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('assets/mdb/js/mdb.min.js') }}"></script>
		<script>
			$(document).ready(function() {
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});

				App = {
					loadCartSummary: function() {
						$.ajax({
							url: '{{ route('cart.items.summary') }}',
							method: 'GET',
							success: function (data) {
								var totalQty = 0;
								var totalPrice = 0;
								if (data.status == 200) {
									totalQty = data.totalQuantity;
									totalPrice = data.totalPrice;
								}
								$('#cart-total-quantity').html(totalQty)
								$('#cart-total-price').html(totalPrice)
							},
							error: function (data) {
							}
						});
					}
				}
				App.loadCartSummary();
			});
		</script>

		@stack('scripts')

	</body>
	</html>
