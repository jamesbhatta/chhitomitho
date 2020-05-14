<style>
    #mobileSidebarModal {
        font-size: 16px;
        font-family: 'Sen', sans-serif;
    }
    #sidebarNav {
        font-weight: 400;
    }
    #sidebarNav .nav-link {
        color: #141823;
    }
    #sidebarNav .nav-link .nav-icon {
        min-width: 40px;
        margin-right: 25px;
        color: #FC7A1E;
        font-size: 0.9em;
    }
</style>
<div class="modal fade left" id="mobileSidebarModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-height modal-left mt-0 ml-0" role="document" style="width: 75%;">
        <div class="modal-content vh-100">
            @auth
            <div class="bg-secondary-color text-white p-3">
                <div class="d-flex">
                    <div class="d-flex flex-column">
                        <img src="{{ Auth::user()->gravatar }}" alt="" style="width: 80px; height: 80px; border-radius: 50%;">
                        @if(Auth::user()->isVerified())
                        <div class="badge badge-pill badge-success z-depth-0 mt-2">Verified</div>
                        @endif
                    </div>
                    <div class="w-100 align-self-center px-2">
                        <div class="">{{ Auth::user()->name }}</div>
                        <div class="small">{{ Auth::user()->mobile }}</div>
                        <div class="small">{{ Auth::user()->email }}</div>
                    </div>
                </div>
            </div>
            @endauth
            <div class="modal-body px-0">
                <nav id="sidebarNav" class="nav flex-column">
                    @guest
                    <a class="nav-link" href="{{ route('login') }}">
                        <span class="nav-icon"><i class="fas fa-sign-in-alt"></i></span>{{ __('Login') }}
                    </a>
                    @if (Route::has('register'))
                    <a class="nav-link" href="{{ route('register') }}">
                        <span class="nav-icon"><i class="fas fa-user-plus"></i></span>{{ __('Register') }}
                    </a>
                    @endif
                    @else
                    @can('access-backend')
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        <span class="nav-icon"><i class="fas fa-chart-line"></i></span> {{ __('Dashboard') }}
                    </a>
                    @endcan
                    <a class="nav-link" href="{{ route('customer.orders') }}?filter=unreceived">
                        <span class="nav-icon"><i class="fas fa-clipboard-check"></i></span> {{ __('My orders') }}
                    </a>
                    <a class="nav-link" href="{{ route('user.profile') }}">
                        <span class="nav-icon"><i class="fas fa-user"></i></span> {{ __('Manage account') }}
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span class="nav-icon"><i class="fas fa-power-off"></i></span> {{ __('Logout') }}
                    </a>
                    @endguest
                    <div class="dropdown-divider"></div>
                    <a class="nav-link" href="{{ route('page.privacy_policy') }}">
                        <span class="nav-icon"><i class="fas fa-unlock-alt"></i></span> {{ __('Privacy policy') }}
                    </a>
                    <a class="nav-link" href="{{ route('page.privacy_policy') }}">
                        <span class="nav-icon"><i class="far fa-list-alt"></i></span> {{ __('Terms of service') }}
                    </a>
                </nav>
            </div>
        </div>
    </div>
</div>