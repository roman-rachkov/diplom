<div class="wrap">
    <div class="row Header-rowMain">
        <div class="row-block Header-logo"><a class="logo" href="{{route('banners')}}"><img class="logo-image" src="{{asset('assets/img/logo.png')}}" alt="logo.png"/></a>
        </div>
        <nav class="row-block row-block_right Header-menu">
            <div class="menuModal" id="navigate">
                <ul class="menu menu_main">
                    <li class="menu-item"><a class="menu-link" href="{{route('banners')}}">{{__('main_menu.Main')}}</a></li>
                    <li class="menu-item"><span class="menu-label menu-label_danger">Hot</span><a class="menu-link" href="{{route('products.index')}}">{{__('main_menu.Catalog')}}</a></li>
                    <li class="menu-item"><span class="menu-label menu-label_success">New</span><a class="menu-link" href="{{route('discounts.index')}}">{{__('main_menu.Discounts')}}</a></li>
                    <li class="menu-item"><a class="menu-link" href="{{route('feedbacks.index')}}">{{__('main_menu.Contacts')}}</a></li>
                </ul>
            </div>
        </nav>
        <div class="row-block">
            <div class="CartBlock">
                <a class="CartBlock-block" href="{{route('comparison')}}">
                    <img class="CartBlock-img" src="{{asset('assets/img/icons/exchange.svg')}}" alt="exchange.svg"/>
                    <span class="CartBlock-amount">4</span>
                </a>
                <a class="CartBlock-block" href="{{route('carts.edit')}}">
                    <img class="CartBlock-img" src="{{asset('assets/img/icons/cart.svg')}}" alt="cart.svg"/>
                    <span class="CartBlock-amount">0</span>
                </a>
                <div class="CartBlock-block">
                    <span class="CartBlock-price">0.00$</span>
                </div>
            </div>
        </div>
        <div class="row-block Header-trigger">
            <a class="menuTrigger" href="#navigate">
                <div class="menuTrigger-content">{{__('main_menu.Navigation')}}
                </div><span></span><span></span><span></span>
            </a>
        </div>
    </div>
</div>
