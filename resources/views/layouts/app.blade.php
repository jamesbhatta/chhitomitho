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
			background-color: #f2f7fb;
		}
		*:focus {
			outline: none;
		}
		.bg-theme-color {
			/* background-color: #982121; */
			background-color: #dd3e52;
		}
		.text-theme-color {
			color: #982121;
		}
		.bg-secondary-color {
			/* background-color: #28a745; */
			background-color: #FC7A1E;
		}
		.text-secondary-color {
			color: #28a745;
		}
		.card-shadow {
			box-shadow: 0 0px 15px 2px rgba(143, 143, 143, 0.09);
		}
		.custom-navbar {
			/* background-color: #982121!important; */
			background-color: #dd3e52!important;
			/* color: #f1f1f1!important; */
			font-family: 'Sen', sans-serif;
		}
		.custom-navbar .navbar-brand {
			/* color: #f1f1f1!important; */
			font-family: 'Permanent Marker', cursive;
		}
		.custom-navbar .nav-item .nav-link {
			/* color: #f1f1f1!important; */
		}
		.custom-navbar .dropdown-menu {
			margin-top: 5px!important;
			border-radius: 0;
		}
		.custom-navbar .dropdown-menu:before {
			content: "";
			border-bottom: 10px solid #fff;
			border-right: 10px solid transparent;
			border-left: 10px solid transparent;
			position: absolute;
			top: -10px;
			right: 16px;
			z-index: 10;
		}
		.custom-navbar .dropdown-menu a {
			color: #535b61;
			padding: .25rem 1.5rem;
		}
		
		[v-cloak] {
			display: none;
		}
		
		.text-strike {
			text-decoration: line-through;
		}
		
		/*=================
		** Floating Cart
		**================*/
		
		#floating-cart {
			position: fixed;
			bottom: 20px;
			right: 20px;
			z-index: 100;
			width: auto;
			padding: 15px 20px;
			background-color: #FC7A1E;
			display: none;
			font-family: 'Sen', sans-serif;
		}
		#floating-cart-wrapper .dropdown-menu {
			border: 0.8px solid #FC7A1E;
			font-family: 'Sen', sans-serif;
		}
		#floating-cart-wrapper .dropdown-menu:before {
			content: "";
			border-top: 10px solid #FC7A1E;
			border-right: 10px solid transparent;
			border-left: 10px solid transparent;
			position: absolute;
			bottom: -10px;
			right: 16px;
			z-index: 10;
		}
		#floating-cart svg{
			font-size: 1.5rem;
			fill: #fff;
		}
		#floating-cart .cart-quantity {
			position: absolute;
			top: -10px;
			right: -15px;
			background-color: #ff3547;
			color: #fff; padding: 5px 8px;
			min-height:15px;
			min-width: 15px;
			border-radius: 50%;
			font-size: 0.6rem;
		}
		#floating-cart .cart-price {
			margin-left: 20px;
			color: #fff;
			font-size: 0.8rem;
		}
	</style>
	
	{{--
		Theme color Brown: #982121
		Secondary Color: #ffb80e
		--}}
	</head>
	<body>
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
									<span id="cart-total-quantity" class="badge badge-pill badge-info card-shadow mr-1"></span>
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
									<img class="d-inline" src="{{ Auth::user()->gravatar }}" alt="" style="width: 30px; height:30px; border-radius: 50%;">
									{{ Auth::user()->name }} <span class="caret"></span>
								</a>
								<div class="dropdown-menu dropdown-menu-right card-shadow" aria-labelledby="navbarDropdown">
									@can('access-backend')
									<a class="dropdown-item" href="{{ route(Auth::user()->role) }}">{{ __('Dashboard') }}</a>
									@endcan
									<a class="dropdown-item" href="{{ route('customer.orders') }}?filter=unreceived">{{ __('My Orders') }}</a>
									<a class="dropdown-item" href="{{ route('user.profile') }}">{{ __('My Profile') }}</a>
									<div class="dropdown-divider"></div>
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
			
			<main>
				@yield('content')
			</main>
			
			<x-footer></x-footer>
			
			<div id="floating-cart-wrapper" class="dropup" v-cloak>
				<div id="floating-cart" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<div style="position: relative; display: inline;">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" style="fill: #fff;" viewBox="0 0 24 24"><path d="M10 19.5c0 .829-.672 1.5-1.5 1.5s-1.5-.671-1.5-1.5c0-.828.672-1.5 1.5-1.5s1.5.672 1.5 1.5zm3.5-1.5c-.828 0-1.5.671-1.5 1.5s.672 1.5 1.5 1.5 1.5-.671 1.5-1.5c0-.828-.672-1.5-1.5-1.5zm1.336-5l1.977-7h-16.813l2.938 7h11.898zm4.969-10l-3.432 12h-12.597l.839 2h13.239l3.474-12h1.929l.743-2h-4.195z"/></svg>
						<span class="cart-quantity">0</span>
					</div>
					<span class="cart-price"></span>
				</div>
				<div class="dropdown-menu dropdown-menu-right rounded-0 mb-3" aria-labelledby="floating-cart">
					<div class="p-3">
						<h4 class="h4-responsive text-right">@{{ cartTitle }}</h4>
						<table class="table table-borderless table-sm">
							<tr v-for="item in items">
								<td>
									<i v-on:click="removeCartItem(item.rowId, 0)" class="fa fa-times fa-sm text-danger mr-2"></i>@{{ item.name }}
								</td>
								<td class="text-right">@{{ item.qty }} x Rs. @{{ item.price }}</td>
							</tr>
							<tr>
								<td colspan="2" class="text-right">Total Rs. @{{ priceTotal }}</td>
							</tr>
						</table> 
						<div class="dropdown-divider"></div>
						<a class="btn bg-secondary-color text-white btn-sm text-capitalize card-shadow rounded-0" href="{{ route('cart') }}">View Cart</a>
						<a class="btn bg-secondary-color text-white btn-sm text-capitalize card-shadow rounded-0" href="{{ route('checkout.index') }}">Checkout</a>
					</div>
				</div>
			</div>
			
			
		</div>
		
		{{-- Scripts --}}
		<script type="text/javascript" src="{{ asset('assets/mdb/js/jquery.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('assets/mdb/js/popper.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('assets/mdb/js/bootstrap.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('assets/mdb/js/mdb.min.js') }}"></script>
		<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
		
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
								$('#cart-total-quantity').html(totalQty);
								$('#cart-total-price').html('Rs. ' + totalPrice);
								
								$('#floating-cart').show();
								$('#floating-cart .cart-quantity').html(totalQty);
								$('#floating-cart .cart-price').html('Rs. ' + totalPrice);
							},
							error: function (data) {
							},
							complete: function () {
								floatingCart.fetchCartItems();
							}
						});
					}
				}
				
				var floatingCart = new Vue({
					el: '#floating-cart-wrapper',
					data: {
						cartTitle: 'Cart',
						items: null,
						priceTotal: 0,
					},
					mounted() {
						// this.fetchCartItems();
					},
					methods: {
						formatMoney: function (number) {
							return new Intl.NumberFormat('en-IN', { maximumSignificantDigits: 3 }).format(number)
						},
						fetchCartItems: function() {
							axios.get('{{ route('cart.items') }}')
							.then(response => {
								console.log(response.data.items);
								if(response.status == 200) {
									this.items = response.data.items;
									this.priceTotal = response.data.priceTotal;
								}
							})
							.catch(function (error) {
								console.log(error);
							})
							.then(function () {
							});
						},
						
						removeCartItem: function(rowId, quantity) {
							axios.post("{{ route('cart.update') }}", {
								rowId: rowId,
								quantity: quantity
							})
							.then(function (response) {
								console.log(response);
							})
							.catch(function (error) {
								console.log(error);
							}).then(function () {
								App.loadCartSummary();
							});  
						}
						
					}
				});
				
				// initialize cart
				App.loadCartSummary();	
				
			});
		</script>
		
		@stack('scripts')
		
	</body>
	</html>
	