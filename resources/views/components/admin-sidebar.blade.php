<div class="py-4">
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
    {{-- @if(Auth::user()->hasRole('manager')) --}}
    @can('viewAny', App\Order::class)
    <li class="sidebar-list-item">
        <a class="nav-link" href="{{ route('orders.index') }}"><i class="fas fa-cart-arrow-down text-secondary"></i>Orders</a>
    </li>
    @endcan
    {{-- @endif --}}
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