<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link href="{{ asset('assets/mdb/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/mdb/css/mdb.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/mdb/css/style.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('assets/img/logo.png') }}">
    <style>
        .custom-table thead {
            background-color: #e8e8e8;
            background-color: #eee;
        }
        
        .custom-table thead th {
            color: #656565;
            color: #6c757d;
            text-transform: uppercase;
            font-size: 0.8em;
        }
        
    </style>
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
        
        .card-shadow {
            box-shadow: 0 0px 15px 2px rgba(143, 143, 143, 0.09);
        }
        
        .bg-ink {
            background-color: #667bf1;
        }
        
        .text-ink {
            color: #667bf1;
        }
        
        .bg-green {
            background-color: #24e873;
        }
        
        .text-green {
            color: #24e873;
        }
        
        .bg-red {
            background-color: #fc5d51;
        }
        
        .text-red {
            color: #fc5d51;
        }
        
        .side {
            flex: 15%;
            background-color: #384951;
            height: 100vh;
            position: sticky;
            top: 0;
            align-self: flex-start
        }
        
        @media only screen and (max-width: 800px) {
            .side {
                background-color: #fff;
                display: none;
                width: 100%;
                flex: 100%;
                position: absolute: top: 0;
                right: 0;
            }
            
            .main {
                flex: 100%;
            }
        }
        
        .main {
            flex: 85%;
            background-color: #f9f9f9;
        }
        
        .sidebar-list {
            font-weight: 400;
        }
        
        .sidebar-list-item {
            /*margin-top: 10px;*/
            margin-bottom: px;
        }
        
        .sidebar-list-item a {
            color: #cbc9c9;
        }
        
        .sidebar-list-item a:hover {
            color: #fff;
            color: #25c3ca;
        }
        
        .sidebar-list-item a i {
            margin-right: 15px;
        }
        
        .sidebar-list-item a span {
            float: right;
        }
        
        .topbar-nav {
            color: #667bf1;
        }
        
        .topbar-nav i {
            color: #667bf1;
        }
        
        #dashboard {
            color: #929394;
        }
        
        h5.page-title {
            font-weight: 500;
            color: #598aa3;
            color: #929394;
        }
        
        .pagination .page-item.active .page-link {
            box-shadow: none;
        }
        
    </style>
    
    @stack('styles')
    
</head>
<body>
    <div class="d-flex">
        <div class="side pl-4">
            <div class="py-4">
                <h2 class="text-uppercase text-center text-light">
                    <a href="{{ url('/') }}" target="_blank">
                        <img src="{{ asset('assets/img/logo-white.png') }}" alt="{{ __('Chhitomitho') }}" style="height: 60px;">
                    </a>
                </h2>
            </div>
            <div class="text-light text-uppercase small font-weight-bolder">Navigation</div>
            <ul class="list-unstyled sidebar-list">
                <li class="sidebar-list-item">
                    <a class="nav-link" href=""><i class="fas fa-tachometer-alt"></i>Dashboard <span><i class="fas fa-angle-right"></i></span></a>
                </li>
                <li class="sidebar-list-item">
                    <a class="nav-link" href="{{ route('category.index') }}"><i class="far fa-list-alt"></i>Categories<span><i class="fas fa-angle-right"></i></span></a>
                </li>
                <li class="sidebar-list-item">
                    <a class="nav-link" href="{{ route('product.create') }}"><i class="fa fa-plus"></i>New Product<span><i class="fas fa-angle-right"></i></span></a>
                </li>
                <li class="sidebar-list-item">
                    <a class="nav-link" href="{{ route('product.index') }}"><i class="fas fa-cube"></i>Products<span><i class="fas fa-angle-right"></i></span></a>
                </li>
                <li class="sidebar-list-item">
                    <a class="nav-link" href="{{ route('users.index') }}"><i class="far fa-user"></i>Users<span><i class="fas fa-angle-right"></i></span></a>
                </li>
                <li class="sidebar-list-item">
                    <a class="nav-link" href=""><i class="fas fa-grip-horizontal"></i>Forum<span><i class="fas fa-angle-right"></i></span></a>
                </li>
                <li class="sidebar-list-item">
                    <a class="nav-link" href=""><i class="far fa-star"></i>Features<span><i class="fas fa-angle-right"></i></span></a>
                </li>
            </ul>
        </div>
        <div class="main">
            <div class="card rounded-0" style="box-shadow: 0 2px 2px 0 rgba(143, 143, 143, 0.05);">
                <div class="d-flex px-4">
                    <ul class="nav topbar-nav ml-auto ">
                        <li class="nav-item align-self-center">
                            <a class="nav-link" href=""><i class="fa fa-cog"></i></a>
                        </li>
                        <li class="nav-item align-self-center">
                            <a class="nav-link grey-text" href=""><i class="fa fa-bell"></i></a>
                        </li>
                        <li class="nav-item d-flex py-2 px-3 align-self-center" style="background-color: #f8f6ff;">
                            <img class="rounded-circle mr-3" src="{{ Auth::user()->gravatar}}" alt="" style="height: 40px; width: 40px; border-radius: 50%;">
                            <div class="d-flex flex-column">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="text-capitalize">{{ Auth::user()->role }}</div>
                            </div>
                        </li>
                        <li class="nav-item align-self-center">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt mr-2"></i>{{ __('Logout') }}
                            </a>
                            
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            @yield('content')
        </div>
    </div>
    
    <script type="text/javascript" src="{{ asset('assets/mdb/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/mdb/js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/mdb/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/mdb/js/mdb.min.js') }}"></script>
    
    @stack('scripts')
    
</body>
</html>
