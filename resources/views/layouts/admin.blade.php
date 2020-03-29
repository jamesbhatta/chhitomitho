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
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">    
    @stack('styles')
    
</head>
<body>
    <div class="d-flex">
        <div class="side">
            <div class="py-4">
                {{-- <h2 class="text-uppercase text-center text-light">
                    <a href="{{ url('/') }}" target="_blank">
                    </a>
                </h2> --}}
                <div class="user-details">
                    <img class="rounded-circle mr-3" src="{{ Auth::user()->gravatar}}" alt="{{ __('Chhitomitho') }}" style="height: 80px; width: 80px; border-radius: 50%;">
                    <div class="name">{{ Auth::user()->name }}</div>
                    <div class="email">{{ Auth::user()->email }}</div>
                    <div class="role">( {{ Auth::user()->role }} )</div>
                </div>
            </div>
            <div class="text-muted text-uppercase small font-weight-bolder ml-2">Navigation</div>
            <ul class="list-unstyled sidebar-list">
                <li class="sidebar-list-item">
                    <a class="nav-link" href=""><i class="fas fa-desktop text-ink"></i>Dashboard <span><i class="fas fa-angle-right"></i></span></a>
                </li>
                <li class="sidebar-list-item">
                    <a class="nav-link" href="{{ route('category.index') }}"><i class="far fa-list-alt text-warning"></i>Categories<span><i class="fas fa-angle-right"></i></span></a>
                </li>
                <li class="sidebar-list-item">
                    <a class="nav-link" href="{{ route('product.create') }}"><i class="fa fa-plus text-info"></i>New Product<span><i class="fas fa-angle-right"></i></span></a>
                </li>
                <li class="sidebar-list-item">
                    <a class="nav-link" href="{{ route('product.index') }}"><i class="fas fa-cube text-primary"></i>Products<span><i class="fas fa-angle-right"></i></span></a>
                </li>
                <li class="sidebar-list-item">
                    <a class="nav-link" href="{{ route('users.index') }}"><i class="far fa-user text-secondary"></i>Users<span><i class="fas fa-angle-right"></i></span></a>
                </li>
                <li class="sidebar-list-item">
                    <a class="nav-link" href=""><i class="fas fa-grip-horizontal"></i>Forum<span><i class="fas fa-angle-right"></i></span></a>
                </li>
                <li class="sidebar-list-item">
                    <a class="nav-link" href=""><i class="far fa-star"></i>Features<span><i class="fas fa-angle-right"></i></span></a>
                </li>
                <li class="sidebar-list-item">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt mr-2"></i>{{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
        <div class="main">
            <div class="navbar navbar-expand-lg navbar-dark primary-color d-none">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href=""><i class="fa fa-cog"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href=""><i class="fa fa-bell"></i></a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt mr-2"></i>{{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                    <li class="nav-item d-flex">
                        <img class="rounded-circle mr-3" src="{{ Auth::user()->gravatar}}" alt="" style="height: 40px; width: 40px; border-radius: 50%;">
                        <div class="d-flex flex-column">
                            <div class="">{{ Auth::user()->name }}</div>
                            <div class="text-capitalize">{{ Auth::user()->role }}</div>
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto nav-flex-icons">
                    <li class="nav-item avatar">
                        <a class="nav-linkl" href="#">
                            <img class="rounded-circle mr-3" src="{{ Auth::user()->gravatar}}" alt="" style="height: 40px; width: 40px; border-radius: 50%;">
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card bg-primary rounded-0 d-none" style="box-shadow: 0 2px 2px 0 rgba(143, 143, 143, 0.05);">
                <div class="d-flex px-4">
                    <ul class="nav topbar-nav ml-auto ">
                        <li class="nav-item align-self-center">
                            <a class="nav-link" href=""><i class="fa fa-cog"></i></a>
                        </li>
                        <li class="nav-item align-self-center">
                            <a class="nav-link grey-text" href=""><i class="fa fa-bell"></i></a>
                        </li>
                        <li class="nav-item d-flex py-2 px-3 align-self-center">
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
