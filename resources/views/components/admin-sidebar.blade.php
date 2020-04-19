<style>
    span.new-orders-count {
        padding-left: 5px;
        padding-right: 5px;
        border-radius: 45%;
        background-color: #ffba33;
        color: #fff;
    }
</style>
<div id="adminSidebar">
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
        {{-- @can('viewAny', App\Order::class)
        <li class="sidebar-list-item">
            <a class="nav-link" href="{{ route('orders.index') }}"><i class="fas fa-cart-arrow-down text-secondary"></i>Orders</a>
        </li>
        @endcan --}}
        <li class="sidebar-list-item">
            <a class="nav-link" href="{{ url('/') }}" target="_blank"><i class="fas fa-globe text-warning"></i> Site <span><i class="fas fa-angle-right"></i></span></a>
        </li>
        @can('access-orders')
        <li class="sidebar-list-item">
            <a class="nav-link" href="{{ route('orders.index') }}"><i class="fas fa-cart-arrow-down text-secondary"></i>Orders<span class="new-orders-count">@{{ newOrders }}</span></a>
        </li>
        @endcan
        @can('manage-categories')
        <li class="sidebar-list-item">
            <a class="nav-link" href="{{ route('category.index') }}"><i class="far fa-list-alt text-warning"></i>Categories<span><i class="fas fa-angle-right"></i></span></a>
        </li>
        @endcan
        @can('manage-products')
        <li class="sidebar-list-item">
            <a class="nav-link" href="{{ route('product.create') }}"><i class="fa fa-plus text-info"></i>New Product<span><i class="fas fa-angle-right"></i></span></a>
        </li>
        @endcan
        @can('manage-products')
        <li class="sidebar-list-item">
            <a class="nav-link" href="{{ route('product.index') }}"><i class="fas fa-cube text-primary"></i>Products<span><i class="fas fa-angle-right"></i></span></a>
        </li>
        @endcan
        @can('manage-users')
        <li class="sidebar-list-item">
            <a class="nav-link" href="{{ route('users.index') }}"><i class="far fa-user text-secondary"></i>Users<span><i class="fas fa-angle-right"></i></span></a>
        </li>
        @endcan
        @can('manage-stores')
        <li class="sidebar-list-item">
            <a class="nav-link" href="{{ route('stores.index') }}"><i class="fas fa-grip-horizontal"></i>Stores<span><i class="fas fa-angle-right"></i></span></a>
        </li>
        @endcan
        @can('manage-sliders')
        <li class="sidebar-list-item">
            <a class="nav-link" href="{{ route('sliders.index') }}"><i class="far fa-images text-default"></i>Sliders<span><i class="fas fa-angle-right"></i></span></a>
        </li>
        @endcan
        @can('manage-logs')
        <li class="sidebar-list-item">
            <a class="nav-link" href="{{ route('logs') }}" target="_blank"><i class="far fa-calendar-alt text-secondary"></i>Logs<span><i class="fas fa-angle-right"></i></span></a>
        </li>
        @endcan
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
@push('scripts')
<script>
    $(function() {
        var adminSidebar = new Vue({
            el: '#adminSidebar',
            data: {
                newOrders: 0,
            },
            created() {
                this.getNewOrders();
                setInterval(this.getNewOrders, 15 * 1000);
            },
            methods: {
                getNewOrders: function(){
                    axios.get('{{ route('ajax.order.new.count') }}')
                    .then(response => {
                        this.newOrders = response.data.count;
                    })
                    .catch(error => {
                        console.log(error);
                    })
                }
            }
        })
    });
</script>    
@endpush