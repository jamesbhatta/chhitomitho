<style>
    #bottomMenu {
        display: none;
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        z-index: 999;
        background-color: #fff;
        border-top: 0.5px solid #dee2e6;
        padding: 5px;
        color: #6c757d;
        font-family: 'Sen', sans-serif;
    }

    @media (max-width: 700px) {
        #bottomMenu {
            display: block;
        }
    }

    #bottomMenu a {
        color: inherit;
    }

    #bottomMenu .icon {
        font-size: 18px;
    }

    #bottomMenu .menu-text {
        font-size: 10px;
    }

    #bottomMenu a.active {
        color: #ff9800;
    }

</style>
<div id="bottomMenu">
    <div class="d-flex justify-content-between">
        {{-- @for($item = 1; $item <= 4; $item++) --}}
        <div class="text-center px-2">
            <a href="{{ url('/') }}" class="{{ setActive('home') }}">
                <div class="icon">
                    <i class="icon-home-outline"></i>
                </div>
                <div class="menu-text">Home</div>
            </a>
        </div>
        {{-- @endfor --}}
        <div class="text-center px-2">
            <a href="{{ route('customer.orders') }}" class="{{ setActive('customer.orders') }}">
                <div class="icon">
                    <i class="icon-th-list"></i>
                </div>
                <div class="menu-text">Orders</div>
            </a>
        </div>
        <div class="text-center px-2">
            <a href="{{ route('cart') }}" class="{{ setActive('cart') }}">
                <div class="icon">
                    <i class="icon-basket-alt"></i>
                    <span class="cart-quantity" style="margin-left: -10px; vertical-align: top; font-size: 0.5em; background-color: #ff9800; color: #fff; padding: 2px 3px; border-radius: 50%;">0</span>
                </div>
                <div class="menu-text">Cart</div>
            </a>
        </div>
        <div class="text-center px-2">
            <a href="{{ route('user.profile') }}" class="{{ setActive('user.profile') }}">
                <div class="icon">
                    {{-- <i class="icon-user-o"></i> --}}
                    <i class="far fa-user-circle"></i>
                </div>
                <div class="menu-text">Account</div>
            </a>
        </div>
    </div>
</div>
